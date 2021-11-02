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

                                Visualizar

                            </div>

                        </div>

                    </div>

                    <div class="c-chart-wrapper my-3">

                        <div class="my-3">

                            <aside class="column">

                                <div class="side-nav">

                                    <h4 class="heading"><?= __('Ações') ?></h4>

                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $receipt->id], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $receipt->id], ['confirm' => __('Tem certeza que deseja excluir {0}?', $receipt->title), 'class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Entradas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>

                                </div>

                            </aside>

                        </div>

                        <div class="my-3">

                            <h3><?= h($receipt->title) ?></h3>

                            <table class="table">

                                <tr>

                                    <th><?= __('Identificação') ?></th>

                                    <td><?= $this->Number->format($receipt->id) ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Título') ?></th>

                                    <td><?= h($receipt->title) ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Detalhes') ?></th>

                                    <td><?= h($receipt->detalhes) ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Categoria') ?></th>

                                    <td><?= ($receipt['expense']['title']) ? $receipt['expense']['title'] : '' ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Status') ?></th>

                                    <td><?= ($receipt['statuscost']['title']) ? $receipt['statuscost']['title'] : '' ?></td>

                                </tr>
                                <tr>

                                    <th><?= __('Método de Pagamento') ?></th>

                                    <td><?= ($receipt['method']['title']) ? $receipt['method']['title'] : '' ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Valor') ?></th>

                                    <td><?= $this->Number->format($receipt->price) ?></td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>