<?php $events = (new ModEvents())->getEvents(); ?>

<div id="calendar"></div>
<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="calendar-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCalendarTitle">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalCalendarBody">
      </div>
    </div>
  </div>
</div>

<?php View::startSection('footer-js'); ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            locale: 'pt-br',
            selectable: true,
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            selectHelper: true,
            select: function(start, end){
                $('#start').val(moment(start).format('YYYY-MM-DD[T]HH:mm:ss'));
                $('#end').val(moment(end).format('YYYY-MM-DD[T]HH:mm:ss'));
            },
            eventClick: function(event) {
                $('#modalCalendarTitle').html(event.title);
                $('#modalCalendarBody').html(event.description);
                $('#modalCalendar').modal();
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
<?php View::endSection(); ?>