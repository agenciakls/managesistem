<main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">
                                Despesas
                            </h4>
                            <div class="small text-muted">
                                Calendário
                            </div>
                        </div>
                    </div>
                        
                    <form action="<?php echo $this->Url->build(['controller' => 'costs', 'action' => 'pesquisa']); ?>" class="service-search" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="s" type="text" placeholder="Pesquisar Despesa" class="service-input form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-pill mx-1 d-block btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Html->link(__('Adicionar Despesa'), ['action' => 'add'], ['class' => 'btn btn-pill mx-1 px-5 btn-primary float-right']) ?>
                            </div>
                        </div>
                    </form>
                    <div class="c-chart-wrapper my-3">
                        <div id='script-warning' style="display: none;"><div class="alert alert-danger text-center" role="alert">Dados do calendário não foram recebidos.</div></div>
                        <div id='loading'><div class="alert alert-warning text-center" role="alert">Carregando...</div></div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
$listTech = array();
$listTech[] = array( 'id' => 0, 'title' => 'Sem Categoria' );
foreach ($expenses as $expensesSingle) {
    $listTech[] = array(
        'id' => $expensesSingle->id,
        'title' => $expensesSingle->title
    );
}
$listTech = json_encode($listTech);

?>
<script src="<?php echo $this->Url->build('/'); ?>calendar/main.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            slotMinTime: "00:00:00",
            slotMaxTime: "00:00:00",
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            timeZone: 'America/Bahia',
            locales: 'pt-br',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,resourceTimeGridDay,listWeek'
            },
	        resources: <?php echo $listTech; ?>,
            initialDate: Date.now(),
            editable: true,
            navLinks: true, // can click day/week names to navigate views
            dayMaxEvents: true,
            allDayDefault: true,                                                                                                         
            eventClick: function(info) {
                window.location.href = '<?php echo $this->Url->build(['controller' => 'costs', 'action' => 'view']); ?>/' + info.event.id;
            },
            eventDrop: function(info) {
                var id = info.event.id;
                console.log(info.event.id);
                var title = info.event.title; 
                var newData = info.event.startStr;
	            try { var technician_id = info.newResource.id; } catch (err) { var technician_id = { };}
                $.post('<?php echo $this->Url->build(['controller' => 'get', 'action' => 'editcost']); ?>', {
                    id: id,
                    date: newData,
                    technician_id
                }).done();
            },
            events: {
                url: '<?php echo $this->Url->build(['controller' => 'get', 'action' => 'costs']); ?>',
                failure: function() {
                    document.getElementById('script-warning').style.display = 'block'
                }
            },
            loading: function(bool) {
                document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
            }
        });

        calendar.render();
    });
</script>