<?php
declare(strict_types=1);

namespace App\Controller;

class StatusesController extends AppController {

    public function index() {
        $statuses = $this->paginate($this->Statuses);

        $this->set(compact('statuses'));
    }

    public function view($id = null) {
        $status = $this->Statuses->get($id, [
            'contain' => [],
        ]);

        $this->set('status', $status);
    }

    public function add() {
        $status = $this->Statuses->newEmptyEntity();
        if ($this->request->is('post')) {
            $status = $this->Statuses->patchEntity($status, $this->request->getData());
            if ($this->Statuses->save($status)) {
                $this->Flash->success(__('The status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The status could not be saved. Please, try again.'));
        }
        $this->set(compact('status'));
    }

    public function edit($id = null) {
        $status = $this->Statuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $status = $this->Statuses->patchEntity($status, $this->request->getData());
            if ($this->Statuses->save($status)) {
                $this->Flash->success(__('The status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The status could not be saved. Please, try again.'));
        }
        $this->set(compact('status'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $status = $this->Statuses->get($id);
        if ($this->Statuses->delete($status)) {
            $this->Flash->success(__('The status has been deleted.'));
        } else {
            $this->Flash->error(__('The status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
