@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{"Handle Scheduler"}}</div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            events:@json($events),
            eventColor: '#378006',
            themeSystem: 'bootstrap5',
            initialView: 'timeGridWeek',
            editable: true,
            selectable: true,
            selectMirror: true,
            unselectAuto: false,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },
        });
        calendar.render();
    });
</script>
