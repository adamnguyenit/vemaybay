function isPageLoaded() {
    return true;
}

$(document).ready(function() {
    $('#search').click(function() {
        if (!$('#search-input').val()) {
            $('#message-box').modal('show');
        } else {
            window.location.href = '/giao-dich/' + $('#search-input').val() + '.html';
        }
    });
});
