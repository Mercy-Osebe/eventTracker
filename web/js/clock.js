
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

