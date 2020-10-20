function realTime(){
    var time=new Date();
    var hours=time.getHours();
    var min=time.getMinutes();
    var second=time.getSeconds();

    var amPm=hours>12?'PM':'AM';
    console.log('run');
    var clock=document.getElementById('clock');
    clock.textContent=hours+" : "+min+" : "+second;
    var t=setTimeout(realTime,1000);
}