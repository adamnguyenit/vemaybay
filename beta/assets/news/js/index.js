function addNews(news) {
    $('#left-side').append(news);
}

function addPopular(news) {
    $('#popular-box').append(news);
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}
$(document).ready(function() {
    getList('news?per-page=1', function(data) {
        if (data) {
            addNews(data);
        }
    });
    getList('news/popular', function(data) {
        if (data) {
          addPopular(data);
        }
    });
    getList('panels', function(data) {
        if (data) {
          addPanel(data);
        }
    });
});
