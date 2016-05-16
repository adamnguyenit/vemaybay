function isPageLoaded() {
    return true;
}

$(document).ready(function() {
    var id = $('#id').val();
    getItem('books/' + id, function(data) {
        $('#booking-box').html(data);
    });
});
