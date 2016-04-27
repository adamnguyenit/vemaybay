function fixFloatButton() {
    $('.promotion-news .btn').css('top', $('.promotion-news img').outerWidth(true) / 3 - $('.promotion-news .btn').outerWidth(true) / 2);
}
$(document).ready(function() {
    fixFloatButton();
});
$(window).resize(function() {
    fixFloatButton();
});
