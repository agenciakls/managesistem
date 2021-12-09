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
                                Pessoal
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


