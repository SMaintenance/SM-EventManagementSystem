$(function() {
    myTimer();
    setInterval(function(){ myTimer() }, 1000);
    function myTimer()
    {
        const y = new Date();
        const time = y.toLocaleTimeString();
        const year = y.getFullYear();
        const month = y.getMonth() + 1;
        const day = y.getDate();
        document.getElementById("dateAndTime").innerHTML = "" + day + "/" + month + "/" + year + " " + time + " (GMT + 0)";
    }
});