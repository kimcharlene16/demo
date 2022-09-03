var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];
$(function() {
    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k]
            events.push({ id: row.id, title: row.title, user: row.user_type, yr: row.year_level, start: row.start_datetime, end: row.end_datetime });
        })
    }
    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
        },
        selectable: true,
        themeSystem: 'bootstrap',
        //Random default events
        events: events,
        eventClick: function(info) {
            var _details = $('#event-details-modal')
            var id = info.event.id
            if (!!scheds[id]) {
                _details.find('#title').text(scheds[id].title)
                _details.find('#description').text(scheds[id].description)
                _details.find('#user').text(scheds[id].user)
                _details.find('#yr').text(scheds[id].yr)
                _details.find('#start').text(scheds[id].sdate)
                _details.find('#end').text(scheds[id].edate)
                _details.find('#edit,#delete').attr('data-id', id)
                _details.modal('show')
            } else {
                alert("Event is undefined");
            }
        },
        eventDidMount: function(info) {
            // Do Something after events mounted
        },
        editable: false
    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function() {
        $(this).find('input:hidden').val('')
        $(this).find('input:visible').first().focus()
    })
})

calendar.itemCreated.addEventListener(handleItemCreated);
function handleItemCreated(sender, args) {
    var item = args.item;
    item.startTime = start_datetime;
    item.endTime = end_datetime;
    var reminder = new Calendar.Reminder();
    reminder.message = item.subject;
    reminder.type = Calendar.ReminderType.Leading;
    reminder.timeInterval = Calendar.start_datetime;
    item.reminder = reminder;
}

calendar.itemCreated.addEventListener(handleItemCreated);
function handleItemCreated(sender, args) {
    Email.send({
        Host : "mail.kimcharlene16@gmail.com",
        Username : "cccadminscheduler",
        Password : "kimparamore",
        To : $email,
        From : "cccadminscheduler@gmail.com",
        Subject : "New update",
        Body : "Reminder for " + args.item.subject
    }).then(
      message => alert(message)
    );
}
calendar.render();