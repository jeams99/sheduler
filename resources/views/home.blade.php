@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{"Handle Scheduler"}}</div>
                <div class="card-body">
                <div class="msg_success"></div>
                <div class="msg_error"></div>
                <p><button class="btn btn-primary btn-sm" id="event">{{'Save Event'}}</button></p>
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
		//console.log(@json($events));
        let calendar = new FullCalendar.Calendar(calendarEl, {
            events:@json($events),
            eventColor: '#378006',
            initialView: 'timeGridWeek',
            editable: true,
            selectable: true,
            selectMirror: true,
            unselectAuto: false,
            select: function(info) {
                let title  = prompt('Add event name to calendar');
                let coordinates = info.jsEvent.pageX + ',' + info.jsEvent.pageY;
                let view = info.view.type;
                let start = info.startStr;
                let end = info.endStr
                calendar.addEvent({
                    title: title,
                    start: info.startStr,
                    end: info.endStr,
                    coordinates:coordinates,
                    view:view
                });
                $.ajax({
                    url: '{{url("/ajax_create_event")}}',
                    type: "POST",
                    data: {_token: '{!! csrf_token() !!}', title:title, start: start, end:end, coordinates:coordinates, view:view},
                    dataType: "json",
                    success: function () {
                        $('.msg_success').append('Data has been saved successfully').show(0).fadeOut(7000).css({
                            "color": "green",
                            "font-size": "200%",
                            "margin-bottom": "30px"
                        });
                    },
                    error: function (xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(error);
                        $('.msg_error').append('Error! Data not saved').show().css({
                            "color": "red",
                            "font-size": "200%",
                            "margin-bottom": "30px"
                        }).delay(7000).hide(0);
                    }
                });
                calendar.unselect();
            },
            eventClick: function(eventClickInfo) {
                eventClickInfo.event.remove();
            },
            eventStartEditable: true,
            eventResizableFromStart: true,
            eventDurationEditable: true,
        });
        function getEvents() {
            //
        }
        document.getElementById('event').addEventListener('click', getEvents);
        calendar.render();
    });
</script>

