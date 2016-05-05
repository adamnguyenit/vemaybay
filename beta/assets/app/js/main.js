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

var _interval;

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
            $('#loading').fadeOut();
            clearInterval(_interval);
        }
    }, 200);

    $('input.places-suggestion').autocomplete({
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
    });
});
