<section class="content-title">
	<div class="container">
		<h1>Serviços</h1>
	</div>
</section>
<main class="page-service">
    <div class="container">
        <div class="main-header">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo $this->Url->build(['controller' => 'services', 'action' => 'pesquisa']); ?>" class="service-search" method="GET">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="s" type="text" placeholder="Pesquisar Serviço" class="service-input" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn my-3 d-block">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Html->link(__('Adicionar Serviço'), ['action' => 'add'], ['class' => 'btn mt-3 float-right']) ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div id='script-warning' style="display: none;"><div class="alert alert-danger text-center" role="alert">Dados do calendário não foram recebidos.</div></div>
                    <div id='loading'><div class="alert alert-warning text-center" role="alert">Carregando...</div></div>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
$listTech = array();
$listTech[] = array( 'id' => 0, 'title' => 'Sem Técnico' );
foreach ($technicians as $technicianSingle) {
    $listTech[] = array(
        'id' => $technicianSingle->id,
        'title' => $technicianSingle->name
    );
}
$listTech = json_encode($listTech);

?>
<script src="<?php echo $this->Url->build('/'); ?>calendar/main.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            timeZone: 'America/Bahia',
            locales: 'pt-br',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,resourceTimeGridDay,listWeek'
            },
            resourceLabelText: 'Usuários',
	        resources: <?php echo $listTech; ?>,
            initialDate: Date.now(),
            editable: true,
            navLinks: true, // can click day/week names to navigate views
            dayMaxEvents: true,
            eventClick: function(info) {
                window.location.href = '<?php echo $this->Url->build(['controller' => 'services', 'action' => 'view']); ?>/' + info.event.id;
            },
            eventDrop: function(info) {
                var id = info.event.id;
                var title = info.event.title; 
                var newData = info.event.startStr;
	            var resourceId = info.newResource.id;
                console.log(info);
                console.log(info.event);
                $.post('<?php echo $this->Url->build('/'); ?>get/editservice', {
                    id: id,
                    date: newData,
                    technician_id: resourceId
                }).done();
            },
            events: {
                url: '<?php echo $this->Url->build('/'); ?>get/services',
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