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
                                Visualizar
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">
                        <div class="my-3">
                            <aside class="column">
                                <div class="side-nav">
                                    <h4 class="heading"><?= __('Ações') ?></h4>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $client->id], ['class' => 'side-nav-item']) ?>
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
                            <h3><?= h($client->nome) ?></h3>
                            <table class="table">
                                <tr>
                                    <th><?= __('Identificação') ?></th>
                                    <td><?= $this->Number->format($client->id) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Nome') ?></th>
                                    <td><?= h($client->nome) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('CPF') ?></th>
                                    <td><?= h($client->cpf) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Endereço') ?></th>
                                    <td><?= h($client->address) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Bairro') ?></th>
                                    <td><?= h($client->district) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Cidade') ?></th>
                                    <td><?= h($client->city) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Referência') ?></th>
                                    <td><?= h($client->reference) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('CEP') ?></th>
                                    <td><?= h($client->cep) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Telefone') ?></th>
                                    <td>
                                        <?php 
                                        $telefone = $client->phone;
                                        $phoneNumber = preg_replace("/[^0-9]/", "", $client->phone);
                                        $phoneQuantity = strlen($phoneNumber);
                                        $link = ($phoneQuantity == 9 || $phoneQuantity == 11) ? 'https://api.whatsapp.com/send?phone=+55' . $phoneNumber : 'tel:+55' . $phoneNumber;
                                        ?>
                                        <a href="<?php echo $link; ?>" target="_blank"><?= h($client->phone) ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?= __('Email') ?></th>
                                    <td><?= h($client->email) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Status') ?></th>
                                    <td><?= $client->has('status') ? $client->status->title : '' ?></td>
                                </tr>
                            </table>
                            <div class="related">
                                <h4 class="my-2"><?= __('Serviços Relacionados') ?></h4>
                                <?php if (!empty($client->services)) : ?>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th><?= __('Título') ?></th>
                                            <th><?= __('Data') ?></th>
                                            <th><?= __('Valor') ?></th>
                                            <th class="actions"><?= __('Ações') ?></th>
                                        </tr>
                                        <?php foreach ($client->services as $services) : ?>
                                        <tr>
                                            <td><?= h($services->title) ?></td>
                                            <td><?= h(strftime("%d/%m", strtotime($services->date))) ?></td>
                                            <td><?= h($services->price) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('Ver Serviço'), ['controller' => 'Services', 'action' => 'view', $services->id], ['class' => 'btn btn-pill mx-1 px-5 btn-primary']) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>