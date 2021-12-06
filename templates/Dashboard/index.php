<style>
.disabled .fc-day-content {
background-color: #123959 !important;
color: #FFFFFF;
cursor: default;
}
</style>
<?php

$listTitles = array();
foreach ($arrayGraphics as $titleGraphics => $valueGraphics) {
    $listTitles['titles'][] = '"' . $titleGraphics . '"';
    foreach ($valueGraphics as $titleValue => $valueSingle) {
        $listTitles[$titleValue][] = $valueSingle;
    }
}
$implodesDays = array();
foreach ($listTitles as $nameTitles => $valueTitles) {
    $implodesDays[$nameTitles] = implode(', ', $valueTitles);
}
$listMonths = array();
foreach ($monthGraphics as $titleMonth => $valueMonth) {
    $listMonths['titles'][] = '"' . $titleMonth . '"';
    foreach ($valueMonth as $titleMonth => $vlMonth) {
        $listMonths[$titleMonth][] = $vlMonth;
    }
}
$implodesMonth = array();
foreach ($listMonths as $nameMonth => $vlMonth) {
    $implodesMonth[$nameMonth] = implode(', ', $vlMonth);
}
?>
<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-info">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">
                                    <?php echo $servicosQuantity; ?>
                                </div>
                                <div>
                                    Cadastro de pedidos/vendas
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'services', 'action' => 'index']); ?>">
                                        Calendário
                                    </a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'services', 'action' => 'pesquisa']); ?>">
                                        Lista
                                    </a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'services', 'action' => 'add']); ?>">
                                        Adicionar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart2" height="70">
                            </canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">
                                    <?php echo $clientesQuantity; ?>
                                </div>
                                <div>
                                    Clientes Cadastrados
                                </div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'clients', 'action' => 'index']); ?>">
                                        Lista
                                    </a>
                                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'clients', 'action' => 'add']); ?>">
                                        Adicionar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart1" height="70">
                            </canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-warning">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">
                                    <?php echo $servicosAguardandoQuantity; ?>
                                </div>
                                <div>
                                    Entregas Pendentes
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3" style="height:70px;">
                            <canvas class="chart" id="card-chart3" height="70">
                            </canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">
                                    <?php echo $servicosAtrasadosQuantity; ?>
                                </div>
                                <div>
                                    Entregas atrasadas
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart4" height="70">
                            </canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-warning">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">
                                    <?php echo $produtosQuantity; ?>
                                </div>
                                <div>
                                    Produtos cadastrados
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3" style="height:70px;">
                            <canvas class="chart" id="card-chart5" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Agendamentos
                            </h4>
                            <div class="small text-muted">
                                últimos 15 dias e próximos 15 dias
                            </div>
                        </div>
                        <div class="btn-toolbar d-none d-md-block" role="toolbar"
                            aria-label="Toolbar with buttons">

                            <a href="<?= $this->Url->build(['controller' => 'reports']); ?>"><button class="btn btn-primary" type="button">Relatórios</button></a>
                        </div>
                    </div>
                    <div class="c-chart-wrapper" style="min-height:300px;margin-top:40px;">

                        <canvas class="chart" id="main-chart" height="300"></canvas>

                    </div>
                </div>
                <?php
                $quantidadeServicos = 0;
                $servicosAtrasadosQuantity = 0;
                $servicosAguardandoQuantity = 0;
                $servicosConcluidosQuantity = 0;
                foreach ($arrayGraphics as $singleArray) {
                    $quantidadeServicos += $singleArray['servicosQuantity'];
                    $servicosAtrasadosQuantity += $singleArray['servicosAtrasadosQuantity'];
                    $servicosAguardandoQuantity += $singleArray['servicosAguardandoQuantity'];
                    $servicosConcluidosQuantity += $singleArray['servicosConcluidosQuantity'];
                }
                $concluidosPercent = ($servicosConcluidosQuantity && $quantidadeServicos) ? 100 * $servicosConcluidosQuantity / $quantidadeServicos : 0;
                $aguardandoPercent = ($servicosAguardandoQuantity && $quantidadeServicos) ? 100 * $servicosAguardandoQuantity / $quantidadeServicos : 0;
                $canceladosPercent = ($servicosAtrasadosQuantity && $quantidadeServicos) ? 100 * $servicosAtrasadosQuantity / $quantidadeServicos : 0;
                ?>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">
                                Serviços
                            </div>
                            <strong>
                            <?php echo $quantidadeServicos; ?> serviços
                            </strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">
                                Serviços Concluidos
                            </div>
                            <strong>
                            <?php echo $servicosConcluidosQuantity; ?> serviços (<?php echo number_format($concluidosPercent, 2); ?>)
                            </strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $concluidosPercent; ?>%"
                                    aria-valuenow="<?php echo $concluidosPercent; ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">
                                Serviços Pendentes
                            </div>
                            <strong>
                            <?php echo $servicosAguardandoQuantity; ?> serviços (<?php echo number_format($aguardandoPercent, 2); ?>%)
                            </strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $aguardandoPercent; ?>%"
                                    aria-valuenow="<?php echo $aguardandoPercent; ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md mb-sm-2 mb-0">
                            <div class="text-muted">
                                Serviços Atrasados
                            </div>
                            <strong>
                                <?php echo $servicosAtrasadosQuantity; ?> serviços (<?php echo number_format($canceladosPercent, 2); ?>%)
                            </strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $canceladosPercent; ?>%"
                                    aria-valuenow="<?php echo $canceladosPercent; ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if ($usuarioAtual['role_id'] == 1 || $usuarioAtual['role_id'] == 2 ) {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Comparativo de Vendas
                                </div>
                                <div class="card-body">
                                    <br>
                                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">Foto</th>
                                                <th>Usuário</th>
                                                <th>Pedidos/Vendas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($users as $user) {
                                                $idCurrent = $user->id;
                                                $valueCurrent = $usersResults[$idCurrent];
                                                $percent = ($valueCurrent && $servicosQuantity) ? $valueCurrent * 100 / $servicosQuantity : 0;
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="c-avatar">
                                                            <img class="c-avatar-img" src="<?php if ($user->img) { echo $this->Url->build('/') . 'img/uploads/' . $user->img; } else  { echo $this->Url->build('/') . 'img/uploads/default.jpg'; } ?>"
                                                                alt="user@email.com">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div><?php echo $user->name; ?></div>
                                                        <div class="small text-muted">
                                                            @<?php echo $user->username; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="clearfix">
                                                            <div class="float-left"><strong><?php echo $valueCurrent; ?> venda(s)</strong></div>
                                                            <div class="float-right">
                                                                <small class="text-muted"><?php echo $servicosQuantity; ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percent; ?>%" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
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
                        </div>
                        <!-- /.col-->
                    </div>
                    <?php
                }

            ?>
            <!-- /.row-->
        </div>
    </div>
