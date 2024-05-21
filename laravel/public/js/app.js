function countdownTimer(){
    /* Set the date for which to countdown for */
    // ("[month_abbrv] [day], [year] [HH]:[MM]:[SS]  ")
    var countdownDate = new Date("Oct 19, 2024 18:00:00").getTime();

    /* Update countdown every second */
    var countdown = setInterval( function()
    {
        var currentDate = new Date().getTime();
        var timeRemaining = countdownDate - currentDate;

        /* Calculates time */
        var day = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hour = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60 ));
        var minute = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60 ));
        var second = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        
        document.getElementById("countdown").innerHTML ='<div class="col-2"><h1>'+ day +'</h1><h3>Days</h3></div><div class="col-2"><h1>'+ hour +'</h1><h3>Hrs</h3></div><div class="col-2"><h1>'+ minute +'</h1><h3>Min</h3></div><div class="col-2"><h1>'+ second +'</h1><h3>Sec</h3></div>';

        if (timeRemaining < 0)
        {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML = '<h1>EXPIRED</h1>'
        }
    }, 1000);
}