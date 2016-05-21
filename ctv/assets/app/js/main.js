const API_URL = 'http://api.vemaybay.com/collaborator/';

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

function storeAccessToken(accessToken) {
    localStorage.setItem('access-token', accessToken);
}

function getAccessToken() {
    return localStorage.getItem('access-token');
}

function resetUser() {
    localStorage.removeItem('user-info');
    localStorage.removeItem('access-token');
}

function storeUserInfo(info) {
    localStorage.setItem('user-info', JSON.stringify(info));
}

function storeAccessToken(accessToken) {
    localStorage.setItem('access-token', accessToken);
}

function getUserName() {
    var userInfo = JSON.parse(localStorage.getItem('user-info'));
    if (userInfo) {
        return userInfo.name;
    }
    return null;
}

function showNotice(message) {
    $('#message-box').on('show.bs.modal', function() {
        $(this).find('.modal-body').html('<p>' + message + '</p>');
    });
    $('#message-box').modal('show');
}

function redirect(to) {
    window.location = to;
}

function getWeather(location, selector) {
    $.simpleWeather({
        location: location,
        unit: 'c',
        success: function(data) {
            var html = '';
            html += '<h2>' + data.city + '</h2>';
            html += '<h3><i class="icon-' + data.code + '"></i> ' + data.temp + '&deg;' + data.units.temp + '</h3>'
            selector.html(html);
        }
    });
}

function request(type, endpoint, data, handle, error) {
    $.ajax({
        type: type,
        url: API_URL + endpoint,
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + getAccessToken()
        },
        data: data,
        success: function(data, textStatus, jqXHR) {
            handle(data);
        },
        error: function() {
            error();
        }
    });
}

function login(username, password) {
    $.ajax({
        type: 'POST',
        url: API_URL + 'users/login',
        headers: {
            Accept: 'application/json',
            Authorization: 'Basic ' + btoa(username + ':' + password)
        },
        success: function(data, textStatus, jqXHR) {
            storeUserInfo(data);
            storeAccessToken(data.accessToken);
            redirect('/');
        },
        error: function() {
            showNotice('Tên đăng nhập hoặc mật khẩu không đúng');
        }
    });
}

function loginAgain() {
    resetUser();
    redirect('dang-nhap.html');
}

function logout() {
    $.ajax({
        type: 'POST',
        url: API_URL + 'users/logout',
        headers: {
            Authorization: 'Bearer ' + getAccessToken()
        },
        success: function(data, textStatus, jqXHR) {
            loginAgain();
        },
        error: function() {
            loginAgain();
        }
    });
}

function getList(endpoint, handle) {
    $.ajax({
        type: 'GET',
        url: API_URL + endpoint,
        headers: {
            Accept: 'text/html',
            Authorization: 'Bearer ' + getAccessToken()
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
        headers: {
            Accept: 'application/json',
            Authorization: 'Bearer ' + getAccessToken()
        },
        data: data,
        timeout: 180000,
        success: function(data, textStatus, jqXHR) {
            handle(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 401) {
                loginAgain()
            } else {
                error();
            }
        }
    });
}

function bookTickets(tickets, passengers, payment, contact, price, query, handle, error) {
    var data = {
        tickets: tickets,
        passengers: passengers,
        payment: payment,
        contact: contact,
        price: price,
        adult: parseInt(query['adult']),
        child: parseInt(query['child']),
        infant: parseInt(query['infant'])
    };
    $.ajax({
        type: 'POST',
        url: API_URL + 'books',
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

$(document).ready(function() {
    if (window.location.pathname != '/dang-nhap.html' && (!getAccessToken() || getAccessToken() == '')) {
        redirect('dang-nhap.html');
    }

    // Material
    $.material.init();

    if (isUseDatepicker()) {
        // Date picker
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $.fn.datepicker.defaults.language = 'vi';
        $.fn.datepicker.defaults.format = 'dd/mm/yyyy';
        $.fn.datepicker.defaults.autoclose = true;
        $.fn.datepicker.defaults.weekStart = 1;
        $.fn.datepicker.defaults.startDate = today;
        $('.datepicker').datepicker();
    }

    if (isUsePlaces()) {
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
            $('[name=place-from]').closest('.form-group').removeClass('is-empty');
            $('#places-box-from').modal('hide');
        });
        $('#places-box-to').on('click', '.list-group-item', function() {
            $('[name=place-to]').val($(this).text());
            $('[name=place-to]').closest('.form-group').removeClass('is-empty');
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
                $('[name=place-from]').closest('.form-group').removeClass('is-empty');
                $('#places-box-from').modal('hide');
            }
        }));
        $('#places-box-to input.places-suggestion').autocomplete().setOptions($.extend(_suggestionOpt, {
            onSelect: function(suggestion) {
                $('[name=place-to]').val(suggestion.value);
                $('[name=place-to]').closest('.form-group').removeClass('is-empty');
                $('#places-box-to').modal('hide');
            }
        }));
    }

    if (isUseClipboard()) {
        clipboard = new Clipboard('.copy-to-clipboard');
    }

    if (isUseWeather()) {
        $('.weather-box').each(function() {
            getWeather($(this).data('location'), $(this));
        });
    }

    if ($('#user')) {
        $('#user').html(getUserName() + ' <span class="caret"></span>');
    }
    if ($('#logout-btn')) {
        $('#logout-btn').click(function(e) {
            e.preventDefault();
            logout();
        });
    }

    _interval = setInterval(function() {
        if (isPageLoaded()) {
            $('#loading').fadeOut(400, function() {
                $('body').css('overflow-y', 'auto');
            });
            clearInterval(_interval);
        }
    }, 10);

    $('.nav a[href="' + this.location.pathname + '"]').parent().addClass('active');
});
