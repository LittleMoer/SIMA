<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.css">
</head>
<body>
    <div id="calendar">Sad</div>
    <script src="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengambil data event dari API
            function createEvents() {
                return fetch('/api/events')
                    .then(response => response.json())
                    .catch(error => {
                        console.error('Error fetching events:', error);
                        return []; // Kembalikan array kosong jika terjadi kesalahan
                    });
            }
    
            // Inisialisasi kalender
            createEvents().then(events => {
                new EventCalendar(document.getElementById('calendar'), {
                    view: 'dayGridMonth', // Setel tampilan default ke tampilan bulan
                    headerToolbar: {
                        start: 'prev,next today',
                        center: 'title',
                        end: ''
                    },
                    editable: false, // Nonaktifkan kemampuan drag and drop
                    eventStartEditable: false, // Nonaktifkan drag pada start event
                    eventDurationEditable: false, // Nonaktifkan resize pada event
                    droppable: false, // Nonaktifkan kemampuan droppable
                    selectable: false, // Nonaktifkan kemampuan selectable
                    events: events, // Menggunakan event yang diambil dari API
                    dayMaxEvents: true, // Batasi jumlah event yang ditampilkan per hari
                    nowIndicator: true, // Tampilkan indikator hari ini
                    eventContent: function(info) {
                        return {
                            html: `<b>${info.event.title}</b>` // Tampilkan title di dalam event
                        };
                    }
                });
            });
        });
    </script>
    
    
    
</body>
</html>
