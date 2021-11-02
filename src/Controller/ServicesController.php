<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

class ServicesController extends AppController
{
    public function index() {
        $listTech = TableRegistry::get('users');
        $technicians = $listTech->find('all')->where(['role_id' => 2, 'status' => 1]);

        $this->set(compact('technicians'));
    }
    public function pesquisa()
    {
        $pesquisa = ($this->request->getQuery('s')) ? $this->request->getQuery('s'): '';
        $this->paginate = [
            'contain' => ['Clients', 'Situations']
        ];
        $services = $this->paginate($this->Services->find('all', [
            'conditions' => [
                'OR' => [
                    'Services.title LIKE' => '%' . $pesquisa . '%',
                    'Services.os LIKE' => '%' . $pesquisa . '%',
                    'Services.price LIKE' => $pesquisa,
                    'Clients.email LIKE' => '%' . $pesquisa . '%',
                    'Clients.nome LIKE' => '%' . $pesquisa . '%',
                    'Clients.cpf LIKE' => '%' . $pesquisa . '%',
                    'Clients.phone LIKE' => '%' . $pesquisa . '%',
                    'Clients.reference LIKE' => '%' . $pesquisa . '%',
                    'Clients.address LIKE' => '%' . $pesquisa . '%',
                    'Clients.district LIKE' => '%' . $pesquisa . '%',
                    'Clients.city LIKE' => '%' . $pesquisa . '%',
                    'Clients.reference LIKE' => '%' . $pesquisa . '%'
                ]
            ]
        ]));

        $this->set(compact('services'));
        $this->set(compact('pesquisa'));
    }
    public function rotas()
    {
        
        $listTechnicians = TableRegistry::get('users');
         $allTechnicians = $listTechnicians->find('all')->where(['role_id' => 2]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));

