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

                                Adicionar

                            </div>

                        </div>

                    </div>



                    <div class="c-chart-wrapper my-3">

                        <div class="my-3">

                            <?= $this->Form->create($receipt) ?>

                            <fieldset>


                                <?php

                                    echo $this->Form->control('title', ['label' => 'Título', 'class' => 'form-control']);

                                    echo $this->Form->control('detalhes', ['label' => 'Detalhes', 'class' => 'form-control']);

                                    echo $this->Form->control('price', ['label' => 'Valor', 'class' => 'form-control']);

                                    echo $this->Form->control('date', ['class' => 'input-contato', 'label' => 'Data', 'class' => 'form-control']); 

                                    echo $this->Form->control('statuscost_id', ['label' => 'Status da Entrada', 'options' => $statuscosts, 'class' => 'form-control']);

                                    echo $this->Form->control('method_id', ['label' => 'Método de Pagamento', 'options' => $methods, 'class' => 'form-control']);

                                    echo $this->Form->control('expense_id', ['options' => $expenses, 'label' => 'Categoria', 'class' => 'form-control']);

                                ?>

                            </fieldset>

                            <?= $this->Form->button(__('Adicionar'), ['class' => 'btn btn-pill mx-1 px-5 my-3 btn-primary']) ?>

                            <?= $this->Form->end() ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>