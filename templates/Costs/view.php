<main class="c-main">

    <div class="container-fluid">

        <div class="fade-in">

            <!-- /.row-->

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h4 class="card-title mb-0">

                                Despesas

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

                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $cost->id], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $cost->id], ['confirm' => __('Tem certeza que deseja excluir {0}?', $cost->title), 'class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Despesas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>

                                </div>

                            </aside>

                        </div>

                        <div class="my-3">

                            <h3><?= h($cost->title) ?></h3>

                            <table class="table">

                                <tr>

                                    <th><?= __('Identificação') ?></th>

                                    <td><?= $this->Number->format($cost->id) ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Título') ?></th>

                                    <td><?= h($cost->title) ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Detalhes') ?></th>

                                    <td><?= h($cost->detalhes) ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Categoria') ?></th>

                                    <td><?= ($cost['expense']['title']) ? $cost['expense']['title'] : '' ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Status') ?></th>

                                    <td><?= ($cost['statuscost']['title']) ? $cost['statuscost']['title'] : '' ?></td>

                                </tr>
                                <tr>

                                    <th><?= __('Método de Pagamento') ?></th>

                                    <td><?= ($cost['method']['title']) ? $cost['method']['title'] : '' ?></td>

                                </tr>

                                <tr>

                                    <th><?= __('Valor') ?></th>

                                    <td><?= $this->Number->format($cost->price) ?></td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>