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
                                <?php
                                    echo $this->Form->control('nome', ['label' => 'Nome', 'class' => 'form-control']);
                                    echo $this->Form->control('cpf', ['label' => 'CPF', 'class' => 'form-control']);
                                    echo $this->Form->control('address', ['label' => 'Endereço', 'class' => 'form-control']);
                                    echo $this->Form->control('district', ['label' => 'Bairro', 'class' => 'form-control']);
                                    echo $this->Form->control('city', ['label' => 'Cidade', 'class' => 'form-control']);
                                    echo $this->Form->control('reference', ['label' => 'Referência', 'class' => 'form-control']);
                                    echo $this->Form->control('cep', ['label' => 'CEP', 'class' => 'form-control']);
                                    echo $this->Form->control('phone', ['label' => 'Telefone', 'class' => 'form-control']);
                                    echo $this->Form->control('email', ['label' => 'E-mail', 'class' => 'form-control']);
                                    echo $this->Form->control('status_id', ['options' => $statuses, 'class' => 'form-control']);
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Adicionar')) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>