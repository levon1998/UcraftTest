$(document).ready(function () {
    $('.removeWallet').on('click', function () {
        const id = $(this).data('id');
        $('#walletId').val(id);
        $('#removeWalletModal').modal('show');
    });

    $('.confirmDelete').on('click', function () {
        const id = $('#walletId').val();

        $.ajax({
            type: 'POST',
            url: deleteRoute,
            data: {id: id},
            dataType: 'json',
            success: function () {
                $('#removeWalletModal').modal('hide');
                $('.row'+id).remove()
            }
        });
    });

    $(document).on('click', '.addTransaction', function () {
        $('#addTransactionModal').modal('show');
    });
});