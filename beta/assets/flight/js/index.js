$(document).ready(function() {
    $('input[name=round-trip]').click(function() {
        if ($(this).val() == 0) {
            $('.show-unless-round-trip').hide();
        } else {
            $('.show-unless-round-trip').show();
        }
    });
});

$(document).resize(function() {});
