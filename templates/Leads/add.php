<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Leads
                            </h4>
                            <div class="small text-muted">
                                Adicionar um Lead
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">
                        <div class="my-3">
                            <?= $this->Form->create($lead) ?>
                            <fieldset>
                                <legend><?= __('Adicionar Lead') ?></legend>
                                <div class="row">
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('number', ['class' => 'input-contato', 'label' => 'Número de Telefone', 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('date', ['class' => 'input-contato', 'label' => 'Data', 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('situation_id', ['class' => 'input-contato', 'label' => 'Situação do Serviço', 'options' => $situations, 'class' => 'form-control']); ?></div>
                                </div>
                            </fieldset>
                            <?= $this->Form->button(__('Adicionar'), ['class' => 'btn btn-pill mx-1 my-3 px-5 btn-primary']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>