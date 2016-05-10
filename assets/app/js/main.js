const API_URL = 'http://api.vemaybay.com/app/';

function getList(endpoint, handle) {
    $.ajax({
        type: 'GET',
        url: API_URL + endpoint,
        headers: {
            Accept: 'text/html'
        },
        success: function(data, textStatus, jqXHR) {
            handle(data);
        }
    });
}

function getItem(endpoint, handle) {
    $.ajax({
        type: 'GET',
        url: API_URL + endpoint,
        headers: {
            Accept: 'text/html'
        },
        success: function(data, textStatus, jqXHR) {
            handle(data);
        }
    });
}

function searchTickets(data, handle, error) {
    $.ajax({
        type: 'POST',
        url: API_URL + 'tickets/search',
        data: data,
        timeout: 180000,
        success: function(data, textStatus, jqXHR) {
            handle(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            error();
        }
    });
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function dateDecode(date, toString) {
    var split = date.split('T');
    var time = split[1].split(':');
    var hour = time[0];
    var min = time[1];
    var date = split[0].split('-');
    var day = date[2];
    var month = date[1];
    var year = date[0];
    if (toString) {
        return hour + ':' + min + ' ' + day + '/' + month + '/' + year;
    }
    return {
        hour: hour,
        min: min,
        day: day,
        month: month,
        year: year
    };
}

Number.prototype.formatMoney = function(c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

var _interval;
var _sources = ['JetStar', 'VietJetAir', 'VietnamAirlines'];
var _suggestionOpt = {
    serviceUrl: API_URL + 'places/suggestion',
    dataType: 'json',
    paramName: 'q',
    transformResult: function(response) {
        return {
            suggestions: $.map(response.items, function(item) {
                return {
                    value: item.name + ' - ' + item.code,
                    data: item
                };
            })
        };
    },
    groupBy: 'group',
    autoSelectFirst: true,
    showNoSuggestionNotice: true,
    noSuggestionNotice: 'Không tìm thấy sân bay',
    orientation: 'auto'
};

$(document).ready(function() {
    // Material
    $.material.init();

    // Date picker
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $.fn.datepicker.defaults.language = 'vi';
    $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
    $.fn.datepicker.defaults.autoclose = true;
    $.fn.datepicker.defaults.weekStart = 1;
    $.fn.datepicker.defaults.startDate = today;
    $('.datepicker').datepicker();
    $('.linked').change(function() {
        var name = $(this).attr('name');
        if (name) {
            var value = $(this).val();
            var instance = null;
            instance = $('.linked[name=' + name + ']');
            instance.val(value);
            if (value) {
                instance.closest('.form-group').removeClass('is-empty');
            } else {
                instance.closest('.form-group').addClass('is-empty');
            }
        }
    });
    $('.nav a[href="' + this.location.pathname + '"]').parent().addClass('active');

    $('.jscroll').jscroll({
        autoTrigger: true,
        nextSelector: 'a.jscroll-next:last',
        loadingHtml: '<div class="col-md-12 text-center"><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i><span class="sr-only">Đang tải...</span></div>'
    });

    _interval = setInterval(function() {
        if (isPageLoaded()) {
            $('#loading').fadeOut(400, function() {
                $('body').css('overflow-y', 'auto');
            });
            clearInterval(_interval);
        }
    }, 10);

    $('input.places-suggestion').autocomplete(_suggestionOpt);

    getList('places/agent', function(data) {
        $('#places-box-from .agent').append(data);
        $('#places-box-to .agent').append(data);
    });
    getList('places/international', function(data) {
        $('#places-box-from .international').append(data);
        $('#places-box-to .international').append(data);
    });

    $('#places-box-from').on('click', '.list-group-item', function() {
        $('[name=place-from]').val($(this).text());
        $('#places-box-from').modal('hide');
    });
    $('#places-box-to').on('click', '.list-group-item', function() {
        $('[name=place-to]').val($(this).text());
        $('#places-box-to').modal('hide');
    });
    $('.places-box').on('shown.bs.modal', function() {
        var input = $(this).find('input.places-suggestion');
        input.val(null);
        input.focus();
    });
    $('#places-box-from input.places-suggestion').autocomplete().setOptions($.extend(_suggestionOpt, {
        onSelect: function(suggestion) {
            $('[name=place-from]').val(suggestion.value);
            $('#places-box-from').modal('hide');
        }
    }));
    $('#places-box-to input.places-suggestion').autocomplete().setOptions($.extend(_suggestionOpt, {
        onSelect: function(suggestion) {
            $('[name=place-to]').val(suggestion.value);
            $('#places-box-to').modal('hide');
        }
    }));
    clipboard = new Clipboard('.copy-to-clipboard');
});

function isScrolledIntoView(elem) {
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
