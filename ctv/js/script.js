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

function getAccessToken() {
    return localStorage.getItem('access-token');
}

function getUserName() {
    var userInfo = JSON.parse(localStorage.getItem('user-info'));
    return userInfo.name;
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function request(verb, endpoint, data, auth, onSuccess, onError, options) {
    var baseURL = 'http://api.vemaybay.com/collaborator/';
    var opt = {};
    var accessToken = getAccessToken();
    if (accessToken) {
        opt.headers = {
            'Authorization': 'Bearer ' + accessToken
        };
    }
    if (typeof auth !== 'undefined' && auth !== null) {
        opt.beforeSend = function(xhr) {
            xhr.setRequestHeader('Authorization', 'Basic ' + btoa(auth.username + ':' + auth.password));
        };
    }
    if (onSuccess) {
        opt.success = onSuccess;
    }
    if (onError) {
        opt.error = onError;
    } else {
        opt.error = function() {
            redirect('login.html')
        };
    }
    opt.method = verb;
    opt.data = data;
    if (options) {
        $.extend(true, opt, options);
    }
    return $.ajax(baseURL + endpoint, opt);
}

function redirect(to) {
    window.location = to;
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
        hour: time,
        min: min,
        day: day,
        month: month,
        year: year
    };
}
