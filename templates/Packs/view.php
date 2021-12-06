<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Pacotes
                            </h4>
                            <div class="small text-muted">
                                Visualizar
                            </div>
                        </div>
                    </div>
                    <div class="c-chart-wrapper my-3">
                        <div class="col-md-12">
                            <div class="my-3">
                                <aside class="column">
                                    <div class="side-nav">
                                        <h4 class="heading"><?= __('Ações') ?></h4>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $pack->id], ['class' => 'side-nav-item']) ?>
                                        -
                                        <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $pack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pack->id), 'class' => 'side-nav-item']) ?>
                                        -
                                        <?= $this->Html->link(__('Pacotes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                                        -
                                        <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
                                    </div>
                                </aside>
                            </div>
                            <div class="my-3">
                                <h3><?= h($pack->name) ?></h3>
                                <table class="table">
                                    <tr>
                                        <th><?= __('Identificação') ?></th>
                                        <td><?= $this->Number->format($pack->id) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Título') ?></th>
                                        <td><?= h($pack->name) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Descrição') ?></th>
                                        <td><?= h($pack->description) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Valor') ?></th>
                                        <td><?= $this->Number->format($pack->price) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Comissão do Frigorifico (Valor p/ kg)') ?></th>
                                        <td><?= $this->Number->format($pack->commission) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
