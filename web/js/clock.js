const button = document.querySelector('button#report-id');
const resultContainer = document.querySelector('div#report-result');

button.addEventListener('click', function(){
    console.log('Fetch report')

    var requestOptions = {
        method: 'POST',
        redirect: 'follow'
      };
      
      fetch("http://localhost/event-tracker/web/api/events/report", requestOptions)
        .then(response => response.json())
        .then(result => 
            {
                formatStr = '';
                formatStr += '<table class="table table-sm">';
                result.forEach(task => {
                    formatStr += ' <tr>';
                    formatStr += task.program_time;
                    formatStr += '-';
                    formatStr += task.event;
                    formatStr += '-';
                    formatStr += task.message;
                    formatStr += '-';
                    formatStr += task.actual_time;
                    formatStr += '-';
                    formatStr += task.display_message;
                    formatStr += '<tr>';

                });
                formatStr += '</table>';
                resultContainer.innerHTML = formatStr;
            })
        .catch(error => console.log('error', error));
        
});
 
 
 d = new Date();
 d.setHours(12);
 d.setMinutes(0);
 d.setSeconds(0);

setInterval(() => {
   
    d.setSeconds(d.getSeconds() + 1);
    hr = d.getHours();
    min = d.getMinutes();
    sec = d.getSeconds();

    hr_rotation = 30 * hr + min / 2; //converting current time
    min_rotation = 6 * min;
    sec_rotation = 6 * sec;
  
    hour.style.transform = `rotate(${hr_rotation}deg)`;
    minute.style.transform = `rotate(${min_rotation}deg)`;
    second.style.transform = `rotate(${sec_rotation}deg)`;
}, 1000);

