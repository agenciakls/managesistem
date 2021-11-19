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
                                Métricas
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
                                    <div class='col-md-3'>
                                        <input type="date" name="datestart" class="form-control" required="required" value="<?php if ($insertStart) { echo $insertStart; } ?>" data-validity-message="Este campo precisa ser preenchido" oninvalid="this.setCustomValidity(''); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity('')" id="date" step="1" value="">
                                    </div>
                                    <div class='col-md-3'>
                                        <input type="date" name="dateend" class="form-control" required="required" value="<?php if ($insertEnd) { echo $insertEnd; } ?>" data-validity-message="Este campo precisa ser preenchido" oninvalid="this.setCustomValidity(''); if (!this.value) this.setCustomValidity(this.dataset.validityMessage)" oninput="this.setCustomValidity('')" id="date" step="1" value="">
                                    </div>
                                    <div class="col-md-3">
                                        <?php echo $this->Form->control('technician_id', ['label' => false, 'options' => $technicians, 'class' => 'form-control']); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?php echo $this->Form->control('seller_id', ['label' => false, 'options' => $sellers, 'class' => 'form-control']); ?>
                                    </div>
                                </div>
                                <?= $this->Form->button(__('Filtrar '), ['class' => 'btn btn-pill mx-1 px-5 btn-primary float-right']) ?>
                                <?= $this->Html->link(__('Voltar aos Relatórios'), ['action' => 'index'], ['class' => 'btn btn-pill mx-1 px-5 btn-primary float-right']) ?>
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

                            <h3 class="py-3">Métricas</h3>
                            <div class="row">
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $clientesQuantity; ?></h4>
                                    <p>Cliente(s)</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $servicosQuantity; ?></h4>
                                    <p>Serviço(s)</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $servicosCanceladosQuantity; ?></h4>
                                    <p>Serviço(s) Cancelado(s)</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $servicosAguardandoQuantity; ?></h4>
                                    <p>Serviço(s) Pendentes</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $despesasQuantity; ?></h4>
                                    <p>Despesas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $usuariosQuantity; ?></h4>
                                    <p>Técnicos Disponíveis</p>
                                </div>
                            </div>
                            <hr>
                            <h3 class="py-3">Valores</h3>
                            <div class="row">
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalReceita, 2, ',', '.') ?></h4>
                                    <p>Receita de Serviços</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalServicos, 2, ',', '.') ?></h4>
                                    <p>Serviços Concluídos</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalServicosPendentes, 2, ',', '.') ?></h4>
                                    <p>Serviços Pendentes</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalServicosCancelado, 2, ',', '.') ?></h4>
                                    <p>Serviços Cancelados</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalDespesas, 2, ',', '.') ?></h4>
                                    <p>Total de Despesas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalDespesasPagas, 2, ',', '.') ?></h4>
                                    <p>Total de Despesas Pagas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($lucroAtual, 2, ',', '.') ?></h4>
                                    <p>Lucro Atual</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($lucroFuturo, 2, ',', '.') ?></h4>
                                    <p>Previsão de Fechamento</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
