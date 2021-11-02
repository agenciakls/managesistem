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
                                    Agendamentos
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
                                    Clientes
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
                                    Serviços Pendentes
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3" style="height:70px;">
                            <canvas class="chart" id="card-chart3" height="70">
                            </canvas>
                        </div>
                    </div>
                </div>
                <?php
                if ($usuarioAtual['role_id'] == 1 || $usuarioAtual['role_id'] == 3 || $usuarioAtual['role_id'] == 4) {

                    ?>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-danger">
                                <div
                                    class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-value-lg">
                                            <?php echo $despesasQuantity; ?>
                                        </div>
                                        <div>
                                            Despesas
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-transparent dropdown-toggle p-0" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'costs', 'action' => 'index']); ?>">
                                                Calendário
                                            </a>
                                            <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'costs', 'action' => 'pesquisa']); ?>">
                                                Lista
                                            </a>
                                            <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'costs', 'action' => 'add']); ?>">
                                                Adicionar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart4" height="70">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                else {
                    ?>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-white bg-danger">
                                <div
                                    class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="text-value-lg">
                                            <?php echo $servicosCanceladosQuantity; ?>
                                        </div>
                                        <div>
                                            Serviços Cancelados
                                        </div>
                                    </div>
                                </div>
                                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                    <canvas class="chart" id="card-chart4" height="70">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
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
                $servicosCanceladosQuantity = 0;
                $servicosAguardandoQuantity = 0;
                $servicosConcluidosQuantity = 0;
                foreach ($arrayGraphics as $singleArray) {
                    $quantidadeServicos += $singleArray['servicosQuantity'];
                    $servicosCanceladosQuantity += $singleArray['servicosCanceladosQuantity'];
                    $servicosAguardandoQuantity += $singleArray['servicosAguardandoQuantity'];
                    $servicosConcluidosQuantity += $singleArray['servicosConcluidosQuantity'];
                }
                $concluidosPercent = ($servicosConcluidosQuantity && $quantidadeServicos) ? 100 * $servicosConcluidosQuantity / $quantidadeServicos : 0;
                $aguardandoPercent = ($servicosAguardandoQuantity && $quantidadeServicos) ? 100 * $servicosAguardandoQuantity / $quantidadeServicos : 0;
                $canceladosPercent = ($servicosCanceladosQuantity && $quantidadeServicos) ? 100 * $servicosCanceladosQuantity / $quantidadeServicos : 0;
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
                                Serviços Cancelados
                            </div>
                            <strong>
                                <?php echo $servicosCanceladosQuantity; ?> serviços (<?php echo number_format($canceladosPercent, 2); ?>%)
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
            <!-- /.card-->
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-header bg-facebook content-center">
                            <i class="fab fa-facebook-square text-white my-4 mx-2 c-icon c-icon-3xl"></i> <h2 class="text-white my-4"></h2>
                        </div>
                        <div class="card-body row text-center">
                            <div class="col">
                                <div class="text-value-xl">
                                    1.2k
                                </div>
                                <div class="text-uppercase text-muted small">
                                    Curtidas
                                </div>
                            </div>
                            <div class="c-vr">
                            </div>
                            <div class="col">
                                <div class="text-value-xl">
                                    120
                                </div>
                                <div class="text-uppercase text-muted small">
                                    posts
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-header bg-instagram content-center">
                            <i class="fab fa-instagram text-white my-4 c-icon c-icon-3xl"></i>
                        </div>
                        <div class="card-body row text-center">
                            <div class="col">
                                <div class="text-value-xl">
                                    1.4k
                                </div>
                                <div class="text-uppercase text-muted small">
                                    Seguidores
                                </div>
                            </div>
                            <div class="c-vr">
                            </div>
                            <div class="col">
                                <div class="text-value-xl">
                                    159
                                </div>
                                <div class="text-uppercase text-muted small">
                                    Posts
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-header bg-twitter content-center">
                            <i class="fab fa-twitter text-white my-4 c-icon c-icon-3xl"></i>
                        </div>
                        <div class="card-body row text-center">
                            <div class="col">
                                <div class="text-value-xl">
                                    0
                                </div>
                                <div class="text-uppercase text-muted small">
                                    seguidores
                                </div>
                            </div>
                            <div class="c-vr">
                            </div>
                            <div class="col">
                                <div class="text-value-xl">
                                    0
                                </div>
                                <div class="text-uppercase text-muted small">
                                    posts
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Dados de Usuários
                        </div>
                        <div class="card-body">
                            <?php /*
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="c-callout c-callout-info">
                                                <small class="text-muted">
                                                    New Clients
                                                </small>
                                                <div class="text-value-lg">
                                                    9,123
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                        <div class="col-6">
                                            <div class="c-callout c-callout-danger">
                                                <small class="text-muted">
                                                    Recuring Clients
                                                </small>
                                                <div class="text-value-lg">
                                                    22,643
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                    </div>
                                    <!-- /.row-->
                                    <hr class="mt-0">
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Monday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 34%" aria-valuenow="34" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 78%" aria-valuenow="78" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Tuesday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 56%" aria-valuenow="56" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Wednesday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 12%" aria-valuenow="12" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 67%" aria-valuenow="67" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Thursday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 43%" aria-valuenow="43" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 91%" aria-valuenow="91" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Friday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 22%" aria-valuenow="22" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 73%" aria-valuenow="73" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Saturday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 53%" aria-valuenow="53" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 82%" aria-valuenow="82" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">
                                                Sunday
                                            </span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: 9%" aria-valuenow="9" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: 69%" aria-valuenow="69" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="c-callout c-callout-warning">
                                                <small class="text-muted">
                                                    Pageviews
                                                </small>
                                                <div class="text-value-lg">
                                                    78,623
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                        <div class="col-6">
                                            <div class="c-callout c-callout-success">
                                                <small class="text-muted">
                                                    Organic
                                                </small>
                                                <div class="text-value-lg">
                                                    49,123
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col-->
                                    </div>
                                    <!-- /.row-->
                                    <hr class="mt-0">
                                    <div class="progress-group">
                                        <div class="progress-group-header">
                                            <svg class="c-icon progress-group-icon">
                                                <use
                                                    xlink:href="../node_modules/@coreui/icons/sprites/free.svg#cil-user">
                                                </use>
                                            </svg>
                                            <div>
                                                Male
                                            </div>
                                            <div class="mfs-auto font-weight-bold">
                                                43%
                                            </div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 43%" aria-valuenow="43" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-5">
                                        <div class="progress-group-header">
                                            <svg class="c-icon progress-group-icon">
                                                <use
                                                    xlink:href="../node_modules/@coreui/icons/sprites/free.svg#cil-user-female">
                                                </use>
                                            </svg>
                                            <div>
                                                Female
                                            </div>
                                            <div class="mfs-auto font-weight-bold">
                                                37%
                                            </div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 43%" aria-valuenow="43" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use
                                                    xlink:href="../node_modules/@coreui/icons/sprites/brand.svg#cib-google">
                                                </use>
                                            </svg>
                                            <div>
                                                Organic Search
                                            </div>
                                            <div class="mfs-auto font-weight-bold mfe-2">
                                                191.235
                                            </div>
                                            <div class="text-muted small">
                                                (56%)
                                            </div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 56%" aria-valuenow="56" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use
                                                    xlink:href="../node_modules/@coreui/icons/sprites/brand.svg#cib-facebook-f">
                                                </use>
                                            </svg>
                                            <div>
                                                Facebook
                                            </div>
                                            <div class="mfs-auto font-weight-bold mfe-2">
                                                51.223
                                            </div>
                                            <div class="text-muted small">
                                                (15%)
                                            </div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use
                                                    xlink:href="../node_modules/@coreui/icons/sprites/brand.svg#cib-twitter">
                                                </use>
                                            </svg>
                                            <div>
                                                Twitter
                                            </div>
                                            <div class="mfs-auto font-weight-bold mfe-2">
                                                37.564
                                            </div>
                                            <div class="text-muted small">
                                                (11%)
                                            </div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 11%" aria-valuenow="11" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                            <svg class="c-icon progress-group-icon">
                                                <use
                                                    xlink:href="../node_modules/@coreui/icons/sprites/brand.svg#cib-linkedin">
                                                </use>
                                            </svg>
                                            <div>
                                                LinkedIn
                                            </div>
                                            <div class="mfs-auto font-weight-bold mfe-2">
                                                27.319
                                            </div>
                                            <div class="text-muted small">
                                                (8%)
                                            </div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 8%" aria-valuenow="8" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                            */?>
                            <br>
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Foto</th>
                                        <th>Usuário</th>
                                        <th>Agendamentos</th>
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
                                                    <!-- <span class="c-avatar-status bg-success"></span> -->
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
            datasets: [{ label: "Serviços Pendentes", backgroundColor: "rgba(255,255,255,.2)", borderColor: "rgba(255,255,255,.55)", data: [<?php echo $implodesMonth['servicosAguardandoQuantity']; ?>] }],
        },
        options: { maintainAspectRatio: false, legend: { display: false }, scales: { xAxes: [{ display: false }], yAxes: [{ display: false }] }, elements: { line: { borderWidth: 2 }, point: { radius: 0, hitRadius: 10, hoverRadius: 4 } } },
    });
    var cardChart4 = new Chart(document.getElementById("card-chart4"), {
        type: "bar",
        data: {
            labels: [<?php echo $implodesMonth['titles']; ?>],
            datasets: [{ label: "Despesas", backgroundColor: "rgba(255,255,255,.2)", borderColor: "rgba(255,255,255,.55)", data: [<?php echo $implodesMonth['despesasQuantity']; ?>], barPercentage: 0.6 }],
        },
        options: { maintainAspectRatio: false, legend: { display: false }, scales: { xAxes: [{ display: false }], yAxes: [{ display: false }] } },
    });

    var chartLabels = [<?php echo $implodesDays['titles']; ?>];
    var chartData1 = [<?php echo $implodesDays['servicosQuantity']; ?>];
    var chartData2 = [<?php echo $implodesDays['servicosCanceladosQuantity']; ?>];

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
                    label: "Cancelamentos",
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