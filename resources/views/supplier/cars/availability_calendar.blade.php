@extends('layouts.supplier')

@section('title', 'Availability Calendar')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Availability Calendar - {{ $car->c_name }}</h2>

    <div id="calendar"></div>
</div>

{{-- FullCalendar --}}
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: @json($availabilities),

        // Select dates to mark availability
        select: function(info) {
            let start = info.startStr;
            let end = info.endStr;

            let isAvailable = confirm("Mark selected date(s) as Available? Cancel for Unavailable.");

            fetch("{{ route('supplier.cars.availability.store', $car->c_code) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    start_date: start,
                    end_date: end,
                    is_available: isAvailable ? 1 : 0
                })
            })
            .then(res => res.json())
            .then(res => {
                alert('Availability updated!');
                location.reload();
            });
        },

        // Click on event to delete
        eventClick: function(info) {
            if(confirm("Delete this availability?")) {
                fetch(`/supplier/cars/{{ $car->c_code }}/availability/${info.event.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => {
                    alert('Deleted!');
                    location.reload();
                });
            }
        }
    });

    calendar.render();
});
</script>
@endsection
