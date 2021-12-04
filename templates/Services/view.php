<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-body">
                    <div class="c-chart-wrapper my-3">
                        <div class="only-print">
                            <div class="row py-4">
                                <div class="col-md-5">
                                    <small>
                                        <p class="my-0 py-0"><strong>TELEFONE E SUPORTE</strong></p>
                                        <p class="my-0 py-0">(21) 9999-9999 / (21) 99999-9999</p>
                                    </small>
                                </div>
                                <div class="col-md-2">
                                    <img src="<?php echo $this->Url->build('/'); ?>img/logo-blue.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-5 text-right">
                                    <small>
                                        <p class="my-0 py-0"><strong>E-MAIL</strong></p>
                                        <p class="my-0 py-0">contato@teste.com.br</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="main-content">
                            <div class="content-divider jumbotron my-3 py-3">
                                <span class="content-divider-title">
                                    <i class="fas fa-cogs"></i> OS: <?php echo '#' . $service->os; ?>
                                </span>
                                <span class="no-print">
                                    -
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $service->id], ['class' => 'side-nav-item']) ?>
                                    -
                                    <?php
                                    if ($usuarioAtual['role_id'] == 1 || $usuarioAtual['role_id'] == 2) {
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
                                    <?php echo $service->client->address;?>
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
                                switch ($service->paid->id) {
                                    case 1: $color = 'warning'; break; // Aguardando Pagamento - Amarelo
                                    case 2: $color = 'success'; break; // Pagamento Efetuado - Verde
                                    case 3: $color = 'danger'; break; // Devolução Total - Vermelho
                                    case 4: $color = 'danger'; break; // Devolução Parcial - Vermelho
                                }
                                ?>
                                    <span class="badge badge-<?php echo $color; ?>"><?php echo $service->paid->title; ?></span>
                                    <i class="flag fab"></i>
                                </p>
                                <span class="no-print">
                                    <?php if ($usuarioAtual['role_id'] == 1 || $usuarioAtual['role_id'] == 2) { ?><a href=javascript:print();><button class="btn btn-pill mx-1 my-3 px-5 btn-primary">Imprimir Ordem</button></a><?php } ?>
                                    <a href="<?php echo $this->Url->build(['controller' => 'services', 'action' => 'rotas']); ?>?id=<?= $service->id; ?>"><button class="btn btn-pill mx-1 my-3 px-5 btn-primary">Copiar Para Zap</button></a>
                                </span>
                            </div>
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
                            if ($service->observation) {
                                ?>
                                <div class="content-divider jumbotron my-3 py-3">
                                    <h3>Observações</h3>
                                    <p><?php echo $service->observation; ?></p>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="edit-item-form"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
