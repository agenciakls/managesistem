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

                                Editar

                            </div>

                        </div>

                    </div>



                    <div class="c-chart-wrapper my-3">

                        <div class="my-3">

                            <aside class="column">

                                <div class="side-nav">

                                    <h4 class="heading"><?= __('Ações') ?></h4>

                                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $cost->id], ['confirm' => __('Tem certeza que deseja excluir {0}?', $cost->title), 'class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Despesas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>

                                </div>

                            </aside>

                        </div>

                        <div class="my-3">

                            <?= $this->Form->create($cost) ?>

                            <fieldset>

                                <legend><?= __('Editar Despesa') ?></legend>

                                <?php

                                    echo $this->Form->control('title', ['label' => 'Título', 'class' => 'form-control']);

                                    echo $this->Form->control('detalhes', ['label' => 'Detalhes', 'class' => 'form-control']);

                                    echo $this->Form->control('price', ['label' => 'Valor', 'class' => 'form-control']);

                                    echo $this->Form->control('date', ['class' => 'input-contato', 'label' => 'Data', 'class' => 'form-control']); 

                                    echo $this->Form->control('statuscost_id', ['label' => 'Status da Despesa', 'options' => $statuscosts, 'class' => 'form-control']);

                                    echo $this->Form->control('method_id', ['label' => 'Método de Pagamento', 'options' => $methods, 'class' => 'form-control']);

                                    echo $this->Form->control('expense_id', ['options' => $expenses, 'label' => 'Categoria', 'class' => 'form-control']);

                                ?>

                            </fieldset>

                            <?= $this->Form->button(__('Salvar')) ?>

                            <?= $this->Form->end() ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>