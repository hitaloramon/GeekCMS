<?php switch($viewData['action']): ?>
<?php case 'view': ?>
<?php 
    $events = new ModEvents; 
    $events = $events->getEvents();
?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Módulos</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Eventos</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="card-title m-t-30 m-b-20">Adicionar / Editar</h4>
                                <form id="form-calendar">
                                    <div class="form-group">
                                        <label for="title">Título</label>
                                        <input type="hidden" class="form-control" id="id" name="id">
                                        <input type="text" class="form-control" id="title" name="title" required placeholder="Título do Evento">
                                    </div>
                                    <div class="form-group">
                                        <h5 class="box-title">Cor do Evento</h5>
                                        <input type="text" class="colorpicker form-control" required id="color" name="color" value="#3378df" />
                                    </div>
                                    <div class="form-group">
                                        <h5 class="box-title">Cor do Texto</h5>
                                        <input type="text" class="colorpicker form-control" required id="textColor" name="textColor" value="#f6f6f6" />
                                    </div>
                                    <div class="form-group">
                                        <label for="start">Data de Inicio</label>
                                        <input type="datetime-local" class="form-control" id="start" name="start" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end">Data de Término</label>
                                        <input type="datetime-local" class="form-control" id="end" name="end">
                                    </div>
                                    <div class="form-group">
                                        <label>Informações</label>
                                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="m-t-10 btn waves-effect waves-light btn-rounded btn-outline-secondary">Enviar</button>
                                        <button type="reset" class="m-t-10 btn waves-effect waves-light btn-rounded btn-outline-secondary">Limpar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-9">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <h5>Eventos</h5>
                    <p>Instruções:</p>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
$('#form-calendar').submit(function(event){
    $.ajax({
        url: '<?php echo BASE_ADMIN; ?>' + '/module/view/events/save',
        type: "post",
        data: $(this).serialize(),
        success: function (response) {
            response = JSON.parse(response);
            $('body,html').animate({scrollTop:0}, 500);
            
            if(response.error){
                response.error.forEach(element => {
                    var info = element.split('<span class="gump-field">');
                    var info2 = info[1].split('</span>');
                    var value = info2[0].toLowerCase();
                    $("#"+value+"-feedback").parent().addClass('has-danger');
                    $("#"+value+"-feedback").html(info[0] + info2[1]);
                });
            }

            if(typeof response.id !== 'undefined'){
                $('#calendar').fullCalendar('renderEvent', {
                    id: response.id,
                    title: $('#title').val(),
                    start: $('#start').val(),
                    end: $('#end').val(),
                    color: $('#color').val(),
                    textColor: $('#textColor').val(),
                    description: $('#description').val()
                });
            }else{
                $('#calendar').fullCalendar('removeEvents', $('#id').val());
                $('#calendar').fullCalendar('renderEvent', {
                    id: $('#id').val(),
                    title: $('#title').val(),
                    start: $('#start').val(),
                    end: $('#end').val(),
                    color: $('#color').val(),
                    textColor: $('#textColor').val(),
                    description: $('#description').val()
                });
            }

            $.toast({
                heading: ''+response.heading+'',
                text: ''+response.text+'',
                position: 'bottom-right',
                icon: ''+response.icon+'',
                hideAfter: 3000, 
                stack: 6
            });
        }
    });
    event.preventDefault();
});

$("#form-calendar").bind("reset", function() {
  $("#id").val("");
});

$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        locale: 'pt-br',
        selectable: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectHelper: true,
        select: function(start, end){
            $('#start').val(moment(start).format('YYYY-MM-DD[T]HH:mm:ss'));
		    $('#end').val(moment(end).format('YYYY-MM-DD[T]HH:mm:ss'));
        },
        eventClick: function(event) {
            $.confirm({
                title: 'Eventos',
                content: 'Qual ação deseja executar?',
                typeAnimated: true,
                icon: 'fa fa-info',
                buttons: {
                    confirm: {
                        text: 'Editar',
                        btnClass: 'btn-blue',
                        action: function(){
                            $('body,html').animate({scrollTop:0}, 500);
                            $('#id').val(event.id);
                            $('#title').val(event.title);
                            $('#color').asColorPicker('val', event.color);
                            $('#textColor').asColorPicker('val', event.textColor);
                            $('#start').val(event.start.format(moment.DATETIME_LOCAL));
                            $('#end').val(event.end.format(moment.DATETIME_LOCAL));
                            $('#description').val(event.description);
                        }
                    },
                    delete: {
                        text: 'Excluir',
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo BASE_ADMIN; ?>' + '/module/view/events/delete',
                                type: "post",
                                data: {id: event.id},
                                success: function (response) {
                                    response = JSON.parse(response);
                                    $('body,html').animate({scrollTop:0}, 500);
                                    $('#calendar').fullCalendar('removeEvents', event.id);

                                    $.toast({
                                        heading: ''+response.heading+'',
                                        text: ''+response.text+'',
                                        position: 'bottom-right',
                                        icon: ''+response.icon+'',
                                        hideAfter: 3000, 
                                        stack: 6
                                    });
                                }
                            });
                        }
                    },
                    close: {
                        text: 'Fechar'
                    }
                }
            });
        },
        events: [
            <?php foreach($events as $e): ?>
            {
                id: <?php echo $e['id']; ?>,
                title: '<?php echo $e['title']; ?>',
                start: '<?php echo $e['start']; ?>',
                end: '<?php echo $e['end']; ?>',
                color: '<?php echo $e['color']; ?>',
                textColor: '<?php echo $e['textColor']; ?>',
                description: '<?php echo $e['description']; ?>',
            },
            <?php endforeach; ?>
        ]
    });
});
</script>
<?php break; ?>
<?php default: ?>
<?php break; ?>
<?php endswitch;?>