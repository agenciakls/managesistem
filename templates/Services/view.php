<main class="c-main">

    <div class="container-fluid">

        <div class="fade-in">

            <!-- /.row-->

            <div class="card">

                <div class="card-body">



                    <div class="c-chart-wrapper my-3">



                        <div class="only-print">

                            <div class="row py-4">

                                <div class="col-md-5">

                                    <small>

                                        <p class="my-0 py-0"><strong>TELEFONE E SUPORTE</strong></p>

                                        <p class="my-0 py-0">(21) 3613-8404 / (21) 99174-2368</p>

                                    </small>

                                </div>

                                <div class="col-md-2">

                                    <img src="<?php echo $this->Url->build('/'); ?>img/logo-blue.png" class="img-fluid" alt="">

                                </div>

                                <div class="col-md-5 text-right">

                                    <small>

                                        <p class="my-0 py-0"><strong>E-MAIL</strong></p>

                                        <p class="my-0 py-0">contato@drlimpatudorj.com.br</p>

                                    </small>

                                </div>

                            </div>

                        </div>



                        <div class="main-content">

                            <!-- FLASH MESSAGE -->

                            <div class="content-divider jumbotron my-3 py-3">

                                <span class="content-divider-title">

                                <i class="fas fa-cogs"></i> OS: <?php echo '#' . $service->os; ?>

                                </span>

                                <span class="no-print">

                                    -

                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $service->id], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?php

                                    if ($usuarioAtual['role_id'] == 1) {

                                        echo $this->Form->postLink(__('Excluir'), ['action' => 'delete', $service->id], ['confirm' => __('Tem certeza que deseja excluir # {0}?', $service->title), 'class' => 'side-nav-item']) . ' - ';

                                    }

                                    ?>

                                    <?= $this->Html->link(__('Serviços'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>

                                    -

                                    <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>

                                    <div class="clear"></div>

                                </span>



                                <p>

                                    <i class="far fa-user"></i>

                                    <?= $service->has('client') ? $this->Html->link($service->client->nome . ' - ' . $service->client->cpf, ['controller' => 'Clients', 'action' => 'view', $service->client->id]) : '' ?>

                                <p>

                                    <i class="fas fa-map-marker-alt"></i>

                                    <?php

                                    $detailAddress = array(

                                        $service->client->address,

                                        $service->client->reference,

                                        $service->client->district,

                                        $service->client->city,

                                        $service->client->state,

                                        $service->client->cep,



                                    );

                                    $addressComplete = implode(',', $detailAddress); ?>

                                    <a target="_blank" href="http://maps.google.com/?q=<?php echo $addressComplete; ?>"><?php echo $addressComplete; ?></a></p>

                                <p>

                                    <i class="far fa-clock"></i>

                                    Data e Horário: <?= strftime("%d/%m/%Y - %H:%M", strtotime($service->date)); ?>



                                <p>

                                    <?php

                                    $telefone = $service->client->phone;

                                    $phoneNumber = preg_replace("/[^0-9]/", "", $service->client->phone);

                                    $phoneQuantity = strlen($phoneNumber);

                                    $link = ($phoneQuantity == 9 || $phoneQuantity == 11) ? 'https://api.whatsapp.com/send?phone=+55' . $phoneNumber : 'tel:+55' . $phoneNumber;

                                    $icon = ($phoneQuantity == 9 || $phoneQuantity == 11) ? '<i class="fab fa-whatsapp"></i>' : '<i class="fas fa-phone"></i>';

                                    ?>

                                    <?= $icon; ?> <a href="<?php echo $link; ?>" target="_blank"><?= h($service->client->phone) ?></a>

                                <p>

                                <p>

                                    <i class="far fa-envelope"></i>

                                    <a href="mailto:<?= h($service->client->email) ?>"><?= h($service->client->email) ?></a>

                                <p>

                                <?php

                                if ($sellerData) {

                                    ?>

                                    <p>

                                        <i class="fas fa-user-tie"></i>

                                        Atendimento: <?php echo $sellerData->name; ?>

                                    <p>

                                    <?php

                                }

                                ?>



                                <?php

                                if ($technicianData) {

                                    ?>

                                    <p>

                                        <i class="fas fa-user-cog"></i>

                                        Responsável: <?php echo $technicianData->name; ?>

                                    <p>

                                    <?php

                                }

                                ?>

                                <p>

                                <?php

                                if ($service->method->title) {

                                    ?>

                                    <p>

                                        <i class="fas fa-monney"></i>

                                        <?php echo $service->method->title; ?>

                                    <p>

                                    <?php

                                }

                                ?>

                                <p>

                                    <i class="flag fab"></i>

                                <?php

                                switch ($service->situation->id) {

                                    case 1: $color = 'warning'; break; // Agendado - Amarelo

                                    case 2: $color = 'secondary'; break; // Cancelado - Cinza

                                    case 3: $color = 'success'; break; // Faturado - Verde

                                    case 4: $color = 'disapproved'; break; // Reprovado - Lilás

                                    case 5: $color = 'warning'; break; // Em Contato - Amarelo

                                    case 6: $color = 'warning'; break; // Em Andamento - Amarelo

                                    case 7: $color = 'primary'; break; // Concluído - Azul

                                    case 8: $color = 'dark'; break; // Retorno - Preto

                                    case 9: $color = 'danger'; break; // Retorno Emergencial - Vermelho

                                    case 10: $color = 'purple'; break; // Resgate - Roxo

                                    case 11: $color = 'pink'; break; // Reagendado (Aviso ao Cliente) - Rosa

                                    case 12: $color = 'orange'; break; // Reagendado - Laranja

                                    default; $color = 'general'; break; // Sem Definição - Azul piscina

                                }

                                ?>

                                    <span class="badge badge-<?php echo $color; ?>"><?php echo $service->situation->title; ?></span>

                                    <i class="flag fab"></i>

                                <?php

                                switch ($service->paid->id) {

                                    case 1: $color = 'warning'; break;

                                    case 2: $color = 'danger'; break;

                                    case 3: $color = 'success'; break;

                                    case 4: $color = 'danger'; break;

                                    case 5: $color = 'warning'; break;

                                    case 6: $color = 'warning'; break;

                                    case 7: $color = 'primary'; break;

                                    default; $color = 'primary'; break;

                                }

                                ?>

                                    <span class="badge badge-<?php echo $color; ?>"><?php echo $service->paid->title; ?></span>

                                </p>



                                <span class="no-print">

                                    <a href=javascript:print();><button class="btn btn-pill mx-1 my-3 px-5 btn-primary">Imprimir Ordem</button></a>

                                    <a href="<?php echo $this->Url->build(['controller' => 'services', 'action' => 'rotas']); ?>?id=<?= $service->id; ?>"><button class="btn btn-pill mx-1 my-3 px-5 btn-primary">Copiar Para Zap</button></a>

                                    <a href="<?php echo $this->Url->build(['controller' => 'services', 'action' => 'rotas']); ?>?datestart=<?= strftime("%Y-%m-%d", strtotime($service->date)); ?>&technician_id=<?php echo $service->technician_id; ?>"><button class="btn btn-pill mx-1 my-3 px-5 btn-primary">Ver na Rota ZAP</button></a>

                                </span>



                            </div>



                            <!-- ITENS -->

                            <div class="content-divider jumbotron my-3 py-3">

                                <div class="content-divider-in">

                                    <table class="ui table">

                                        <thead>

                                            <tr>

                                                <th>Serviço/Produto</th>

                                                <th>Valor Unit.</th>

                                                <th>Qtd</th>

                                                <th>Total</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr class="item-36896">

                                                <td data-th="Serviço/Produto">

                                                    <p><b><?php echo $service->title;?></b></p>

                                                </td>

                                                <td width="15%" data-th="Valor Unit.">

                                                    <span class="nowrap">

                                                        R$ <?= number_format($service->price, 2, ',', '.') ?>

                                                    </span>

                                                </td>

                                                <td data-th="Qtd">1</td>

                                                <td width="15%" data-th="Total">

                                                    <span class="nowrap">

                                                        R$ <?= number_format($service->price, 2, ',', '.') ?>

                                                    </span>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>



                                    <div align="right" class="order-money-totals">

                                        <p><b>Total:</b> R$ <span class="total"><?php $valorTotal = (float) ($service->price) - ($service->discount); echo number_format($valorTotal, 2, ',', '.') ?></span></p>

                                    </div>

                                    <div class="clear"></div>

                                </div>

                            </div>



                            <?php



                            if ($service->detail || $service->voltagem) {

                                ?>

                                <!-- DETAILS -->

                                <div class="content-divider jumbotron my-3 py-3">

                                    <h3>Detalhes</h3>

                                    <?php if ($service->detail) { ?><p><?php echo $service->detail; ?></p><?php } ?>

                                    <?php if ($service->voltagem) { ?><p><strong>Voltagem: </strong> <?php echo $service->voltagem; ?></p><?php } ?>

                                </div>

                                <?php

                            }

                            if ($service->observation) {

                                ?>

                                <!-- OBSERVATIONS -->

                                <div class="content-divider jumbotron my-3 py-3">

                                    <h3>Observações</h3>

                                    <p><?php echo $service->observation; ?></p>

                                </div>

                                <?php

                            }

                            ?>



                            <div class="edit-item-form"></div>

                        </div>









                        <?php /* ?>

                        <div class="main-content">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="my-3">

                                        <aside class="column">

                                            <div class="side-nav">

                                                <h4 class="heading"><?= __('Ações') ?></h4>

                                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $service->id], ['class' => 'side-nav-item']) ?>

                                                -

                                                <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $service->id], ['confirm' => __('Tem certeza que deseja excluir # {0}?', $service->title), 'class' => 'side-nav-item']) ?>

                                                -

                                                <?= $this->Html->link(__('Serviços'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>

                                                -

                                                <?= $this->Html->link(__('Adicionar Novo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>

                                            </div>

                                        </aside>

                                    </div>

                                    <div class="my-3">

                                        <h3>Dados do Cliente</h3>

                                        <table class="table">

                                            <tr>

                                                <th><?= __('Nome') ?></th>

                                                <td><?= h($service->client->nome) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('CPF') ?></th>

                                                <td><?= h($service->client->cpf) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Endereço') ?></th>

                                                <td><?= h($service->client->address) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Bairro') ?></th>

                                                <td><?= h($service->client->district) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Cidade') ?></th>

                                                <td><?= h($service->client->city) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Referência') ?></th>

                                                <td><?= h($service->client->reference) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Telefone') ?></th>

                                                <td>

                                                    <?php

                                                    $telefone = $service->client->phone;

                                                    $phoneNumber = preg_replace("/[^0-9]/", "", $service->client->phone);

                                                    $phoneQuantity = strlen($phoneNumber);

                                                    $link = ($phoneQuantity == 9 || $phoneQuantity == 11) ? 'https://api.whatsapp.com/send?phone=+55' . $phoneNumber : 'tel:+55' . $phoneNumber;

                                                    ?>

                                                    <a href="<?php echo $link; ?>" target="_blank"><?= h($service->client->phone) ?></a>

                                                </td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Email') ?></th>

                                                <td><?= h($service->client->email) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Status') ?></th>

                                                <td><?= ($service->client->status->title) ? $service->client->status->title : '' ?></td>

                                            </tr>

                                        </table>

                                    </div>

                                    <div class="my-3">

                                        <h3>Dados do Serviço</h3>

                                        <table class="table">

                                            <tr>

                                                <th><?= __('Ordem de Serviço') ?></th>

                                                <td><?= $this->Number->format($service->id) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Serviço') ?></th>

                                                <td><?= h($service->title) ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Cliente') ?></th>

                                                <td><?= $service->has('client') ? $this->Html->link($service->client->nome, ['controller' => 'Clients', 'action' => 'view', $service->client->id]) : '' ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Situação') ?></th>

                                                <td><?= $service->has('situation') ? $service->situation->title : '' ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Data do Serviço') ?></th>

                                                <td><?= strftime("%d/%m/%Y - %H:%M", strtotime($service->date)); ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Observação') ?></th>

                                                <td><?= $service->observation; ?></td>

                                            </tr>

                                            <tr>

                                                <th><?= __('Valor') ?></th>

                                                <td><?= $this->Number->format($service->price) ?></td>

                                            </tr>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                        */ ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

