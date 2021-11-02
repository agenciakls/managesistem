<?php

declare(strict_types=1);

namespace App\Controller;

class PacksController extends AppController {

    public function index() {
        $packs = $this->paginate($this->Packs);
        $this->set(compact('packs'));
    }

    public function view($id = null) {
        $pack = $this->Packs->get($id, [
            'contain' => [],
        ]);
        $this->set('pack', $pack);
    }
    
    public function add() {

        $pack = $this->Packs->newEmptyEntity();

        if ($this->request->is('post')) {

            $pack = $this->Packs->patchEntity($pack, $this->request->getData());

            if ($this->Packs->save($pack)) {

                $this->Flash->success(__('The pack has been saved.'));

                return $this->redirect(['action' => 'index']);

            }

            $this->Flash->error(__('The pack could not be saved. Please, try again.'));

        }

        $this->set(compact('pack'));

    }

    public function edit($id = null) {

        $pack = $this->Packs->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $pack = $this->Packs->patchEntity($pack, $this->request->getData());

            if ($this->Packs->save($pack)) {
                $this->Flash->success(__('The pack has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The pack could not be saved. Please, try again.'));

        }
        $this->set(compact('pack'));

    }
    public function delete($id = null) {

        $this->request->allowMethod(['post', 'delete']);

        $pack = $this->Packs->get($id);

        if ($this->Packs->delete($pack)) {
            $this->Flash->success(__('The pack has been deleted.'));
        } else {
            $this->Flash->error(__('The pack could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

