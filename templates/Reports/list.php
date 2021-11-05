<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Relatórios
                            </h4>
                            <div class="small text-muted">
                                Lista
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">
                        <h3>
                            <?php
                            if ($mensagemStamp) {
                                ?>
                                <h3>
                                <?php echo $mensagemStamp; ?>
                                </h3>
                                <?php
                            }
                            ?>
                        </h3>
                        <div class="main-content">
                            <form action="" method="get">
                                <div class="row my-4">
                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="datestart" class="form-control" required="required" value="<?php if ($insertStart) { echo $insertStart; } ?>" data-validity-message="Este campo precisa ser preenchido" oninvalid="this.setCustomValidity(''); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity('')" id="date" step="1" value="">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="date" name="dateend" class="form-control" required="required" value="<?php if ($insertEnd) { echo $insertEnd; } ?>" data-validity-message="Este campo precisa ser preenchido" oninvalid="this.setCustomValidity(''); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity('')" id="date" step="1" value="">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <?php echo $this->Form->control('technician_id', ['label' => false, 'options' => $technicians, 'class' => 'form-control', 'default' => $technician_id]); ?>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <?php echo $this->Form->control('seller_id', ['label' => false, 'options' => $sellers, 'class' => 'form-control', 'default' => $seller_id]); ?>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <?php echo $this->Form->control('paid_id', ['label' => false, 'options' => $paidsLabel, 'class' => 'form-control', 'default' => $paid_id]); ?>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <?php echo $this->Form->control('method_id', ['label' => false, 'options' => $methodsLabel, 'class' => 'form-control', 'default' => $method_id]); ?>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <?php echo $this->Form->control('situation_id', ['label' => false, 'options' => $situationsLabel, 'class' => 'form-control', 'default' => $situation_id]); ?>
                                    </div>
                                    <div class="col-md-12 py-3">
                                        <?= $this->Form->button(__('Filtrar '), ['class' => 'btn btn-pill mx-1 px-5 btn-primary float-right']) ?>
                                        <?= $this->Html->link(__('Voltar aos Relatórios'), ['action' => 'index'], ['class' => 'btn btn-pill mx-1 px-5 btn-primary float-right']) ?>
                                    </div>
                                </div>
                                <?php
                                if ($mensagemPeriodo) {
                                    ?>
                                    <div class="alert alert-warning" role="alert">
                                    <?php echo $mensagemPeriodo; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </form>
                        </div>
                        <div class="main-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Serviço</th>
                                                <th>Data</th>
                                                <th>Cliente</th>
                                                <th>Valor</th>
                                                <th>Situação</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($services as $service) {
                                            ?>
                                            <tr>
                                                <td><?= $this->Html->link($service->title . ' (' . $service->client->district . ')', ['controller' => 'Services', 'action' => 'view', $service->id]) ?></td>
                                                <td><?= strftime("%d/%m", strtotime($service->date)); ?></td>
                                                <td><?= $service->has('client') ? $this->Html->link($service->client->nome, ['controller' => 'Clients', 'action' => 'view', $service->client->id]) : '' ?></td>
                                                <td><?php $valorTotal = (float) ($service->price) - ($service->discount); echo number_format($valorTotal, 2, ',', '.') ?></td>
                                                <td><?php
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
                                                    default; $color = 'general'; break; // Sem Definição - Azul piscina
                                                }
                                                ?>
                                    <span class="badge badge-<?php echo $color; ?>"><?php echo $service->situation->title; ?></span>
                                    <i class="flag fab"></i></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4"><?php echo $this->Form->control('paid_id', ['label' => false, 'options' => $paids, 'class' => 'form-control save-paid', 'id-service' => $service->id, 'default' => $service->paid_id]); ?></div>
                                                        <div class="col-md-4"><?php echo $this->Form->control('method_id', ['label' => false, 'options' => $methods, 'class' => 'form-control save-method', 'id-service' => $service->id, 'default' => $service->method_id]); ?></div>
                                                        <div class="col-md-4"><?php echo $this->Form->control('situation_id', ['class' => 'input-contato', 'label' => false, 'options' => $situations, 'class' => 'form-control save-situation', 'id-service' => $service->id, 'default' => $service->situation_id]); ?></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="paginator">
                                <ul class="col-md-12 pagination">
                                    <?= $this->Paginator->first('<< ' . __('Primeira')) ?>
                                    <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next(__('Próxima') . ' >') ?>
                                    <?= $this->Paginator->last(__('Última') . ' >>') ?>
                                </ul>
                                <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} resultados de {{count}} no total')) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        var paidAction = $(".save-paid");
        var methodAction = $(".save-method");
        var situationAction = $(".save-situation");

        var saveAction = function (contentAction = false, action = false) {
            var idService = contentAction.attr('id-service');
            var valueService = contentAction.val();
            var actionService = action;
            if (contentAction != false && action != false) {
                $.post('<?php echo $this->Url->build(['controller' => 'get', 'action' => 'savestatus']); ?>', {
                    id: idService,
                    field: actionService,
                    value: valueService
                })
                .done(function (contentReturn) {
                    contentResponse = JSON.parse(contentReturn);
                    console.log(contentResponse.response);
                })
                .fail(function () {
                    alert('Houve um erro ao salvar, verifique a internet ou informe o problema.');
                });
            }
        }
        paidAction.on('change', function () {
            saveAction($(this), 'paid');
        });
        methodAction.on('change', function () {
            saveAction($(this), 'method');
        });
        situationAction.on('change', function () {
            saveAction($(this), 'situation');
        });
    })
</script>
