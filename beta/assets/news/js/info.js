function getAliasFromUrl() {
    return window.location.href.split('/').pop().split('.html')[0];
}

function setNews(news) {
    var html = '<h1 class="color-red">' + news.title + '</h1>';
    html += '<p class="text-muted"><span class="fa fa-calendar"></span> ' + news.createdAt + '</p>';
    html += news.content;
    $('#news-box').html(html);
}

function addPopular(news) {
    var html = '<div class="popular-news bg-white">';
    html += '<h3><a href="/tin-tuc/' + news.alias + '">' + news.title + '</a></h3>'
    html += '<p>' + news.description + '</p>';
    html += '<a class="btn btn-sm btn-primary pull-right" href="/tin-tuc/' + news.alias + '.html" role="button">Đọc tiếp</a>';
    html += '</div>';
    $('#popular-box').append(html);
}
$(document).ready(function() {
    getItem('news/' + getAliasFromUrl(), function(news) {
        setNews(news);
    });
    getList('news/popular', function(list, nextLink) {
        if (list) {
            $.each(list, function() {
                addPopular(this);
            });
        }
    });
});
