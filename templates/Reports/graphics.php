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
                                Gráficos
                            </div>
                        </div>
                    </div>

                    <div class="c-chart-wrapper my-3">
                        <div class="row">
                            <div class="col-md-6 my-3">
                                <h3>Previsão comissão distribuição x Comissão representante;</h3>
                                <canvas id="previsaoComparativoComissoes"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Faturamento distribuidor x Comissão de representantes (Realizado)</h3>
                                <canvas id="comparativoComissoes"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Previsão faturamento distribuidor</h3>
                                <canvas id="previsaoFaturamentoDistribuidor"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Faturamento realizado</h3>
                                <canvas id="faturamentoRealizado"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Total Despesas</h3>
                                <canvas id="totalDespesas"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Quantidade de Vendas</h3>
                                <canvas id="quantityServicos"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Lucro sobre Despesas</h3>
                                <canvas id="lucroAtual"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Quantidade de Despesas</h3>
                                <canvas id="quantityDespesas"></canvas>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>

var ctxVlServicos = document.getElementById('previsaoComparativoComissoes').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Previsão do Distribuidor',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['previsaoComissaoDistribuidor'] . '\','; } ?>
            ]
        }, {
            label: 'Previsão do representante',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(155, 0, 0)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['previsaoComissaoRepresentante'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxVlServicos = document.getElementById('comparativoComissoes').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Comissão do Distribuidor',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['comissaoDistribuidor'] . '\','; } ?>
            ]
        }, {
            label: 'Comissão do representante',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(155, 0, 0)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['comissaoRepresentante'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxVlServicos = document.getElementById('faturamentoRealizado').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Total Faturado',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['comissaoDistribuidor'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxVlServicos = document.getElementById('previsaoFaturamentoDistribuidor').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Receita Total',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['previsaoComissaoDistribuidor'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxServicos = document.getElementById('totalDespesas').getContext('2d');
var chartServicos = new Chart(ctxServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Total Despesas',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalDespesas'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxServicos = document.getElementById('lucroAtual').getContext('2d');
var chartServicos = new Chart(ctxServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Lucro Atual',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['lucroAtual'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxServicos = document.getElementById('quantityServicos').getContext('2d');
var chartServicos = new Chart(ctxServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Quantidade De Serviços',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['servicosQuantity'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxDespesas = document.getElementById('quantityDespesas').getContext('2d');
var chartDespesas = new Chart(ctxDespesas, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Quantidade De Despesas',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['despesasQuantity'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});
</script>
