function isPageLoaded() {
    return true;
}

$(document).ready(function() {
    $('#search').click(function() {
        var isOK = true;
        $('input.required').each(function() {
            if (!$(this).val()) {
                isOK = false;
            }
        });
        if (!isOK) {
            $('#message-box').modal('show');
        } else {
            window.location.href = '/giao-dich/' + $('#search-input').val().trim() + '-' + $('#phone-input').val().trim() + '.html';
        }
    });
});
