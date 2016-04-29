function addNews(news) {
    var html = '<div class="row">';
    html += '<div class="news bg-white">';
    if (news.image) html += '<img class="pull-left hidden-xs" src="' + news.image + '">';
    html += '<h3><a class="color-red" href="/tin-tuc/' + news.alias + '.html">' + news.title + '</a></h3>';
    html += '<p class="text-muted"><span class="fa fa-calendar"></span> ' + news.createdAt + '</p>';
    html += '<p>' + news.description + '</p>';
    html += '<a class="btn btn-primary pull-right" href="/tin-tuc/' + news.alias + '.html" role="button">Đọc tiếp</a>';
    html += '</div>';
    html += '</div>';
    $('#left-side').append(html);
}

function addPopular(news) {
    var html = '<div class="popular-news bg-white">';
    html += '<h3><a href="/tin-tuc/' + news.alias + '.html">' + news.title + '</a></h3>'
    html += '<p>' + news.description + '</p>';
    html += '<a class="btn btn-sm btn-primary pull-right" href="/tin-tuc/' + news.alias + '.html" role="button">Đọc tiếp</a>';
    html += '</div>';
    $('#popular-box').append(html);
}

function addPanel(panel) {
    var html = '<div class="panel"><a href="' + panel.link + '"><img src="' + panel.image + '"></a></div>';
    $('#panel-box').append(html);
}
$(document).ready(function() {
    getList('news', function(list, nextLink) {
        if (list) {
            $.each(list, function() {
                addNews(this);
            });
        }
    });
    getList('news/popular', function(list, nextLink) {
        if (list) {
            $.each(list, function() {
                addPopular(this);
            });
        }
    });
    getList('panels', function (list, nextLink) {
        if (list) {
            $.each(list, function () {
                addPanel(this);
            });
        }
    });
});
