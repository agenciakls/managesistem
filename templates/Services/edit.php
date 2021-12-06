<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Vendas
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
                                    <?= $this->Html->link(__('Ver Serviço'), ['action' => 'view', $service->id], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?php
                                    if ($usuarioAtual['role_id'] == 1 || $usuarioAtual['role_id'] == 2) {
                                        echo $this->Form->postLink(__('Excluir'), ['action' => 'delete', $service->id], ['confirm' => __('Tem certeza que deseja excluir # {0}?', $service->title), 'class' => 'side-nav-item']) . ' - ';
                                    }
                                    ?>
                                    <?= $this->Html->link(__('Serviços'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
                                </div>
                            </aside>
                        </div>
                        <div class="my-3">
                            <?= $this->Form->create($service) ?>
                            <fieldset>
                                <legend><?= __('Adicionar Serviço') ?></legend>
                                <div class="row">
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('date', ['class' => 'input-contato', 'label' => 'Data da venda', 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('delivery', ['class' => 'input-contato', 'label' => 'Previsão de entrega', 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('date_end', ['class' => 'input-contato', 'label' => 'Prazo de pagamento', 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('weight', ['class' => 'input-contato', 'label' => 'Quantidade em kg', 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('pack_id', ['class' => 'input-contato', 'label' => 'Produtos', 'options' => $packs, 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('seller_id', ['label' => 'Vendedor ou Atendente', 'options' => $sellers, 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('method_id', ['label' => 'Modalidade de pagamento', 'options' => $methods, 'class' => 'form-control']); ?></div>
                                    <div class="col-md-6 py-1"><?php echo $this->Form->control('paid_id', ['label' => 'Status do Pagamento', 'options' => $paids, 'class' => 'form-control']); ?></div>
                                </div>
                                <?php echo $this->Form->control('observation', ['label' => 'Observação da entrega', 'type' => 'textarea', 'class' => 'form-control']); ?>
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
