$(document).ready(function() {
    $('[name=round-trip]').change(function() {
        var value = $(this).val();
        var type = $(this).attr('type');
        if (type == 'radio') {
            $('select[name=round-trip]').val(value);
        } else {
            $('input[type=radio][name=round-trip][value=' + value + ']').prop('checked', true);
        }
        if (value == 0) {
            $('.show-unless-round-trip').hide();
        } else {
            $('.show-unless-round-trip').show();
        }
    });
});