</main>
<script src="<?php echo $this->Url->build('/'); ?>node_modules/@coreui/utils/dist/coreui-utils.js"></script>
<script src="<?php echo $this->Url->build('/'); ?>node_modules/@coreui/chartjs/dist/js/coreui-chartjs.bundle.js"></script>
<script>
        Chart.defaults.global.pointHitDetectionRadius = 1;
    Chart.defaults.global.tooltips.enabled = false;
    Chart.defaults.global.tooltips.mode = "index";
    Chart.defaults.global.tooltips.position = "nearest";
    Chart.defaults.global.tooltips.custom = coreui.ChartJS.customTooltips;
    Chart.defaults.global.defaultFontColor = "#646470";
    Chart.defaults.global.responsiveAnimationDuration = 1;
    document.body.addEventListener("classtoggle", function (event) {
        if (event.detail.className === "c-dark-theme") {
            if (document.body.classList.contains("c-dark-theme")) {
                cardChart1.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle("--primary-dark-theme");
                cardChart2.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle("--info-dark-theme");
                Chart.defaults.global.defaultFontColor = "#fff";
            } else {
                cardChart1.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle("--primary");
                cardChart2.data.datasets[0].pointBackgroundColor = coreui.Utils.getStyle("--info");
                Chart.defaults.global.defaultFontColor = "#646470";
            }
            cardChart1.update();
            cardChart2.update();
            mainChart.update();
        }
    });
    var cardChart1 = new Chart(document.getElementById("card-chart1"), {
        type: "line",
        data: {
            labels: [<?php echo $implodesMonth['titles']; ?>],
            datasets: [{ label: "Agendados", backgroundColor: "transparent", borderColor: "rgba(255,255,255,.55)", pointBackgroundColor: coreui.Utils.getStyle("--primary"), data: [<?php echo $implodesMonth['servicosQuantity']; ?>] }],
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: { xAxes: [{ gridLines: { color: "transparent", zeroLineColor: "transparent" }, ticks: { fontSize: 2, fontColor: "transparent" } }], yAxes: [{ display: false, ticks: { display: false,  } }] },
            elements: { line: { borderWidth: 1 }, point: { radius: 4, hitRadius: 10, hoverRadius: 4 } },
        },
    });
    var cardChart2 = new Chart(document.getElementById("card-chart2"), {
        type: "line",
        data: {
            labels: [<?php echo $implodesMonth['titles']; ?>],
            datasets: [{ label: "Serviços", backgroundColor: "transparent", borderColor: "rgba(255,255,255,.55)", pointBackgroundColor: coreui.Utils.getStyle("--info"), data: [<?php echo $implodesMonth['servicosQuantity']; ?>] }],
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: { xAxes: [{ gridLines: { color: "transparent", zeroLineColor: "transparent" }, ticks: { fontSize: 2, fontColor: "transparent" } }], yAxes: [{ display: false, ticks: { display: false,  } }] },
            elements: { line: { tension: 0.00001, borderWidth: 1 }, point: { radius: 4, hitRadius: 10, hoverRadius: 4 } },
        },
    });
    var cardChart3 = new Chart(document.getElementById("card-chart3"), {
        type: "line",
        data: {
            labels: [<?php echo $implodesMonth['titles']; ?>],
            datasets: [{ label: "Pendentes", backgroundColor: "rgba(255,255,255,.2)", borderColor: "rgba(255,255,255,.55)", data: [<?php echo $implodesMonth['servicosAguardandoQuantity']; ?>] }],
        },
        options: { maintainAspectRatio: false, legend: { display: false }, scales: { xAxes: [{ display: false }], yAxes: [{ display: false }] }, elements: { line: { borderWidth: 2 }, point: { radius: 0, hitRadius: 10, hoverRadius: 4 } } },
    });
    var cardChart4 = new Chart(document.getElementById("card-chart4"), {
        type: "bar",
        data: {
            labels: [<?php echo $implodesMonth['titles']; ?>],
            datasets: [{ label: "Atrasados", backgroundColor: "rgba(255,255,255,.2)", borderColor: "rgba(255,255,255,.55)", data: [<?php echo $implodesMonth['servicosAtrasadosQuantity']; ?>], barPercentage: 0.6 }],
        },
        options: { maintainAspectRatio: false, legend: { display: false }, scales: { xAxes: [{ display: false }], yAxes: [{ display: false }] } },
    });

    var chartLabels = [<?php echo $implodesDays['titles']; ?>];
    var chartData1 = [<?php echo $implodesDays['servicosQuantity']; ?>];
    var chartData2 = [<?php echo $implodesDays['servicosAguardandoQuantity']; ?>];

    var mainChart = new Chart(document.getElementById("main-chart"), {
        type: "line",
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: "Serviços",
                    backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle("--info"), 10),
                    borderColor: coreui.Utils.getStyle("--info"),
                    pointHoverBackgroundColor: "#fff",
                    borderWidth: 2,
                    data: chartData1,
                },
                {
                    label: "Pendentes",
                    backgroundColor: "transparent",
                    borderColor: coreui.Utils.getStyle("--danger"),
                    pointHoverBackgroundColor: "#fff",
                    borderWidth: 2,
                    data: chartData2,
                }
            ],
        },
        options: {
            maintainAspectRatio: false,
            legend: { display: false },
            scales: { xAxes: [{ gridLines: { drawOnChartArea: false } }], yAxes: [{ ticks: { beginAtZero: true, maxTicksLimit: 5 } }] },
            elements: { point: { radius: 0, hitRadius: 10, hoverRadius: 4, hoverBorderWidth: 3 } },
        },
    });
</script>
