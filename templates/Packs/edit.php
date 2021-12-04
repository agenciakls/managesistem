<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-bnody">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Pacotes
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
                                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $pack->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pack->id), 'class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Html->link(__('Pacotes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
                                </div>
                            </aside>
                        </div>
                        <div class="my-3">
                            <?= $this->Form->create($pack) ?>
                            <fieldset>
                                <legend><?= __('Editar Pacote') ?></legend>
                                <?php
                                    echo $this->Form->control('name', ['label' => 'Título', 'class' => 'form-control']);
                                    echo $this->Form->control('description', ['label' => 'Descrição', 'class' => 'form-control']);
                                    echo $this->Form->control('price', ['label' => 'Valor', 'class' => 'form-control']);
                                    echo $this->Form->control('status', ['label' => 'Status', 'options' => $statuses, 'class' => 'form-control']);
                                ?>
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