        $dateStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime($this->request->getQuery('datestart'))): null;
        $dateEnd = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('datestart')))): null;

        $insertDate = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d", strtotime($this->request->getQuery('datestart'))): null;
        $this->set(compact('insertDate'));

        $getID = ($this->request->getQuery('id')) ? $this->request->getQuery('id'): null;

        $technician_id = ($this->request->getQuery('technician_id')) ? (int) $this->request->getQuery('technician_id'): null;
            
        $listTechnicians = TableRegistry::get('users');
        $technicianData = ($technician_id) ? $listTechnicians->get($technician_id): null;
        
        if ($technician_id && $dateStart) {

            $periodo = [];
            if ($dateStart and $dateEnd and ($dateStart <= $dateEnd)) {
                $periodo = [
                    'conditions' => [
                        'AND' => [
                            'date >= ' => $dateStart,
                            'date <= ' => $dateEnd
                        ]
                    ]
                ];
            }

            $services = $this->Services->find('all', $periodo)->contain(['Clients', 'Situations', 'Paids', 'Methods'])->where(['technician_id' => $technician_id] )->order(['date' => 'ASC']);
        }
        else if ($getID) {
            $services[] = $this->Services->get($getID, [
                'contain' => ['Clients' => [ 'Statuses' ], 'Situations', 'Paids', 'Methods']
            ]);
        }
        else { $services = null; }
        $this->set(compact('technicianData'));
        $this->set(compact('services'));
    }
    public function view($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => ['Clients' => [ 'Statuses' ], 'Situations', 'Paids', 'Methods']
        ]);
        
        $listUsers = TableRegistry::get('users');
        $technicianData = ($service->technician_id) ? $listUsers->get($service->technician_id): null;
        $sellerData = ($service->seller_id) ? $listUsers->get($service->seller_id): null;

        $this->set(compact('technicianData'));
        $this->set(compact('sellerData'));
        $this->set('service', $service);
    }
    public function add() {

    }
    public function addcomplete() {

        $listClients = TableRegistry::get('clients');
        $listTechnicians = TableRegistry::get('users');
        $allTechnicians = $listTechnicians->find('all')->where(['role_id' => 2, 'status' => 1]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));

        $listSellers = TableRegistry::get('users');
        $allSellers = $listSellers->find('all')->where(['status' => 1]);

        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));

        $listPaid = TableRegistry::get('paids');
        $allPaids = $listPaid->find('all');
        
        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));
        
        $listMethod = TableRegistry::get('methods');
        $allMethods = $listMethod->find('all');
        
        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));
        
        $listSituation = TableRegistry::get('situations');
        $allSituations = $listSituation->find('all');
        
        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));


        $listStatus = TableRegistry::get('statuses');
        $allStatuses = $listStatus->find('all');
        foreach ($allStatuses as $statusSingle) {
            $idStatus = $statusSingle->id;
            $statuses[$idStatus] = $statusSingle->title;
        }
        $this->set(compact('statuses'));

        $client = $listClients->newEmptyEntity();
        $service = $this->Services->newEmptyEntity();
        if ($this->request->is('post')) {
            $client = $listClients->patchEntity($client, $this->request->getData());
            $clientSave = $listClients->save($client);
            if ($listClients->save($client)) {
                $service->client_id = $clientSave->id;
                
                if ($this->request->is('post')) {
                    $service = $this->Services->patchEntity($service, $this->request->getData());
                    $service->os = '';
                    if ($service->date < $service->date_end || $service->date_end == null) {
                        if ($this->Services->save($service)) {
                            $service->os = strftime("%Y%m%d", strtotime("now")) . '00' . $service->id;
                            $service = $this->Services->patchEntity($service, $this->request->getData());
                            $this->Services->save($service);
                            $this->Flash->success(__('Serviço e cliente salvo com sucesso.'));
        
                            return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('O serviço não foi salvo, tente novamente.'));
                    }
                    $this->Flash->error(__('O serviço não foi salvo, verifique as datas.'));
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O cliente não foi salvo, tente novamente.'));
        }
        $this->set(compact('service'));
        $this->set(compact('client'));
    }
    
    public function addservice() {
        
        $listClients = TableRegistry::get('clients');
        $listTechnicians = TableRegistry::get('users');
        $allTechnicians = $listTechnicians->find('all')->where(['role_id' => 2, 'status' => 1]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));

        $listSellers = TableRegistry::get('users');
        $allSellers = $listSellers->find('all')->where(['status' => 1]);

        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));

        $listPaid = TableRegistry::get('paids');
        $allPaids = $listPaid->find('all');
        
        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));
        
        $listMethod = TableRegistry::get('methods');
        $allMethods = $listMethod->find('all');
        
        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));
        
        $listSituation = TableRegistry::get('situations');
        $allSituations = $listSituation->find('all');
        
        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));


        $listStatus = TableRegistry::get('statuses');
        $allStatuses = $listStatus->find('all');
        foreach ($allStatuses as $statusSingle) {
            $idStatus = $statusSingle->id;
            $statuses[$idStatus] = $statusSingle->title;
        }
        $this->set(compact('statuses'));

        $service = $this->Services->newEmptyEntity();
        if ($this->request->is('post')) {
            // $service->client_id = $clientSave->id;
            $service = $this->Services->patchEntity($service, $this->request->getData());
            $service->os = '';
            if ($service->client_id) {
                if ($service->date < $service->date_end || $service->date_end == null) {
                    if ($this->Services->save($service)) {
                        $service->os = strftime("%Y%m%d", strtotime("now")) . '00' . $service->id;
                        $service = $this->Services->patchEntity($service, $this->request->getData());
                        $this->Services->save($service);
                        $this->Flash->success(__('Serviço salvo com sucesso.'));
    
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('O serviço não foi salvo, tente novamente.'));
                }
                $this->Flash->error(__('O serviço não foi salvo, verifique as datas.'));
            }
            $this->Flash->error(__('Selecione o ID do Cliente.'));
        }
        $this->set(compact('service'));

    }

    public function edit($id = null)
    {
        
        
        $listClients = TableRegistry::get('clients');
        $listTechnicians = TableRegistry::get('users');
        $allTechnicians = $listTechnicians->find('all')->where(['role_id' => 2, 'status' => 1]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));

        $listSellers = TableRegistry::get('users');
        $allSellers = $listSellers->find('all')->where(['status' => 1]);

        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));

        $listPaid = TableRegistry::get('paids');
        $allPaids = $listPaid->find('all');
        
        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));
        
        $listMethod = TableRegistry::get('methods');
        $allMethods = $listMethod->find('all');
        
        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));
        
        $listSituation = TableRegistry::get('situations');
        $allSituations = $listSituation->find('all');
        
        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));


        $listStatus = TableRegistry::get('statuses');
        $allStatuses = $listStatus->find('all');
        foreach ($allStatuses as $statusSingle) {
            $idStatus = $statusSingle->id;
            $statuses[$idStatus] = $statusSingle->title;
        }
        $this->set(compact('statuses'));

        $service = $this->Services->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($service->date < $service->date_end || $service->date_end == null) {
                if ($this->Services->save($service)) {
                    $this->Flash->success(__('The service has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The service could not be saved. Please, try again.'));
            }
            $this->Flash->error(__('O serviço não foi salvo, verifique as datas.'));
        }
        $this->set(compact('service'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
