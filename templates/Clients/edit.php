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
                                Editar
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">
                        <div class="my-3">
                            <aside class="column">
                                <div class="side-nav">
                                    <h4 class="heading"><?= __('Ações') ?></h4>
                                    <?= $this->Html->link(__('Ver Cliente'), ['action' => 'view', $client->id], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?php
                                    if ($usuarioAtual['role_id'] == 1) {
                                        echo $this->Form->postLink(__('Excluir'), ['action' => 'delete', $client->id], ['confirm' => __('Tem certeza que deseja excluir # {0}?', $client->nome), 'class' => 'side-nav-item']) . ' - ';
                                    }
                                    ?>
                                    <?= $this->Html->link(__('Clientes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
                                </div>
                            </aside>
                        </div>
                        <div class="my-3">
                            <?= $this->Form->create($client) ?>
                            <fieldset>
                                <legend><?= __('Editar Cliente') ?></legend>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('nome', ['label' => 'Nome/Razão Social', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('fantasy', ['label' => 'Nome Fantasia', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('cpf', ['label' => 'CPF', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('address', ['label' => 'Endereço Completo', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('phone', ['label' => 'Telefone', 'class' => 'form-control']); ?></div>
                                <div class="col-md-6 py-1"><?php echo $this->Form->control('email', ['label' => 'E-mail', 'class' => 'form-control']); ?></div>
                            </fieldset>
                            <?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-pill mx-1 my-3 px-5 btn-primary']) ?>
                            <?= $this->Form->end() ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
