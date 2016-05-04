function fixFloatButton() {
    $('.promotion-news .btn').css('top', $('.promotion-news img').outerWidth(true) * (3 / 8) - $('.promotion-news .btn').outerWidth(true) / 2);
}
function addPanel(panel) {
    $('#panel-box').append(panel);
}
$(document).ready(function() {
    fixFloatButton();
    getList('panels', function(data) {
        if (data) {
          addPanel(data);
        }
    });
});
$(window).resize(function() {
    fixFloatButton();
});
