<?php

declare(strict_types=1);



namespace App\Controller;

use Cake\ORM\TableRegistry;



class GetController extends AppController

{

    public function index()

    {

        $pesquisa = $this->request->getQuery('s');

        $this->paginate = [

            'contain' => ['Clients', 'Situations']

        ];

        $services = $this->paginate($servicesTable->find('all', ['conditions' => ['Services.title  LIKE' => '%' . $pesquisa . '%']]));

        $this->set(compact('services'));

        $this->set(compact('pesquisa'));

    }

    public function services()

    {

        $start = $this->request->getQuery('start');

        $end = $this->request->getQuery('end');

        $listServices = array();

        $servicesTable = TableRegistry::get('Services');

        $services = $servicesTable->find('all')->contain(['Clients'])->where(['date >= ' => $start])->andWhere(['date <= ' => $end]);

        $this->set(compact('services'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function editservice() {

        $responseService = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $servicesTable = TableRegistry::get('Services');

        $service = $servicesTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $date = $this->request->getData('date');

            $service = $servicesTable->patchEntity($service, $this->request->getData());

            $service->date = strftime("%Y-%m-%d %H:%M:%S", strtotime($date));

            if ($servicesTable->save($service)) {

                $responseService = [

                    'response' => 'A data do serviço foi atualizada com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseService['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseService['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseService'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function leads()

    {

        $start = $this->request->getQuery('start');

        $end = $this->request->getQuery('end');

        $listLeads = array();

        $leadsTable = TableRegistry::get('Leads');

        $leads = $leadsTable->find('all')->where(['date >= ' => $start])->andWhere(['date <= ' => $end]);

        $this->set(compact('leads'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function editlead() {

        $responseLead = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $leadsTable = TableRegistry::get('Leads');

        $lead = $leadsTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $date = $this->request->getData('date');

            $lead = $leadsTable->patchEntity($lead, $this->request->getData());

            $lead->date = strftime("%Y-%m-%d %H:%M:%S", strtotime($date));

            if ($leadsTable->save($lead)) {

                $responseLead = [

                    'response' => 'A data do serviço foi atualizada com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseLead['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseLead['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseLead'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function searchclient() {

        $pesquisa = $this->request->getQuery('term');

        $clientsTable = TableRegistry::get('Clients');



        $clients = $this->paginate($clientsTable->find('all', [

            'conditions' => [

                'OR' => [

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



        $this->set(compact('clients'));

    }

    public function savestatus() {

        $responseService = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $servicesTable = TableRegistry::get('Services');

        $service = $servicesTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $value = $this->request->getData('value');

            $field = $this->request->getData('field') . '_id';

            $service = $servicesTable->patchEntity($service, $this->request->getData());

            $service->$field = $value;

            if ($servicesTable->save($service)) {

                $this->Flash->success(__('Os dados foram atualizados com sucesso'));

                $responseService = [

                    'response' => 'O status do serviço foi atualizado com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseService['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseService['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseService'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function savecosts() {

        $responseService = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $costsTable = TableRegistry::get('Costs');

        $cost = $costsTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $value = $this->request->getData('value');

            $field = $this->request->getData('field') . '_id';

            $cost = $costsTable->patchEntity($cost, $this->request->getData());

            $cost->$field = $value;

            if ($costsTable->save($cost)) {

                $this->Flash->success(__('Os dados foram atualizados com sucesso'));

                $responseService = [

                    'response' => 'O status do serviço foi atualizado com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseService['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseService['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseService'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function costs() {

        $start = $this->request->getQuery('start');

        $end = $this->request->getQuery('end');

        $listCosts = array();

        $CostsTable = TableRegistry::get('Costs');

        $costs = $CostsTable->find('all')->where(['date >= ' => $start])->andWhere(['date <= ' => $end]);

        $this->set(compact('costs'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function editcost() {

        $responseCost = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $costsTable = TableRegistry::get('Costs');

        $cost = $costsTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $date = $this->request->getData('date');

            $cost = $costsTable->patchEntity($cost, $this->request->getData());

            $cost->date = strftime("%Y-%m-%d", strtotime($date));

            if ($costsTable->save($cost)) {

                $responseCost = [

                    'response' => 'A data do serviço foi atualizada com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseCost['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseCost['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseCost'));

        $this->viewBuilder()->setLayout('ajax');

    }
    


    // RECEIPT
    

    public function savereceipts() {

        $responseService = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $receiptsTable = TableRegistry::get('Receipts');

        $receipt = $receiptsTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $value = $this->request->getData('value');

            $field = $this->request->getData('field') . '_id';

            $receipt = $receiptsTable->patchEntity($receipt, $this->request->getData());

            $receipt->$field = $value;

            if ($receiptsTable->save($receipt)) {

                $this->Flash->success(__('Os dados foram atualizados com sucesso'));

                $responseService = [

                    'response' => 'O status do serviço foi atualizado com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseService['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseService['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseService'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function receipts() {

        $start = $this->request->getQuery('start');

        $end = $this->request->getQuery('end');

        $listReceipts = array();

        $ReceiptsTable = TableRegistry::get('Receipts');

        $receipts = $ReceiptsTable->find('all')->where(['date >= ' => $start])->andWhere(['date <= ' => $end]);

        $this->set(compact('receipts'));

        $this->viewBuilder()->setLayout('ajax');

    }

    public function editreceipt() {

        $responseReceipt = [

            'response' => 'Houve algum erro, tente novamente mais tarde!',

            'status' => false

        ];

        $id = $this->request->getData('id');

        $receiptsTable = TableRegistry::get('Receipts');

        $receipt = $receiptsTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $date = $this->request->getData('date');

            $receipt = $receiptsTable->patchEntity($receipt, $this->request->getData());

            $receipt->date = strftime("%Y-%m-%d", strtotime($date));

            if ($receiptsTable->save($receipt)) {

                $responseReceipt = [

                    'response' => 'A data do serviço foi atualizada com sucesso.',

                    'status' => true

                ];

            }

            else {

                $responseReceipt['response'] = 'O serviço não foi atualizado, tente novamente.';

            }

        }

        else {

            $responseReceipt['response'] = 'Houve algum erro ao tentar atualizar o serviço.';

        }

        $this->set(compact('responseCost'));

        $this->viewBuilder()->setLayout('ajax');

    }

}