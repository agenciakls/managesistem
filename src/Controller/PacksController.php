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
        $statuses = array(
            0 => 'Inativo',
            1 => 'Ativo',
        );

        $pack = $this->Packs->newEmptyEntity();
        if ($this->request->is('post')) {
            $pack = $this->Packs->patchEntity($pack, $this->request->getData());
            if ($this->Packs->save($pack)) {
                $this->Flash->success(__('O produto foi salvo com sucesso'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Houve um erro, tente novamente.'));
        }
        $this->set(compact('statuses'));
        $this->set(compact('pack'));
    }
    public function edit($id = null) {
        $pack = $this->Packs->get($id, [
            'contain' => [],
        ]);
        
        $statuses = array(
            0 => 'Inativo',
            1 => 'Ativo',
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pack = $this->Packs->patchEntity($pack, $this->request->getData());
            if ($this->Packs->save($pack)) {
                $this->Flash->success(__('O produto foi salvo com sucesso'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Houve um erro, tente novamente.'));
        }
        $this->set(compact('statuses'));
        $this->set(compact('pack'));
    }
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $pack = $this->Packs->get($id);
        if ($this->Packs->delete($pack)) {
            $this->Flash->success(__('O produto foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O produto não foi deletado, tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
