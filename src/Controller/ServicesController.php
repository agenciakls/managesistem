<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;

class ServicesController extends AppController {
    public function index() {

        $listTech = TableRegistry::get('users');

        $sellers = ($this->usuarioAtual['role_id'] == 1 || $this->usuarioAtual['role_id'] == 2) ?
            $listTech->find('all')->where(['role_id' => 3, 'status' => 1]) :
            $listTech->find('all')->where(['role_id' => 3, 'status' => 1]) ;

        $this->set(compact('sellers'));
    }
    public function pesquisa()
    {
        $pesquisa = ($this->request->getQuery('s')) ? $this->request->getQuery('s'): '';
        $this->paginate = [
            'contain' => ['Clients', 'Paids', 'Packs']
        ];
        $pesquisaPermission = ($this->usuarioAtual['role_id'] == 1 || $this->usuarioAtual['role_id'] == 2) ? '': ['Services.seller_id' => $this->usuarioAtual['id']];

        $services = $this->paginate($this->Services->find('all', [
            'conditions' => [
                'OR' => [
                    'Services.os LIKE' => '%' . $pesquisa . '%',
                    'Services.price LIKE' => $pesquisa,
                    'Clients.email LIKE' => '%' . $pesquisa . '%',
                    'Clients.nome LIKE' => '%' . $pesquisa . '%',
                    'Clients.cpf LIKE' => '%' . $pesquisa . '%',
                    'Clients.address LIKE' => '%' . $pesquisa . '%',
                ],
                'AND' => $pesquisaPermission,
            ]
        ]));

        $this->set(compact('services'));
        $this->set(compact('pesquisa'));
    }
    public function rotas()
    {

        $listSellers = TableRegistry::get('users');
        $allSellers = $listSellers->find('all')->where(['role_id' => 3]);
        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));

        $dateStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime($this->request->getQuery('datestart'))): null;
        $dateEnd = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('datestart')))): null;

        $insertDate = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d", strtotime($this->request->getQuery('datestart'))): null;
        $this->set(compact('insertDate'));

        $getID = ($this->request->getQuery('id')) ? $this->request->getQuery('id'): null;

        $seller_id = ($this->request->getQuery('seller_id')) ? (int) $this->request->getQuery('seller_id'): null;

        $listSellers = TableRegistry::get('users');
        $sellerData = ($seller_id) ? $listSellers->get($seller_id): null;

        if ($seller_id && $dateStart) {

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

            $services = $this->Services->find('all', $periodo)->contain(['Clients', 'Paids', 'Methods'])->where(['Services.seller_id' => $seller_id] )->order(['date' => 'ASC']);
        }
        else if ($getID) {
            $services[] = $this->Services->get($getID, [
                'contain' => ['Clients' => [ 'Statuses' ], 'Paids', 'Methods']
            ]);
        }
        else { $services = null; }
        $this->set(compact('sellerData'));
        $this->set(compact('services'));
    }
    public function view($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => ['Clients', 'Paids', 'Methods']
        ]);

        $listUsers = TableRegistry::get('users');
        $sellerData = ($service->seller_id) ? $listUsers->get($service->seller_id): null;

        $this->set(compact('sellerData'));
        $this->set('service', $service);
    }
    public function add() {

    }
    public function addcomplete() {

        $listClients = TableRegistry::get('clients');
        $listSellers = TableRegistry::get('users');
        $listPacks = TableRegistry::get('packs');
        $listPaid = TableRegistry::get('paids');
        $listMethod = TableRegistry::get('methods');


        $allPacks = $listPacks->find('all')->where(['status' => 1]);
        $packs = array();
        foreach ($allPacks as $packSingle) {
            $idPack = $packSingle->id;
            $packs[$idPack] = $packSingle->name;
        }
        $this->set(compact('packs'));

        $allSellers = $listSellers->find('all')->where(['role_id' => 3, 'status' => 1]);
        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));


        $allPaids = $listPaid->find('all');

        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));


        $allMethods = $listMethod->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));


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
            $service = $this->Services->patchEntity($service, $this->request->getData());
            $clientSave = $listClients->save($client);
            if ($listClients->save($client)) {
                $service->client_id = $clientSave->id;
                $todosPacks = $listPacks->find('all')->where(['id' => $service->pack_id]);
                $singlePacks = $todosPacks->first();
                $listUsers = $listSellers->find('all')->where(['id' => $service->seller_id]);
                $singleUserSeller = $listUsers->first();
                $service->price = $service->weight * $singlePacks->price;
                $service->distributor = $service->weight * $singlePacks->commission;
                $service->representative = $service->weight * $singleUserSeller->commission;
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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O cliente não foi salvo, tente novamente.'));
        }
        $this->set(compact('service'));
        $this->set(compact('client'));
    }

    public function addservice() {

        $listClients = TableRegistry::get('clients');
        $listSellers = TableRegistry::get('users');
        $listPacks = TableRegistry::get('packs');
        $listSellers = TableRegistry::get('users');
        $listPaid = TableRegistry::get('paids');
        $listMethod = TableRegistry::get('methods');


        $allPacks = $listPacks->find('all')->where(['status' => 1]);
        $packs = array();
        foreach ($allPacks as $packSingle) {
            $idPack = $packSingle->id;
            $packs[$idPack] = $packSingle->name;
        }
        $this->set(compact('packs'));

        $allSellers = $listSellers->find('all')->where(['role_id' => 3, 'status' => 1,]);
        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));


        $allPaids = $listPaid->find('all');

        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));


        $allMethods = $listMethod->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));


        $listStatus = TableRegistry::get('statuses');
        $allStatuses = $listStatus->find('all');
        foreach ($allStatuses as $statusSingle) {
            $idStatus = $statusSingle->id;
            $statuses[$idStatus] = $statusSingle->title;
        }
        $this->set(compact('statuses'));

        $service = $this->Services->newEmptyEntity();
        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            $service->os = '';
            if ($service->client_id) {
                if ($service->date < $service->date_end || $service->date_end == null) {

                    $todosPacks = $listPacks->find('all')->where(['id' => $service->pack_id]);
                    $singlePacks = $todosPacks->first();
                    $listUsers = $listSellers->find('all')->where(['id' => $service->seller_id]);
                    $singleUserSeller = $listUsers->first();
                    $service->price = $service->weight * $singlePacks->price;
                    $service->distributor = $service->weight * $singlePacks->commission;
                    $service->representative = $service->weight * $singleUserSeller->commission;

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
        $listSellers = TableRegistry::get('users');
        $listPacks = TableRegistry::get('packs');
        $listSellers = TableRegistry::get('users');
        $allSellers = $listSellers->find('all')->where(['role_id' => 3, 'status' => 1]);

        $allPacks = $listPacks->find('all')->where(['status' => 1]);
        $packs = array();
        foreach ($allPacks as $packSingle) {
            $idPack = $packSingle->id;
            $packs[$idPack] = $packSingle->name;
        }
        $this->set(compact('packs'));

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

                $todosPacks = $listPacks->find('all')->where(['id' => $service->pack_id]);
                $singlePacks = $todosPacks->first();
                $listUsers = $listSellers->find('all')->where(['id' => $service->seller_id]);
                $singleUserSeller = $listUsers->first();
                $service->price = $service->weight * $singlePacks->price;
                $service->distributor = $service->weight * $singlePacks->commission;
                $service->representative = $service->weight * $singleUserSeller->commission;
                if ($this->usuarioAtual['role_id'] == 1 || $this->usuarioAtual['role_id'] == 2) { $service->representative = $service->weight * $singleUserSeller->commission;
                }

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
