function isPageLoaded() {
    return isPrintPrice && isPrintTickets && isPrintPeople;
}

function printPrice() {
    $('#price-box').html(null);
    var total = 0;
    for (key in chooseTickets) {
        if (chooseTickets.hasOwnProperty(key)) {
            var ticket = chooseTickets[key].ticket;
            var ticketOption = null;
            var priceSummary = null;
            for (var i = 0; i < ticket.ticketOptions.length; i++) {
                if (ticket.ticketOptions[i].fareBasis == chooseTickets[key].fareBasis) {
                    ticketOption = ticket.ticketOptions[i];
                    priceSummary = ticket.ticketOptions[i].priceSummary;
                    break;
                }
            }
            var html = '<div id="' + key + '" class="col-md-12">';
            html += '<h4>' + ticket.fromPlace + ' - ' + ticket.toPlace + '</h4>';
            html += '<table class="table table-hover">';
            html += '<thead><tr><th></th><th></th><th></th><th></th></tr></thead>';
            html += '<tbody>';
            for (type in priceSummary) {
                for (k in priceSummary[type]) {
                    if (priceSummary[type].hasOwnProperty(k)) {
                        html += '<tr>';
                        html += '<td>' + priceSummary[type][k].description + '</td>';
                        html += '<td class="text-right">' + parseInt(priceSummary[type][k].price).formatMoney(0, ',', '.') + '</td>';
                        html += '<td>x' + priceSummary[type][k].quantity + '</td>';
                        html += '<td class="color-red text-right">' + parseInt(priceSummary[type][k].total).formatMoney(0, ',', '.') + '</td>';
                        html += '</tr>';
                    }
                }
            }
            total += parseInt(ticketOption.totalPrice);
            html += '<tr><td colspan="3">Thành tiền</td><td class="color-red text-right">' + parseInt(ticketOption.totalPrice).formatMoney(0, ',', '.') + '</td></tr>'
            html += '</tbody>';
            html += '</table>';
            html += '</div>';
            $('#price-box').append(html);
        }
    }
    $('#price-box').append('<div class="col-md-12 text-right"><h3>Tổng: <span class="color-red">' + total.formatMoney(0, ',', '.') + ' VND</span></h3></div>');
    isPrintPrice = true;
}

function printTickets() {
    $('#choose-tickets').html(null);
    for (key in chooseTickets) {
        if (chooseTickets.hasOwnProperty(key)) {
            var ticket = chooseTickets[key].ticket;
            var ticketOption = null;
            for (var i = 0; i < ticket.ticketOptions.length; i++) {
                if (ticket.ticketOptions[i].fareBasis == chooseTickets[key].fareBasis) {
                    ticketOption = ticket.ticketOptions[i];
                    break;
                }
            }
            var html = '<div id="' + key + '-ticket" class="choose-ticket">';
            html += '<div class="row">';
            html += '<div class="col-xs-5 text-center"><h5>' + ticket.fromPlace + '</h5></div>';
            html += '<div class="col-xs-2 text-center"><span class="fa fa-2x fa-plane"></span></div>';
            html += '<div class="col-xs-5 text-center"><h5>' + ticket.toPlace + '</h5></div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-xs-5 text-center">' + dateDecode(ticket.departTime, true) + '</div>';
            html += '<div class="col-xs-2 text-center">' + ticket.flightNumber + '</div>';
            html += '<div class="col-xs-5 text-center">' + dateDecode(ticket.landingTime, true) + '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-xs-5 text-center">Hạng ghế: ' + ticketOption.ticketType + '</div>';
            html += '<div class="col-xs-2 text-center"></div>';
            html += '<div class="col-xs-5 text-center">Tổng giá: <span class="color-red">' + parseInt(ticketOption.totalPrice).formatMoney(0, ',', '.') + ' VND</span></div>';
            html += '</div>';
            html += '</div>';
            $('#choose-tickets').append(html);
        }
    }
    isPrintTickets = true;
}

function valueOf(type) {
    switch (type) {
        case 'adult':
            return '<option value="MR">Ông</option><option value="MRS">Bà</option>';
        case 'child':
            return '<option value="MR">Anh</option><option value="MISS">Chị</option>';
        case 'infant':
            return '<option value="MR">Bé trai</option><option value="MISS">Bé gái</option>';
    }
}

function baggage() {
    return '<option value="0">Không mang hành lý</option>';
}

function printPeople() {
    $('#people').html(null);
    var html = '<div class="col-md-12"><h4>Thông tin hành khách</h4>';
    for (type in people) {
        if (people.hasOwnProperty(type)) {
            for (var i = 1; i <= people[type]; i++) {
                html += '<div class="row">';
                html += '<div class="form-group">';
                html += '<div class="col-sm-2 col-xs-3"><select class="form-control" name="people[' + type + '][' + i + '][title]">' + valueOf(type) + '</select></div>'
                html += '<div class="col-sm-4 col-xs-9"><input class="form-control" name="people[' + type + '][' + i + '][name]" placeholder="Họ và tên"></div>';
                html += '<div class="col-sm-3 col-xs-6">';
                html += '<div class="input-group date" data-provide="datepicker"><input class="form-control datepicker" type="text" name="people[' + type + '][' + i + '][birth]" placeholder="Ngày sinh" readonly><div class="input-group-addon"><span class="fa fa-calendar"></span></div></div>';
                html += '</div>';
                html += '<div class="col-sm-3 col-xs-6"><select class="form-control" name="people[' + type + '][' + i + '][baggage]">' + baggage() + '</select></div>';
                html += '</div>';
                html += '</div>';
            }
        }
    }
    html += '</div>';
    $('#people').append(html);
    isPrintPeople = true;
}

var chooseTickets;
var people;
var isPrintPrice = false;
var isPrintTickets = false;
var isPrintPeople = false;

$(document).ready(function() {
    chooseTickets = JSON.parse(sessionStorage.getItem('chooseTickets'));
    people = JSON.parse(sessionStorage.getItem('people'));
    printPrice();
    printTickets();
    printPeople();
});
