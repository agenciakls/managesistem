<?php

declare(strict_types=1);

namespace App\Controller;

class ExpensesController extends AppController {

    public function index() {

        $expenses = $this->paginate($this->Expenses);

        $this->set(compact('expenses'));

    }

    public function view($id = null) {

        $expense = $this->Expenses->get($id, [
            'contain' => [],
        ]);
        $this->set('expense', $expense);
    }

    public function add() {

        $expense = $this->Expenses->newEmptyEntity();

        if ($this->request->is('post')) {

            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());

            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $this->set(compact('expense'));
    }

    public function edit($id = null) {

        $expense = $this->Expenses->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());

            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $this->set(compact('expense'));

    }

    public function delete($id = null) {

        $this->request->allowMethod(['post', 'delete']);

        $expense = $this->Expenses->get($id);

        if ($this->Expenses->delete($expense)) {
            $this->Flash->success(__('The expense has been deleted.'));
        } else {
            $this->Flash->error(__('The expense could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}

