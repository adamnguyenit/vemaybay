function isPageLoaded() {
    return isBookingLoaded;
}

var isBookingLoaded = false;

$(document).ready(function() {
    var id = $('#id').val();
    getItem('books/' + id, function(data) {
        $('#booking-box').html(data);
        isBookingLoaded = true;
    });
});
