<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Serviços
                            </h4>
                            <div class="small text-muted">
                                Adicionar Novo
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="my-3">
                                <?= $this->Form->create($service) ?>
                                <fieldset>
                                    <legend><?= __('Adicionar Serviço') ?></legend>
                                    <div class="row">
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('nome', ['label' => 'Nome/Razão Social', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('fantasy', ['label' => 'Nome Fantasia', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('cpf', ['label' => 'CPF', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('address', ['label' => 'Endereço Completo', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('phone', ['label' => 'Telefone', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('email', ['label' => 'E-mail', 'class' => 'form-control']); ?></div>
                                        <hr class="my-4 line">
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('title', ['class' => 'input-contato', 'label' => 'Nome do Produto', 'options' => $packs, 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('date', ['class' => 'input-contato', 'label' => 'Data da venda', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('date_end', ['class' => 'input-contato', 'label' => 'Previsão de entrega', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('date_end', ['class' => 'input-contato', 'label' => 'Prazo de pagamento', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('price', ['class' => 'input-contato', 'label' => 'Valor', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('weight', ['class' => 'input-contato', 'label' => 'Quantidade em kg', 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('seller_id', ['label' => 'Vendedor ou Atendente', 'options' => $sellers, 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('method_id', ['label' => 'Forma de Pagamento', 'options' => $methods, 'class' => 'form-control']); ?></div>
                                        <div class="col-md-6 py-1"><?php echo $this->Form->control('paid_id', ['label' => 'Status do Pagamento', 'options' => $paids, 'class' => 'form-control']); ?></div>
                                    </div>
                                    <?php echo $this->Form->control('observation', ['label' => 'Observação', 'type' => 'textarea', 'class' => 'form-control']); ?>
                                </fieldset>
                                <?= $this->Form->button(__('Adicionar'), ['class' => 'btn btn-pill mx-1 my-3 px-5 btn-primary']) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>

            </div>
                </div>
            </div>
        </div>
    </div>
</main>
