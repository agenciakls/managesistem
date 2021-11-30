<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

class LeadsController extends AppController
{
    public function index() {
        $listSituation = TableRegistry::get('situations');
        $situations = $listSituation->find('all');

        $this->set(compact('situations'));
    }
    public function pesquisa()
    {
        $pesquisa = ($this->request->getQuery('s')) ? $this->request->getQuery('s'): '';
        $this->paginate = [
            'contain' => ['Situations']
        ];
        $leads = $this->paginate($this->Leads->find('all', [
            'conditions' => [
                'OR' => [
                    'Leads.number LIKE' => '%' . $pesquisa . '%',
                ]
            ]
        ]));

        $this->set(compact('leads'));
        $this->set(compact('pesquisa'));
    }
    public function view($id = null)
    {
        $lead = $this->Leads->get($id, [
            'contain' => ['Situations']
        ]);
        
        $listSituations = TableRegistry::get('situations');
        $situationData = ($lead->situation) ? $listSituations->get($lead->situation_id): null;

        $this->set(compact('situationData'));
        $this->set('lead', $lead);
    }
    public function add() {

        $listLeads = TableRegistry::get('leads');
        $listSituations = TableRegistry::get('situations');
        $allSituations = $listSituations->find('all');

        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));

        $lead = $listLeads->newEmptyEntity();
        if ($this->request->is('post')) {
            $getData = $this->request->getData();
            $lead = $listLeads->patchEntity($lead, $this->request->getData());
            $dateSave = date('Y-m-d', strtotime($getData['date']));
            $lead->date = $dateSave;
            if ($listLeads->save($lead)) {
                $this->Flash->success(__('Lead salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O lead não foi salvo, tente novamente.'));
        }
        $this->set(compact('lead'));
    }
    public function edit($id = null)
    {
        $listLeads = TableRegistry::get('leads');
        $listSituations = TableRegistry::get('situations');
        $allSituations = $listSituations->find('all');

        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));

        $lead = $this->Leads->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lead = $listLeads->patchEntity($lead, $this->request->getData());
            if ($listLeads->save($lead)) {
                $this->Flash->success(__('The lead has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lead could not be saved. Please, try again.'));
        }
        $this->set(compact('lead'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lead = $this->Leads->get($id);
        if ($this->Leads->delete($lead)) {
            $this->Flash->success(__('The lead has been deleted.'));
        } else {
            $this->Flash->error(__('The lead could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
