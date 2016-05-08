function addPopular(news) {
    $('#popular-box').append(news);
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}

function isPageLoaded() {
    return isNewsLoaded && isPanelsLoaded;
}

var isNewsLoaded = false;
var isPanelsLoaded = false;

$(document).ready(function() {
    getList('news/popular', function(data) {
        addPopular(data);
        isNewsLoaded = true;
    });
    getList('panels', function(data) {
        addPanel(data);
        isPanelsLoaded = true;
    });
    $(document).trigger('scroll');
});
