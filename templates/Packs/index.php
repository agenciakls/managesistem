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
                                Lista
                            </div>
                        </div>
                    </div>
                    <div class="main-action text-right">
                        <?= $this->Html->link(__('Adicionar Pacotes'), ['action' => 'add'], ['class' => 'btn btn-pill mx-1 px-5 btn-primary']) ?>
                    </div>
                    <div class="c-chart-wrapper my-3">
                        <div class="main-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Pacotes</th>
                                                <th>Descrição</th>
                                                <th>Valor</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($packs as $pack) {
                                            ?>
                                            <tr>
                                                <td><?= h($pack->name) ?></td>
                                                <td><?= h($pack->description) ?></td>
                                                <td>R$ <?= $this->Number->format($pack->price) ?></td>
                                                <td>
                                                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $pack->id], ['class' => 'btn btn-pill px-2 btn-sm btn-primary']) ?>
                                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $pack->id], ['class' => 'btn btn-pill px-2 btn-sm btn-primary']) ?>
                                                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $pack->id], ['confirm' => __('Tem certeza que deseja excluir ' . $pack->name . '?', $pack->id), 'class' => 'btn btn-pill px-2 btn-sm btn-primary side-nav-item']) ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="paginator">
                                <ul class="col-md-12 pagination">
                                    <?= $this->Paginator->first('<< ' . __('Primeira')) ?>
                                    <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('Próxima') . ' >') ?>
                                    <?= $this->Paginator->last(__('Última') . ' >>') ?>
                                </ul>
                                <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} resultados de {{count}} no total')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>