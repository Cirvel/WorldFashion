<!DOCTYPE html>

<html>

<head>
    <title>Transaction History</title>
</head>

<body>
    <!-- Transaction Detail -->
    <div class="modal fade" id="historyDetail" tabindex="-1" aria-labelledby="historyDetailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionDetailModal1Label">Transaction Detail</h5>
                    <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span class="d-flex justify-content-center">
                    <div id="snap-throbber" class="spinner-border my-5" role="status"></div>
                </span>
                <div id="snap-info" class="modal-body">
                    <form id="history_form" method="POST" action="{{ route('transactions.confirm') }}">
                        @csrf
                        @method('post')
                        <input type="hidden" name="id" id="h-input" value="1">
                    </form>
                    <input type="hidden" name="snap" id="snap">
                    <p>Transaction ID: KDWF-<span id="h-id"></span></p>
                    <p>Status: <span class="fw-medium" id="h-status"></span></p>
                    <p>Date: <span id="h-date"></span></p>
                    <p>Item: <span id="h-amount"></span> <span id="h-ticket"></span> Ticket</p>
                    <p>Amount: Rp. <span id="h-total"></span></p>
                    <p class="fw-medium text-danger" id="stockings"><i class="fa fa-pallet"></i> Out of stock!</p>
                    <button class="btn btn-primary" id="snap-pay">
                        <i class="fa fa-qrcode"></i> Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
