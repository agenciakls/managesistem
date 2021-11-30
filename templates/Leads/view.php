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
                                Visualizar
                            </div>
                        </div>
                    </div>
                    <div class="c-chart-wrapper my-3">
                        <div class="my-3">
                            <aside class="column">
                                <div class="side-nav">
                                    <h4 class="heading"><?= __('Ações') ?></h4>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lead->id], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $lead->id], ['confirm' => __('Tem certeza que deseja excluir # {0}?', $lead->name), 'class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Html->link(__('Usuários'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
                                </div>
                            </aside>
                        </div>
                        <div class="my-3">
                            <h3><?= h($lead->number) ?></h3>
                            <table class="table">
                                <tr>
                                    <th><?= __('Idendificação') ?></th>
                                    <td><?= $this->Number->format($lead->id) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Número de Telefone') ?></th>
                                    <td><?= h($lead->number) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Data') ?></th>
                                    <td><?= strftime("%d/%m/%Y", strtotime($lead->date)); ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Função') ?></th>
                                    <td><i class="flag fab"></i>
                                <?php 
                                switch ($lead->situation->id) {
                                    case 1: $color = 'warning'; break; // Agendado - Amarelo 
                                    case 2: $color = 'secondary'; break; // Cancelado - Cinza
                                    case 3: $color = 'success'; break; // Faturado - Verde
                                    case 4: $color = 'secondary'; break; // Reprovado - Cinza
                                    case 5: $color = 'warning'; break; // Em Contato - Amarelo
                                    case 6: $color = 'warning'; break; // Em Andamento - Amarelo
                                    case 7: $color = 'primary'; break; // Concluído - Azul
                                    case 8: $color = 'dark'; break; // Retorno - Preto
                                    case 9: $color = 'danger'; break; // Retorno Emergencial - Vermelho
                                    case 10: $color = 'purple'; break; // Resgate - Roxo
                                    case 11: $color = 'pink'; break; // Reagendado (Aviso ao Cliente) - Rosa
                                    default; $color = 'general'; break; // Sem Definição - Azul piscina
                                }
                                ?>
                                    <span class="badge badge-<?php echo $color; ?>"><?php echo $lead->situation->title; ?></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>