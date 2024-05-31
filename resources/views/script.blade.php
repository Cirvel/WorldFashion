<script src="{{ asset('js/app.js') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript">
    /* Set hidden value 'price' depending on the ticket price */
    function ticket() {
        var id = $('#ticket_id').val();
        $.ajax({ // Ajax script
            url: "{{ route('tickets.get') }}", // Route
            type: "GET", // Method
            data: {
                'ticket': id
            }, // Set parameters
            success: function(data) { // Set price as return value
                $('#order_form').find('input[name="price"]').val(data.price);
                $('#order_form').find('input[name="ticket_name"]').val(data.name);
            }
        })
    }

    /* Change the modal 2 (Pay now) datas upon continuing from modal 1 (Pre order) */
    function payNow() {

        var data = $('#order_form');
        var username = data.find('input[name="name"]').val()
        var email = data.find('input[name="email"]').val()
        var no_telp = data.find('input[name="no_telp"]').val()
        var ticket = data.find('input[name="ticket_name"]').val()
        var amount = data.find('input[name="amount"]').val()
        var total = data.find('input[name="total"]').val()

        // Alter text
        var preview = $('#nextInputModal');
        preview.find('span[id="name_2"]').html(username);
        preview.find('span[id="email_2"]').html(email);
        preview.find('span[id="no_telp_2"]').html(no_telp);
        preview.find('span[id="amount_2"]').html(amount);
        preview.find('span[id="ticket_2"]').html(ticket);
        preview.find('span[id="total_2"]').html(new Intl.NumberFormat().format(total));
    }

    /* Regenerate captcha form */
    function regenCaptcha(entry = true) {
        /* Regenerate captcha */

        if (entry) {
            $('#errorCaptcha').html("");
        }
        $.ajax({
            url: "{{ route('recaptcha') }}",
            type: "GET",
            success: function(data) {
                $('#captchaInput').val("");
                $('#captcha span').html(data.captcha);
            },
            error: function(message, error) {
                alert("Error code : ".message.status);
            }
        })
    };

    /* Store data using AJAX */
    function store_transactions() {
        $.ajax({ // Ajax script
            url: "{{ route('transactions.store') }}", // Route
            type: "POST", // Method
            data: $('#order_form').serializeArray(), // Parameters
            success: function(data) { // Set price as return value
                b5_alert("staticAlert", "<strong>Transaction has been successfully submitted, please go to the transaction history to confirm your payment.</strong>", "success");
                // alert('success');
            },
            error: function(message, error) {
                alert("Error code : " + message.status);
            }
        })
    }

    /* Confirm data and deduct ticket stock using AJAX */
    // function confirm_transactions() {
    //     // alert('confirming transaction');

    //     var form = $('#history_form');
    //     var token = form.find('input[name="_token"]');

    //     $.ajax({
    //         url: "{{ route('transactions.confirm') }}",
    //         type: "POST",
    //         data: $('#history_form').serializeArray(),
    //         success: function(data) {
    //             alert('success : ' + data);
    //             token.val(data);
    //         },
    //         error: function(message, error) {
    //             alert('failed : ' + message.status);
    //         }
    //     })
    // };

    function append() {
        $('#transactions_history').html("<p class='fs-3 text-center'><i class='fa fa-spinner'></i><p>");
        $.ajax({
            url: "{{ route('transactions.append') }}",
            type: "GET",
            data: {
                'user_id': {{ auth()->id() }},
            },
            success: function(data) {
                $('#transactions_history').html(data);
            },
            error: function(message, error) {
                b5_alert('staticAlert', 'Failed to load transaction history, please try again : ' + message
                    .status, 'danger');
            }
        })
    }

    /* Replaces data inside transaction history detail modal */
    function get(id) {
        $("#snap-pay").hide();
        // alert("Gettind transaction id : " + JSON.stringify(id));
        $.ajax({
            url: "{{ route('transactions.get') }}",
            type: "GET",
            data: {
                'id': id,
            },
            success: function(data) {
                /**
                 * data[0] = transactions
                 * data[1] = tickets
                 */
                var status;
                if (data[2].status_code == 404) {
                    status = "Pending";
                    $("#snap-pay").show();
                } else if(data[2].status_code == 200) {
                    status = "Success";
                } else {
                    status = "Expired";
                }

                $("#h-status").html(status);
                $("#h-input").val(data[0].id);
                $("#snap").val(data[0].snap_token);
                $("#h-id").html(data[0].snap_token);
                $("#h-date").html(data[0].created_at);
                $("#h-amount").html(data[0].amount);
                $("#h-ticket").html(data[1].name);
                $("#h-total").html(new Intl.NumberFormat().format(data[0].total));
                // alert('success getting data');
            },
            error: function(message, error) {
                alert("Error code : " + message.status);
            }
        })
    }

    $('#submitBtn').click(function(e) {
        /* Only continue onto the next popup if all the fiels are filled */
        const name = document.getElementById('name').value;
        const no_telp = document.getElementById('no_telp').value;
        const email = document.getElementById('email').value;
        const amount = document.getElementById('amount').value;


        if (name && no_telp && email && amount) {
            var firstModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
            firstModal.hide();
            var secondModal = new bootstrap.Modal(document.getElementById('captchaModal'));
            regenCaptcha();
            secondModal.show();
        } else {
            b5_alert("errorPreOrder", "Please fill out all the fields", "danger");
            // alert('Please fill all the fields');
        }

    });
    $('#submitCaptchaBtn').click(function(e) {
        var captcha = $('#captchaInput').val();
        $.ajax({
            url: "{{ route('nocaptcha') }}",
            type: "GET",
            data: {
                'captcha': captcha
            },
            success: function(data) {
                var currModal = bootstrap.Modal.getInstance(document.getElementById(
                    'captchaModal'));
                currModal.hide();
                var nextModal = new bootstrap.Modal(document.getElementById('nextInputModal'));
                nextModal.show();
                // b5_alert("staticAlert", "Captcha passed", "success");
            },
            error: function(message, error) {
                regenCaptcha(false);
                b5_alert("errorCaptcha", "Captcha failed", "danger");
            }
        })
    });

    /**
     * Pay using Midtrans with snap token
     */
    $('#snap-pay').click(function(e) {
        var snap_token = $('#snap').val();
        var transaction = $('#h-id').val();
        // alert(`variabel ${snap_token}`);
        snap.pay(`${snap_token}`, {
            onSuccess: function(result) {
                var form = $('#history_form');
                var token = form.find('input[name="_token"]');

                $.ajax({
                    url: "{{ route('transactions.confirm') }}",
                    type: "POST",
                    data: $('#history_form').serializeArray(),
                    success: function(data) {
                        // alert('success : ' + data);
                        token.val(data);
                    },
                    error: function(message, error) {
                        alert('failed : ' + message.status);
                    }
                })
                b5_alert('staticAlert', 'Payment success!', 'success');
            },
            onPending: function(result) {
                b5_alert('staticAlert', 'Payment pending', 'info');
            },
            onError: function(result) {
                b5_alert('staticAlert', 'Payment failed!', 'danger');
            }
        });
    });

    /* Popup continue function */
    document.addEventListener('hidden.bs.modal', function(event) {
        if (document.querySelectorAll('.modal.show').length === 0) {
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.parentNode.removeChild(backdrop);
            }
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        }
    });
</script>
