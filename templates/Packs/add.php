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
                                Adicionar
                            </div>
                        </div>
                    </div>
                    <div class="c-chart-wrapper my-3">
                        <div class="my-3">
                            <?= $this->Form->create($pack) ?>
                            <fieldset>
                                <legend><?= __('Adicionar um Pacote') ?></legend>
                                <?php
                                    echo $this->Form->control('name', ['class' => 'input-contato', 'label' => 'Título', 'class' => 'form-control']);
                                    echo $this->Form->control('description', ['class' => 'input-contato', 'label' => 'Descrição', 'class' => 'form-control']);
                                    echo $this->Form->control('price', ['class' => 'input-contato', 'label' => 'Valor', 'class' => 'form-control']);
                                    echo $this->Form->control('status', ['label' => 'Status', 'options' => $statuses, 'class' => 'form-control']);
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Enviar'), ['class' => 'btn btn-pill mx-1 my-3 px-5 btn-primary']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>