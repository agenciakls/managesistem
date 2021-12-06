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
                                    <p>Clientes Atendidos</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $servicosQuantity; ?></h4>
                                    <p>Vendas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $servicosCanceladosQuantity; ?></h4>
                                    <p>Vendas Canceladas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $servicosAguardandoQuantity; ?></h4>
                                    <p>Entregas pendentes</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $despesasQuantity; ?></h4>
                                    <p>Despesas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4><?php echo $usuariosQuantity; ?></h4>
                                    <p>Representantes Ativos</p>
                                </div>
                            </div>
                            <hr>
                            <h3 class="py-3">Valores</h3>
                            <div class="row">
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalReceita, 2, ',', '.') ?></h4>
                                    <p>Valor Total de Vendas</p>
                                </div>
                                <div class="col-md-2 col-sm-    3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalServicos, 2, ',', '.') ?></h4>
                                    <p>Valor das Vendas Concluídas</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($totalServicosPendentes, 2, ',', '.') ?></h4>
                                    <p>Vendas Pendentes</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($comissaoDistribuidor, 2, ',', '.') ?></h4>
                                    <p>Comissão do distribuidor</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($comissaoRepresentante, 2, ',', '.') ?></h4>
                                    <p>Comissão do Representante</p>
                                </div>
                                <div class="col-md-2 col-sm-3 py-4 text-center">
                                    <h4>R$ <?php echo number_format($valorFinal, 2, ',', '.') ?></h4>
                                    <p>Valor Final</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
