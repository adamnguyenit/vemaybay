function isUsePlaces() {
    return false;
}

function isUseDatepicker() {
    return false;
}

function isUseClipboard() {
    return false;
}

function isUseWeather() {
    return false;
}

function isPageLoaded() {
    return true;
}

$(document).ready(function() {
    $('#login-form').find('input').first().focus();
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var isOK = true;
        $(this).find('.required').each(function() {
            if (!$(this).val()) {
                isOK = false;
                $(this).closest('.form-group').addClass('has-error');
            }
        });
        if (!isOK) {
            showNotice('Vui lòng điền đầy đủ thông tin!');
        } else {
            $('#login-form').find('button').addClass('disabled');
            $('#login-form').find('button').html('Đang đăng nhập...');
            login($('[name=username]').val().trim(), $('[name=password]').val().trim())
        }
    });
    $(this).find('input').trigger('change');
});
