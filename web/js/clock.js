const clockContainer = document.querySelector('#clock-container')
const button = document.querySelector('button#report-id')
const clearButton = document.querySelector('button#clear-report-id')
const resultContainer = document.querySelector('div#report-result')
const lastresultContainer = document.querySelector('div#last-result')


clearButton.addEventListener('click', function () {
  console.log('Clear report');
  resultContainer.innerHTML = '';
});

button.addEventListener('click', function () {
  console.log('Fetch report')

  var requestOptions = {
    method: 'POST',
    redirect: 'follow',
  }

  fetch('http://localhost/event-tracker/web/api/events/report', requestOptions)
    .then((response) => response.json())
    .then((result) => {
      formatStr = ''
      formatStr += '<table class="table table-sm">'
      formatStr += ' <tr>'
      formatStr += '<th> Program time </th>'
      formatStr += '-'
      formatStr += '<th> Event </th>'
      formatStr += '-'
      formatStr += '<th> Message </th>'
      formatStr += '-'
      formatStr += '<th> Actual time </th>'
      formatStr += '-'
      formatStr += '<th> Display message </th>'
      formatStr += '</tr>'

      result.forEach((task) => {
        formatStr += ' <tr>'
        formatStr += '<td>' + task.program_time + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.event + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.message + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.actual_time + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.display_message + '</td>'
        formatStr += '<tr>'
      })
      formatStr += '</table>'
      resultContainer.innerHTML = formatStr
    })
    .catch((error) => console.log('error', error))
})

d = new Date()
d.setHours(12)
d.setMinutes(0)
d.setSeconds(0)

setInterval(() => {
  d.setSeconds(d.getSeconds() + 1)
  hr = d.getHours()
  min = d.getMinutes()
  sec = d.getSeconds()

  hr_rotation = 30 * hr + min / 2 //converting current time
  min_rotation = 6 * min
  sec_rotation = 6 * sec

  hour.style.transform = `rotate(${hr_rotation}deg)`
  minute.style.transform = `rotate(${min_rotation}deg)`
  second.style.transform = `rotate(${sec_rotation}deg)`
  getRecent();
}, 1000)



function getRecent()
{
  var requestOptions = {
    method: 'POST',
    redirect: 'follow',
  }

  fetch('http://localhost/event-tracker/web/api/events/recent-event', requestOptions)
    .then((response) => response.json())
    .then((task) => {
      if(task)
      {
        formatStr = 'Recent event <br>'
        formatStr += '<table class="table table-sm">'
  
        formatStr += ' <tr>'
        formatStr += '<th> Program time </th>'
        formatStr += '-'
        formatStr += '<th> Event </th>'
        formatStr += '-'
        formatStr += '<th> Message </th>'
        formatStr += '-'
        formatStr += '<th> Actual time </th>'
        formatStr += '-'
        formatStr += '<th> Display message </th>'
        formatStr += '</tr>'
  
        formatStr += ' <tr>'
        formatStr += '<td>' + task.program_time + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.event + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.message + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.actual_time + '</td>'
        formatStr += '-'
        formatStr += '<td>' + task.display_message + '</td>'
        formatStr += '<tr>'
  
        formatStr += '</table>'
        lastresultContainer.innerHTML = formatStr;
        if(task.event == 'START')
        {
          clockContainer.classList.add('start-container');
          clockContainer.classList.remove('stop-container');
          clockContainer.classList.remove('report-container');
        } else if(task.event == 'STOP'){
          clockContainer.classList.remove('start-container')
          clockContainer.classList.remove('report-container')
          clockContainer.classList.add('stop-container')
        } else if(task.event == 'REPORT')
        {
          clockContainer.classList.remove('stop-container')
          clockContainer.classList.remove('start-container')
          clockContainer.classList.add('report-container')
        } else {
          clockContainer.classList.remove('stop-container')
          clockContainer.classList.remove('start-container')
          clockContainer.classList.remove('report-container')
        }
      }
      
    })
    .catch((error) => console.log('error', error))
}




