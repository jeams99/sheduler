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
                        <div class="msg_success_remove"></div>
                        <div class="msg_error_remove"></div>
                        <button style="display: none;" id="event"></button>
                        <h4>{{'Event Background'}}&nbsp;<i class="fa fa-paint-brush" aria-hidden="true"></i></h4>
                        <p><input class="color-picker cp-lg hidden" id="background"  value="#0e76a8"></p>
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
        console.log(@json($events));
        let calendar = new FullCalendar.Calendar(calendarEl, {
            events:@json($events),
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
            select: function(info) {
                let title  = prompt('Add event name to calendar');
                let start = info.startStr;
                let end = info.endStr
                let gmt_start = info.start;
                let gmt_end = info.end
                calendar.addEvent({
                    title: title,
                    start: info.startStr,
                    end: info.endStr,
                    gmt_start: info.start,
                    gmt_end: info.end,
                });
                $.ajax({
                    url: '{{url("/ajax_create_event")}}',
                    type: "POST",
                    data: {_token: '{!! csrf_token() !!}', title:title, start: start, end:end, gmt_start: gmt_start, gmt_end:gmt_end, color: $("#background").val()},
                    dataType: "json",
                    success: function () {
                        $('.msg_success_remove').append('Event has been saved successfully').show(0).fadeOut(7000).css({
                            "color": "green",
                            "font-size": "200%",
                            "margin-bottom": "30px"
                        });
                        $('#event').prop("disabled", false);
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
                let result = confirm("Are you sure you want to delete this event?");
                if(!result) {
                    return false;
                }
                let start = eventClickInfo.event.start;
                $.ajax({
                    url: '{{url("/ajax_remove_event")}}',
                    type: "POST",
                    data: {_token: '{!! csrf_token() !!}', start: start},
                    dataType: "json",
                    success: function () {
                        $('.msg_success').append('Event has been removed successfully').show(0).fadeOut(7000).css({
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
                        $('.msg_error').append('Error! Event not removed').show().css({
                            "color": "red",
                            "font-size": "200%",
                            "margin-bottom": "30px"
                        }).delay(7000).hide(0);
                    }
                });
            },
            eventStartEditable: true,
            eventResizableFromStart: true,
            eventDurationEditable: true,
        });
        function getEvents() {
            //
        }
        document.getElementById('event').addEventListener('click', getEvents);
        $('#event').prop("disabled", true);
        calendar.render();
    });
</script>

