function isPageLoaded() {
    return isBookingLoaded;
}

var isBookingLoaded = false;

$(document).ready(function() {
    var bill = localStorage.getItem('bill');
    if (bill) {
        bill = JSON.parse(bill);
        $('[name=bill_name]').val(bill.name);
        $('[name=bill_address]').val(bill.address);
        $('[name=bill_code]').val(bill.code);
        $('[name=bill_contact]').val(bill.contact);
        $('[name=bill_phone]').val(bill.phone);
        $('#bill-box input').trigger('change');
    }
    var id = $('#id').val();
    getItem('books/' + id, function(data) {
        $('#booking-box').html(data);
        isBookingLoaded = true;
    });
    $('#booking-box').on('click', '#bill', function() {
        $('#bill-box').modal('show');
    });
    $('#bill-ok').click(function() {
        var isOK = true;
        $('#bill-box input').each(function() {
            if (!$(this).val()) {
                $(this).closest('.form-group').addClass('has-error');
                isOK = false;
            }
        });
        if (isOK) {
            var data = {
                name: $('[name=bill_name]').val(),
                address: $('[name=bill_address]').val(),
                code: $('[name=bill_code]').val(),
                contact: $('[name=bill_contact]').val(),
                phone: $('[name=bill_phone]').val()
            };
            localStorage.setItem('bill', JSON.stringify(data));
            $('#bill-ok').addClass('disabled');
            $('#bill-ok').html('Vui lòng đợi...');
            var onComplete = function() {
                // location.reload();
            }
            request('PUT', 'books/' + id + '/options', {
                options: {
                    bill: data
                }
            }, onComplete, onComplete);
        }
    });
});
