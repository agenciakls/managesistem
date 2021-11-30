<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Clientes
                            </h4>
                            <div class="small text-muted">
                                Adicionar
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">

                        <div class="my-3">
                            <?= $this->Form->create($client) ?>
                            <fieldset>
                                <legend><?= __('Adicionar um Cliente') ?></legend>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('nome', ['label' => 'Nome/Razão Social', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('fantasy', ['label' => 'Nome Fantasia', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('cpf', ['label' => 'CPF', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('address', ['label' => 'Endereço Completo', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('phone', ['label' => 'Telefone', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('email', ['label' => 'E-mail', 'class' => 'form-control']); ?></div>
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
