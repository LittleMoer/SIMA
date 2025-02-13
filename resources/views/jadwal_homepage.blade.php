<link rel="manifest" href="site.webmanifest">
<link rel="stylesheet" href="global.css?20231021">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.css">
<script src="https://cdn.jsdelivr.net/npm/@event-calendar/build@3.2.1/event-calendar.min.js"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(75029251, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/75029251" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<style>
    .ec-timeline .ec-time, .ec-timeline .ec-line {
        width: 80px;
    }
</style>
<script type="text/javascript">
  const ec = new EventCalendar(document.getElementById('ec'), {
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
      events: createEvents(),
      dayMaxEvents: true,
      nowIndicator: true
  });

  function createEvents() {
      let days = [];
      for (let i = 0; i < 7; ++i) {
          let day = new Date();
          let diff = i - day.getDay();
          day.setDate(day.getDate() + diff);
          days[i] = day.getFullYear() + "-" + _pad(day.getMonth()+1) + "-" + _pad(day.getDate());
      }

      return [
          {start: days[0] + " 00:00", end: days[0] + " 09:00", display: "background"},
          {start: days[1] + " 12:00", end: days[1] + " 14:00", display: "background"},
          {start: days[2] + " 17:00", end: days[2] + " 24:00", display: "background"},
          {start: days[0], end: days[0], title: "JSP 303", color: "#8BC34A"},
          {start: days[1], end: days[2], title: "JSP 202", color: "#FFC107"},
          {start: days[2] , end: days[2], title: "JSP 101", color: "#8BC34A"},
          {start: days[3], end: days[3], title: "JSP 201", color: "#8BC34A"},
          {start: days[3], end: days[3] , title: "JSP 301", color: "#FFC107"},
          {start: days[5], end: days[5], title: "JSP 101", color: "#8BC34A"},
          {start: days[5] , end: days[5], title: "JSP 301", color: "#8BC34A"},
          {start: days[5] , end: days[5]  , title: "JSP 201", color: "#FFC107"},
          {start: days[1], end: days[3], title: "JSP 202", color: "#8BC34A", allDay: true}
      ];
  }

  function _pad(num) {
      let norm = Math.floor(Math.abs(num));
      return (norm < 10 ? '0' : '') + norm;
  }
</script>