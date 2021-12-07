<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class CostsController extends AppController {

    public function index() {
        $listExpenses = TableRegistry::get('Expenses');
        $expenses = $listExpenses->find('all');

        $this->set(compact('expenses'));
    }
    public function pesquisa() {
        $pesquisa = ($this->request->getQuery('s')) ? $this->request->getQuery('s'): '';
        $this->paginate = [
            'contain' => ['Statuscosts', 'Expenses', 'Methods']
        ];
        $costs = $this->paginate($this->Costs->find('all', [
            'conditions' => [
                'OR' => [
                    'Costs.title LIKE' => '%' . $pesquisa . '%',
                    'Costs.price LIKE' => $pesquisa
                ]
            ],
            'order' => [
                'Costs.date' => 'desc'
            ]
        ]));

        $this->set(compact('costs'));
        $this->set(compact('pesquisa'));
    }

    public function view($id = null) {

        $listExpenses = TableRegistry::get('expenses');
        $allExpenses = $listExpenses->find('all');
        foreach ($allExpenses as $expenseSingle) {
            $idExpenses = $expenseSingle->id;
            $expenses[$idExpenses] = $expenseSingle->title;
        }
        $this->set(compact('expenses'));

        $listUsers = TableRegistry::get('users');
        $allUsers = $listUsers->find('all');
        foreach ($allUsers as $sellerSingle) {
            $idUsers = $sellerSingle->id;
            $sellers[$idUsers] = $sellerSingle->title;
        }
        $this->set(compact('sellers'));

        $listMethods = TableRegistry::get('methods');

        $allMethods = $listMethods->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethods = $methodSingle->id;
            $methods[$idMethods] = $methodSingle->title;
        }
        $this->set(compact('methods'));

        $cost = $this->Costs->get($id, [
            'contain' => ['Expenses', 'Methods', 'Statuscosts'],
        ]);

        $this->set('cost', $cost);
    }

    public function add() {

        $listExpenses = TableRegistry::get('expenses');

        $allExpenses = $listExpenses->find('all');

        foreach ($allExpenses as $expenseSingle) {

            $idExpenses = $expenseSingle->id;
            $expenses[$idExpenses] = $expenseSingle->title;

        }
        $this->set(compact('expenses'));

        $listUsers = TableRegistry::get('users');
        $allUsers = $listUsers->find('all');
        foreach ($allUsers as $sellerSingle) {
            $idUsers = $sellerSingle->id;
            $sellers[$idUsers] = $sellerSingle->title;
        }
        $this->set(compact('sellers'));


        $listMethods = TableRegistry::get('methods');

        $allMethods = $listMethods->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethods = $methodSingle->id;
            $methods[$idMethods] = $methodSingle->title;
        }
        $this->set(compact('methods'));

        $listStatuscost = TableRegistry::get('statuscosts');
        $allStatuscosts = $listStatuscost->find('all');

        foreach ($allStatuscosts as $statuscostSingle) {
            $idStatuscost = $statuscostSingle->id;
            $statuscosts[$idStatuscost] = $statuscostSingle->title;
        }
        $this->set(compact('statuscosts'));

        $cost = $this->Costs->newEmptyEntity();

        if ($this->request->is('post')) {

            $cost = $this->Costs->patchEntity($cost, $this->request->getData());

            if ($this->Costs->save($cost)) {
                $this->Flash->success(__('The cost has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost could not be saved. Please, try again.'));
        }
        $this->set(compact('cost'));
    }

    public function edit($id = null) {

        $listExpenses = TableRegistry::get('expenses');

        $allExpenses = $listExpenses->find('all');

        foreach ($allExpenses as $expenseSingle) {
            $idExpenses = $expenseSingle->id;
            $expenses[$idExpenses] = $expenseSingle->title;
        }
        $this->set(compact('expenses'));

        $listUsers = TableRegistry::get('users');
        $allUsers = $listUsers->find('all');
        foreach ($allUsers as $sellerSingle) {
            $idUsers = $sellerSingle->id;
            $sellers[$idUsers] = $sellerSingle->title;
        }
        $this->set(compact('sellers'));


        $listMethods = TableRegistry::get('methods');

        $allMethods = $listMethods->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethods = $methodSingle->id;
            $methods[$idMethods] = $methodSingle->title;
        }
        $this->set(compact('methods'));

        $listStatuscost = TableRegistry::get('statuscosts');
        $allStatuscosts = $listStatuscost->find('all');

        foreach ($allStatuscosts as $statuscostSingle) {
            $idStatuscost = $statuscostSingle->id;
            $statuscosts[$idStatuscost] = $statuscostSingle->title;
        }
        $this->set(compact('statuscosts'));

        $cost = $this->Costs->get($id, [
            'contain' => ['Statuscosts', 'Expenses'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $cost = $this->Costs->patchEntity($cost, $this->request->getData());

            if ($this->Costs->save($cost)) {
                $this->Flash->success(__('The cost has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cost could not be saved. Please, try again.'));
        }
        $this->set(compact('cost'));
    }

    public function delete($id = null) {

        $this->request->allowMethod(['post', 'delete']);

        $cost = $this->Costs->get($id);

        if ($this->Costs->delete($cost)) {
            $this->Flash->success(__('The cost has been deleted.'));
        } else {
            $this->Flash->error(__('The cost could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}



