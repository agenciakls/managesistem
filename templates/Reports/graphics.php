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
                                <h3>Previsão x Despesas</h3>
                                <canvas id="comparativoReceitaDespesas"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Faturamento vs Despesas</h3>
                                <canvas id="comparativoFaturamentoDespesas"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Previsão</h3>
                                <canvas id="totalReceita"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Faturamento</h3>
                                <canvas id="totalServicos"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Total Despesas</h3>
                                <canvas id="totalDespesas"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Lucro sobre Despesas</h3>
                                <canvas id="lucroAtual"></canvas>
                            </div>
                            <div class="col-md-6 my-3">
                                <h3>Quantidade de Serviços</h3>
                                <canvas id="quantityServicos"></canvas>
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

var ctxVlServicos = document.getElementById('comparativoReceitaDespesas').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Receita',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalReceita'] . '\','; } ?>
            ]
        }, {
            label: 'Despesas',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(155, 0, 0)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalDespesas'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxVlServicos = document.getElementById('comparativoFaturamentoDespesas').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Receita',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalServicos'] . '\','; } ?>
            ]
        }, {
            label: 'Despesas',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgb(155, 0, 0)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalDespesas'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxVlServicos = document.getElementById('totalServicos').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Total Faturado',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalServicos'] . '\','; } ?>
            ]
        }]
    },
    options: {}
});

var ctxVlServicos = document.getElementById('totalReceita').getContext('2d');
var chartVlServicos = new Chart(ctxVlServicos, {
    type: 'line',
    data: {
        labels: [ <?php foreach ($arrayGraphics as $gpname => $gpvalue) {  echo '\'' . $gpname . '\','; } ?> ],
        datasets: [{
            label: 'Receita Total',
            backgroundColor: 'rgba(0, 181, 232, 0.2)',
            borderColor: 'rgb(11, 46, 90)',
            data: [
                <?php foreach ($arrayGraphics as $gpname => $gpvalue) { echo '\'' . $gpvalue['totalReceita'] . '\','; } ?>
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