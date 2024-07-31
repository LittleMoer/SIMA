/**
 * Main
 */

'use strict';

let menu, animate;

(function () {
  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: 'vertical',
      closeChildren: false
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
    });
  });

  // Display menu toggle (layout-menu-toggle) on hover with delay
  let delay = function (elem, callback) {
    let timeout = null;
    elem.onmouseenter = function () {
      // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
      if (!Helpers.isSmallScreen()) {
        timeout = setTimeout(callback, 300);
      } else {
        timeout = setTimeout(callback, 0);
      }
    };

    elem.onmouseleave = function () {
      // Clear any timers set to timeout
      document.querySelector('.layout-menu-toggle').classList.remove('d-block');
      clearTimeout(timeout);
    };
  };
  if (document.getElementById('layout-menu')) {
    delay(document.getElementById('layout-menu'), function () {
      // not for small screen
      if (!Helpers.isSmallScreen()) {
        document.querySelector('.layout-menu-toggle').classList.add('d-block');
      }
    });
  }

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  window.Helpers.setCollapsed(true, false);
})();

document.addEventListener('DOMContentLoaded', function() {
  // Ambil semua elemen dengan kelas 'nav-link'
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    link.addEventListener('click', function() {
      // Hapus kelas 'active' dari semua link
      navLinks.forEach(nav => nav.classList.remove('active'));

      // Tambahkan kelas 'active' ke link yang di klik
      this.classList.add('active');
    });
  });
});

