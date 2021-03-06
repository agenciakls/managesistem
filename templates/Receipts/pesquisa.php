<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Entradas
                            </h4>
                            <div class="small text-muted">
                                Pesquisa
                            </div>
                        </div>
                    </div>
                        
                    <form action="<?php echo $this->Url->build(['controller' => 'receipts', 'action' => 'pesquisa']); ?>" class="service-search" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="s" type="text" placeholder="Pesquisar Entrada" class="service-input form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-pill mx-1 d-block btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Html->link(__('Adicionar Entrada'), ['action' => 'add'], ['class' => 'btn btn-pill mx-1 px-5 btn-primary float-right']) ?>
                            </div>
                        </div>
                    </form>
                    <div class="c-chart-wrapper my-3">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Entradas</th>
                                            <th>Categoria</th>
                                            <th>Data</th>
                                            <th>Valor</th>
                                            <th>A????es</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($receipts as $receipt) {
                                        ?>
                                        <tr>
                                            <td><?= h($receipt->title) ?></td>
                                            <td><?= h($receipt['expense']['title']) ?></td>
                                            <td><?= strftime("%d/%m", strtotime($receipt->date)); ?></td>
                                            <td>R$ <?= $this->Number->format($receipt->price) ?></td>
                                            <td>
                                                <?= $this->Html->link(__('Ver'), ['action' => 'view', $receipt->id], ['class' => 'btn btn-pill px-2 btn-sm btn-primary']) ?>
                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $receipt->id], ['class' => 'btn btn-pill px-2 btn-sm btn-primary']) ?>
                                                <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $receipt->id], ['confirm' => __('Tem certeza que deseja excluir {0}?', $receipt->title), 'class' => 'btn btn-pill px-2 btn-sm btn-primary side-nav-item']) ?>
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
                                <?= $this->Paginator->next(__('Pr??xima') . ' >') ?>
                                <?= $this->Paginator->last(__('??ltima') . ' >>') ?>
                            </ul>
                            <p><?= $this->Paginator->counter(__('P??gina {{page}} de {{pages}}, mostrando {{current}} resultados de {{count}} no total')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>