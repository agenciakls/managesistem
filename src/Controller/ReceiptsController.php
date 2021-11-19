<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ReceiptsController extends AppController {

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
        $receipts = $this->paginate($this->Receipts->find('all', [
            'conditions' => [
                'OR' => [
                    'Receipts.title LIKE' => '%' . $pesquisa . '%',
                    'Receipts.price LIKE' => $pesquisa
                ]
            ],
            'order' => [
                'Receipts.date' => 'desc'
            ]
        ]));

        $this->set(compact('receipts'));
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

        $listMethods = TableRegistry::get('methods');

        $allMethods = $listMethods->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethods = $methodSingle->id;
            $methods[$idMethods] = $methodSingle->title;
        }
        $this->set(compact('methods'));

        $receipt = $this->Receipts->get($id, [
            'contain' => ['Expenses', 'Methods', 'Statuscosts'],
        ]);

        $this->set('receipt', $receipt);
    }

    public function add() {

        $listExpenses = TableRegistry::get('expenses');

        $allExpenses = $listExpenses->find('all');

        foreach ($allExpenses as $expenseSingle) {

            $idExpenses = $expenseSingle->id;
            $expenses[$idExpenses] = $expenseSingle->title;

        }
        $this->set(compact('expenses'));


        $listMethods = TableRegistry::get('methods');

        $allMethods = $listMethods->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethods = $methodSingle->id;
            $methods[$idMethods] = $methodSingle->title;
        }
        $this->set(compact('methods'));

        $listStatusCost = TableRegistry::get('statuscosts');
        $allStatusCost = $listStatusCost->find('all');

        foreach ($allStatusCost as $statuscostSingle) {
            $idStatusCost = $statuscostSingle->id;
            $statuscosts[$idStatusCost] = $statuscostSingle->title;
        }
        $this->set(compact('statuscosts'));

        $receipt = $this->Receipts->newEmptyEntity();

        if ($this->request->is('post')) {

            $receipt = $this->Receipts->patchEntity($receipt, $this->request->getData());

            if ($this->Receipts->save($receipt)) {
                $this->Flash->success(__('The receipt has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
        }
        $this->set(compact('receipt'));
    }

    public function edit($id = null) {

        $listExpenses = TableRegistry::get('expenses');

        $allExpenses = $listExpenses->find('all');

        foreach ($allExpenses as $expenseSingle) {
            $idExpenses = $expenseSingle->id;
            $expenses[$idExpenses] = $expenseSingle->title;
        }
        $this->set(compact('expenses'));


        $listMethods = TableRegistry::get('methods');

        $allMethods = $listMethods->find('all');

        foreach ($allMethods as $methodSingle) {
            $idMethods = $methodSingle->id;
            $methods[$idMethods] = $methodSingle->title;
        }
        $this->set(compact('methods'));

        $listStatusCost = TableRegistry::get('statuscosts');
        $allStatusCost = $listStatusCost->find('all');

        foreach ($allStatusCost as $statuscostSingle) {
            $idStatusCost = $statuscostSingle->id;
            $statuscosts[$idStatusCost] = $statuscostSingle->title;
        }
        $this->set(compact('statuscosts'));

        $receipt = $this->Receipts->get($id, [
            'contain' => ['StatusCost', 'Expenses'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $receipt = $this->Receipts->patchEntity($receipt, $this->request->getData());

            if ($this->Receipts->save($receipt)) {
                $this->Flash->success(__('The receipt has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
        }
        $this->set(compact('receipt'));
    }

    public function delete($id = null) {

        $this->request->allowMethod(['post', 'delete']);

        $receipt = $this->Receipts->get($id);

        if ($this->Receipts->delete($receipt)) {
            $this->Flash->success(__('The receipt has been deleted.'));
        } else {
            $this->Flash->error(__('The receipt could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
