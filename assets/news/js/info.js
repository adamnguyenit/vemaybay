function getAliasFromUrl() {
    return window.location.href.split('/').pop().split('.html')[0];
}

function setNews(news) {
    $('#news-box').html(news);
}

function addPopular(news) {
    $('#popular-box').append(news);
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}

function isPageLoaded() {
    return isNewsLoaded && isPopularLoaded && isPanelsLoaded;
}

var isNewsLoaded = false;
var isPopularLoaded = false;
var isPanelsLoaded = false;

$(document).ready(function() {
    getItem('news/' + getAliasFromUrl(), function(news) {
        setNews(news);
        isNewsLoaded = true;
    });
    getList('news/popular', function(data) {
        if (data) {
            addPopular(data);
        }
        isPopularLoaded = true;
    });
    getList('panels', function(data) {
        if (data) {
            addPanel(data);
        }
        isPanelsLoaded = true;
    });
});
