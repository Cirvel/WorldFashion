function countdownTimer() {
    /**
     * Used by dashboard.blade.php for displaying a countdown to a specific date
     */

    // ("[YEAR]-[MM]-[DD] [HH]:[MM]:[SS]") PHP-STYLE
    // ("[month_abbrv] [day], [year] [HH]:[MM]:[SS]") ALTERNATE
    var countdownDate = new Date("2024-10-19 18:00:00").getTime();

    /* Update countdown every second (1000 miliseconds) */
    var countdown = setInterval(function () {
        var currentDate = new Date().getTime();
        var timeRemaining = countdownDate - currentDate;

        /* Calculates time */
        var day = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hour = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minute = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        var second = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = [
            '<div class="col-2"><h1>' + day + '</h1><h3>Days</h3></div><div class="col-2"><h1>' + hour + '</h1><h3>Hrs</h3></div><div class="col-2"><h1>' + minute + '</h1><h3>Min</h3></div><div class="col-2"><h1>' + second + '</h1><h3>Sec</h3></div>'
        ];

        /* If countdown objectives are reached, stops countdown */
        if (timeRemaining < 0) {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML = '<h1>EXPIRED</h1>'
        }
    }, 1000);
}

/**
 * Used by ticket display for displaying a countdown to a specific date
 */
function paymentExpiration($date) {

    var countdownDate = new Date($date).getTime();

    var countdown = setInterval(function () {
        var currentDate = new Date().getTime();
        var timeRemaining = countdownDate - currentDate;

        /* Calculates time */
        var day = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hour = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minute = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        var second = Math.floor((timeRemaining % (1000 * 60)) / 1000);


        document.getElementById("countdown").innerHTML = '<div class="col-2"><h1>' + day + '</h1><h3>Days</h3></div><div class="col-2"><h1>' + hour + '</h1><h3>Hrs</h3></div><div class="col-2"><h1>' + minute + '</h1><h3>Min</h3></div><div class="col-2"><h1>' + second + '</h1><h3>Sec</h3></div>';

        /* If countdown objectives are reached, stops countdown */
        if (timeRemaining < 0) {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML = '<h3>EXPIRED</h3>'
        }
    }, 1000);
}

/**
 * Used by booking ticket to calculate the total cost of a ticket
 */
function calculateTotal() {
    var amount = document.getElementById("amount").value;
    var price = document.getElementById("price").value;
    var total = amount * price;

    document.getElementById("total").value = total; // Change value on a readonly input 'total'
}

/**
 * Display Bootstrap closable alerts within the web
 */
function b5_alert(id, message, type) {
    const alertElement = document.getElementById(id)
    const wrapper = document.createElement('div')
    alertElement.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')

    alertElement.append(alertElement)
}

/* Confirm data and deduct ticket stock using AJAX */
function confirm_transactions() {
    var form = $('#history_form');
    var token = form.find('input[name="_token"]');

    alert('transaction_confirm');
    $.ajax({
        url: "{{ route('transactions.confirm') }}",
        type: "POST",
        data: $('#history_form').serializeArray(),
        success: function (data) {
            alert('success : ' + data);
            token.val(data);
        },
        error: function (message, error) {
            alert('failed : ' + message.status);
        }
    })
};
