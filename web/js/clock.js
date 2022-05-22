const button = document.querySelector('button#report-id')
const resultContainer = document.querySelector('div#report-result')

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
}, 1000)