let direction="ltr";isRtl&&(direction="rtl"),document.addEventListener("DOMContentLoaded",function(){{let e=document.getElementById("calendar"),t=document.querySelector(".app-calendar-sidebar"),n=document.getElementById("addEventSidebar"),a=document.querySelector(".app-overlay"),l={Business:"primary",Holiday:"success",Personal:"danger",Family:"warning",ETC:"info"},r=document.querySelector(".offcanvas-title"),i=document.querySelector(".btn-toggle-sidebar"),d=document.querySelector("#addEventBtn"),o=document.querySelector(".btn-delete-event"),s=document.querySelector(".btn-cancel"),c=document.querySelector("#eventTitle"),u=document.querySelector("#eventStartDate"),v=document.querySelector("#eventEndDate"),m=document.querySelector("#eventURL"),p=$("#eventLabel"),f=$("#eventGuests"),g=document.querySelector("#eventLocation"),h=document.querySelector("#eventDescription"),b=document.querySelector(".allDay-switch"),y=document.querySelector(".select-all"),S=[].slice.call(document.querySelectorAll(".input-filter")),L=document.querySelector(".inline-calendar"),E,k=events,w=!1,x,q=new bootstrap.Offcanvas(n);function P(e){return e.id?"<span class='badge badge-dot bg-"+$(e.element).data("label")+" me-2'> </span>"+e.text:e.text}function M(e){return e.id?"<div class='d-flex flex-wrap align-items-center'><div class='avatar avatar-xs me-2'><img src='"+assetsPath+"img/avatars/"+$(e.element).data("avatar")+"' alt='avatar' class='rounded-circle' /></div>"+e.text+"</div>":e.text}var T,A;function F(){var e=document.querySelector(".fc-sidebarToggle-button");for(e.classList.remove("fc-button-primary"),e.classList.add("d-lg-none","d-inline-block","ps-0");e.firstChild;)e.firstChild.remove();e.setAttribute("data-bs-toggle","sidebar"),e.setAttribute("data-overlay",""),e.setAttribute("data-target","#app-calendar-sidebar"),e.insertAdjacentHTML("beforeend",'<i class="bx bx-menu bx-lg text-heading"></i>')}p.length&&p.wrap('<div class="position-relative"></div>').select2({placeholder:"Select value",dropdownParent:p.parent(),templateResult:P,templateSelection:P,minimumResultsForSearch:-1,escapeMarkup:function(e){return e}}),f.length&&f.wrap('<div class="position-relative"></div>').select2({placeholder:"Select value",dropdownParent:f.parent(),closeOnSelect:!1,templateResult:M,templateSelection:M,escapeMarkup:function(e){return e}}),u&&(T=u.flatpickr({enableTime:!0,altFormat:"Y-m-dTH:i:S",onReady:function(e,t,n){n.isMobile&&n.mobileInput.setAttribute("step",null)}})),v&&(A=v.flatpickr({enableTime:!0,altFormat:"Y-m-dTH:i:S",onReady:function(e,t,n){n.isMobile&&n.mobileInput.setAttribute("step",null)}})),L&&(x=L.flatpickr({monthSelectorType:"static",inline:!0}));let D=new Calendar(e,{initialView:"dayGridMonth",events:function(e,t){let n=function(){let t=[],e=[].slice.call(document.querySelectorAll(".input-filter:checked"));return e.forEach(e=>{t.push(e.getAttribute("data-value"))}),t}();t(k.filter(function(e){return n.includes(e.extendedProps.calendar.toLowerCase())}))},plugins:[dayGridPlugin,interactionPlugin,listPlugin,timegridPlugin],editable:!0,dragScroll:!0,dayMaxEvents:2,eventResizableFromStart:!0,customButtons:{sidebarToggle:{text:"Sidebar"}},headerToolbar:{start:"sidebarToggle, prev,next, title",end:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},direction:direction,initialDate:new Date,navLinks:!0,eventClassNames:function({event:e}){return["fc-event-"+l[e._def.extendedProps.calendar]]},dateClick:function(e){e=moment(e.date).format("YYYY-MM-DD");C(),q.show(),r&&(r.innerHTML="Add Event"),d.innerHTML="Add",d.classList.remove("btn-update-event"),d.classList.add("btn-add-event"),o.classList.add("d-none"),u.value=e,v.value=e},eventClick:function(e){e=e,(E=e.event).url&&(e.jsEvent.preventDefault(),window.open(E.url,"_blank")),q.show(),r&&(r.innerHTML="Update Event"),d.innerHTML="Update",d.classList.add("btn-update-event"),d.classList.remove("btn-add-event"),o.classList.remove("d-none"),c.value=E.title,T.setDate(E.start,!0,"Y-m-d"),!0===E.allDay?b.checked=!0:b.checked=!1,null!==E.end?A.setDate(E.end,!0,"Y-m-d"):A.setDate(E.start,!0,"Y-m-d"),p.val(E.extendedProps.calendar).trigger("change"),void 0!==E.extendedProps.location&&(g.value=E.extendedProps.location),void 0!==E.extendedProps.guests&&f.val(E.extendedProps.guests).trigger("change"),void 0!==E.extendedProps.description&&(h.value=E.extendedProps.description)},datesSet:function(){F()},viewDidMount:function(){F()}});D.render(),F();var Y=document.getElementById("eventForm");function C(){v.value="",m.value="",u.value="",c.value="",g.value="",b.checked=!1,f.val("").trigger("change"),h.value=""}FormValidation.formValidation(Y,{fields:{eventTitle:{validators:{notEmpty:{message:"Please enter event title "}}},eventStartDate:{validators:{notEmpty:{message:"Please enter start date "}}},eventEndDate:{validators:{notEmpty:{message:"Please enter end date "}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap5:new FormValidation.plugins.Bootstrap5({eleValidClass:"",rowSelector:function(e,t){return".mb-6"}}),submitButton:new FormValidation.plugins.SubmitButton,autoFocus:new FormValidation.plugins.AutoFocus}}).on("core.form.valid",function(){w=!0}).on("core.form.invalid",function(){w=!1}),i&&i.addEventListener("click",e=>{s.classList.remove("d-none")}),d.addEventListener("click",e=>{var t,n;d.classList.contains("btn-add-event")?w&&(n={id:D.getEvents().length+1,title:c.value,start:u.value,end:v.value,startStr:u.value,endStr:v.value,display:"block",extendedProps:{location:g.value,guests:f.val(),calendar:p.val(),description:h.value}},m.value&&(n.url=m.value),b.checked&&(n.allDay=!0),n=n,k.push(n),D.refetchEvents(),q.hide()):w&&(n={id:E.id,title:c.value,start:u.value,end:v.value,url:m.value,extendedProps:{location:g.value,guests:f.val(),calendar:p.val(),description:h.value},display:"block",allDay:!!b.checked},(t=n).id=parseInt(t.id),k[k.findIndex(e=>e.id===t.id)]=t,D.refetchEvents(),q.hide())}),o.addEventListener("click",e=>{var t;t=parseInt(E.id),k=k.filter(function(e){return e.id!=t}),D.refetchEvents(),q.hide()}),n.addEventListener("hidden.bs.offcanvas",function(){C()}),i.addEventListener("click",e=>{r&&(r.innerHTML="Add Event"),d.innerHTML="Add",d.classList.remove("btn-update-event"),d.classList.add("btn-add-event"),o.classList.add("d-none"),t.classList.remove("show"),a.classList.remove("show")}),y&&y.addEventListener("click",e=>{e.currentTarget.checked?document.querySelectorAll(".input-filter").forEach(e=>e.checked=1):document.querySelectorAll(".input-filter").forEach(e=>e.checked=0),D.refetchEvents()}),S&&S.forEach(e=>{e.addEventListener("click",()=>{document.querySelectorAll(".input-filter:checked").length<document.querySelectorAll(".input-filter").length?y.checked=!1:y.checked=!0,D.refetchEvents()})}),x.config.onChange.push(function(e){D.changeView(D.view.type,moment(e[0]).format("YYYY-MM-DD")),F(),t.classList.remove("show"),a.classList.remove("show")})}});
let date=new Date,nextDay=new Date((new Date).getTime()+864e5),nextMonth=11===date.getMonth()?new Date(date.getFullYear()+1,0,1):new Date(date.getFullYear(),date.getMonth()+1,1),prevMonth=11===date.getMonth()?new Date(date.getFullYear()-1,0,1):new Date(date.getFullYear(),date.getMonth()-1,1);window.events=[{id:1,url:"",title:"Design Review",start:date,end:nextDay,allDay:!1,extendedProps:{calendar:"Business"}},{id:2,url:"",title:"Meeting With Client",start:new Date(date.getFullYear(),date.getMonth()+1,-11),end:new Date(date.getFullYear(),date.getMonth()+1,-10),allDay:!0,extendedProps:{calendar:"Business"}},{id:3,url:"",title:"Family Trip",allDay:!0,start:new Date(date.getFullYear(),date.getMonth()+1,-9),end:new Date(date.getFullYear(),date.getMonth()+1,-7),extendedProps:{calendar:"Holiday"}},{id:4,url:"",title:"Doctor's Appointment",start:new Date(date.getFullYear(),date.getMonth()+1,-11),end:new Date(date.getFullYear(),date.getMonth()+1,-10),extendedProps:{calendar:"Personal"}},{id:5,url:"",title:"Dart Game?",start:new Date(date.getFullYear(),date.getMonth()+1,-13),end:new Date(date.getFullYear(),date.getMonth()+1,-12),allDay:!0,extendedProps:{calendar:"ETC"}},{id:6,url:"",title:"Meditation",start:new Date(date.getFullYear(),date.getMonth()+1,-13),end:new Date(date.getFullYear(),date.getMonth()+1,-12),allDay:!0,extendedProps:{calendar:"Personal"}},{id:7,url:"",title:"Dinner",start:new Date(date.getFullYear(),date.getMonth()+1,-13),end:new Date(date.getFullYear(),date.getMonth()+1,-12),extendedProps:{calendar:"Family"}},{id:8,url:"",title:"Product Review",start:new Date(date.getFullYear(),date.getMonth()+1,-13),end:new Date(date.getFullYear(),date.getMonth()+1,-12),allDay:!0,extendedProps:{calendar:"Business"}},{id:9,url:"",title:"Monthly Meeting",start:nextMonth,end:nextMonth,allDay:!0,extendedProps:{calendar:"Business"}},{id:10,url:"",title:"Monthly Checkup",start:prevMonth,end:prevMonth,allDay:!0,extendedProps:{calendar:"Personal"}}];
