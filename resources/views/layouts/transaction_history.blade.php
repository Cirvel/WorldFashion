<!DOCTYPE html>

<html>

<head>
    <title>Transaction History</title>
</head>

<body>
    <!-- Transaction History -->
    <div class="modal fade" id="transactionHistoryModal" tabindex="-1" aria-labelledby="transactionHistoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionHistoryModalLabel">Transaction History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span class="d-flex justify-content-center">
                    <div id="history-throbber" class="spinner-border my-5" role="status"></div>
                </span>
                <div id="transactions_history" class="modal-body">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
