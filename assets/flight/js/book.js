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
            html += '<table class="table table-hover" style="width: 100%">';
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
            html += '<tr id="baggage-' + key + '-BG15" class="baggage-' + key + '-box hidden"><td class="baggage-title">Hành lý 15kg</td><td class="text-right baggage-value">0</td><td class="baggage-quantity">x1</td><td class="color-red text-right baggage-price">0</td></tr>';
            html += '<tr id="baggage-' + key + '-BG20" class="baggage-' + key + '-box hidden"><td class="baggage-title">Hành lý 20kg</td><td class="text-right baggage-value">0</td><td class="baggage-quantity">x1</td><td class="color-red text-right baggage-price">0</td></tr>';
            html += '<tr id="baggage-' + key + '-BG25" class="baggage-' + key + '-box hidden"><td class="baggage-title">Hành lý 25kg</td><td class="text-right baggage-value">0</td><td class="baggage-quantity">x1</td><td class="color-red text-right baggage-price">0</td></tr>';
            html += '<tr id="baggage-' + key + '-BG30" class="baggage-' + key + '-box hidden"><td class="baggage-title">Hành lý 30kg</td><td class="text-right baggage-value">0</td><td class="baggage-quantity">x1</td><td class="color-red text-right baggage-price">0</td></tr>';
            html += '<tr id="baggage-' + key + '-BG35" class="baggage-' + key + '-box hidden"><td class="baggage-title">Hành lý 35kg</td><td class="text-right baggage-value">0</td><td class="baggage-quantity">x1</td><td class="color-red text-right baggage-price">0</td></tr>';
            html += '<tr id="baggage-' + key + '-BG40" class="baggage-' + key + '-box hidden"><td class="baggage-title">Hành lý 40kg</td><td class="text-right baggage-value">0</td><td class="baggage-quantity">x1</td><td class="color-red text-right baggage-price">0</td></tr>';
            total += parseInt(ticketOption.totalPrice);
            html += '<tr><td colspan="3"><b>Thành tiền</b></td><td id="total-' + key + '-value" class="color-red text-right" data-base="' + ticketOption.totalPrice + '">' + parseInt(ticketOption.totalPrice).formatMoney(0, ',', '.') + '</td></tr>'
            html += '</tbody>';
            html += '</table>';
            html += '</div>';
            $('#price-box').append(html);
        }
    }
    $('#price-box').append('<div class="col-md-12 text-right"><h3>Tổng: <span id="total-price" class="color-red" data-base="' + total + '">' + total.formatMoney(0, ',', '.') + ' VND</span></h3></div>');
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
            html += '<div class="col-xs-5 text-center"><span class="color-red">' + parseInt(ticketOption.totalPrice).formatMoney(0, ',', '.') + ' VND</span></div>';
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
    return '<option value="0">Xách tay</option><option value="BG15">15kg</option><option value="BG20">20kg</option><option value="BG25">25kg</option><option value="BG30">30kg</option><option value="BG35">35kg</option><option value="BG40">40kg</option>';
}

function printPeople() {
    $('#people').html(null);
    var html = '<div class="col-md-12"><h4 class="color-blue">Thông tin hành khách</h4>';
    for (type in people) {
        if (people.hasOwnProperty(type)) {
            for (var i = 1; i <= people[type]; i++) {
                html += '<div class="row">';
                html += '<div class="col-md-12">'
                html += '<div class="form-group col-sm-2 col-xs-3">';
                html += '<div class="row">';
                html += '<select class="form-control" name="people[' + type + '][' + i + '][title]">' + valueOf(type) + '</select>';
                html += '</div>';
                html += '</div>';
                switch (chooseTickets.depart.ticket.airlineCode) {
                    case 'VietnamAirlines':
                        html += '<div class="form-group label-floating col-sm-6 col-xs-9">';
                        html += '<div class="row">';
                        html += '<label class="control-label">Họ và tên</label>';
                        html += '<input id="bind-to-contact" class="form-control" name="people[' + type + '][' + i + '][name]">';
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="form-group label-floating col-sm-4 col-xs-12">';
                        html += '<div class="row">';
                        html += '<label class="control-label">Ngày sinh</label>';
                        html += '<div class="input-group date" data-provide="datepicker"><input class="form-control datepicker" type="text" name="people[' + type + '][' + i + '][birth]" readonly><div class="input-group-addon"><span class="fa fa-calendar"></span></div></div>';
                        html += '</div>';
                        html += '</div>';
                        break;
                    default:
                        if (chooseTickets.hasOwnProperty('return') && chooseTickets['return'] != null) {
                            html += '<div class="form-group label-floating col-sm-6 col-xs-9">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Họ và tên</label>';
                            html += '<input id="bind-to-contact" class="form-control" name="people[' + type + '][' + i + '][name]">';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="form-group label-floating col-sm-4 col-xs-12">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Ngày sinh</label>';
                            html += '<div class="input-group date" data-provide="datepicker"><input class="form-control datepicker" type="text" name="people[' + type + '][' + i + '][birth]" readonly><div class="input-group-addon"><span class="fa fa-calendar"></span></div></div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="form-group label-floating col-sm-6 col-xs-6">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Hành lý chặng đi</label>';
                            html += '<select class="form-control baggage-depart" name="people[' + type + '][' + i + '][baggage][depart]">' + baggage() + '</select>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="form-group label-floating col-sm-6 col-xs-6">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Hành lý chặng về</label>';
                            html += '<select class="form-control baggage-return" name="people[' + type + '][' + i + '][baggage][return]">' + baggage() + '</select>';
                            html += '</div>';
                            html += '</div>';
                        } else {
                            html += '<div class="form-group label-floating col-sm-4 col-xs-9">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Họ và tên</label>';
                            html += '<input id="bind-to-contact" class="form-control" name="people[' + type + '][' + i + '][name]">';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="form-group label-floating col-sm-3 col-xs-6">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Ngày sinh</label>';
                            html += '<div class="input-group date" data-provide="datepicker"><input class="form-control datepicker" type="text" name="people[' + type + '][' + i + '][birth]" readonly><div class="input-group-addon"><span class="fa fa-calendar"></span></div></div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="form-group label-floating col-sm-3 col-xs-6">';
                            html += '<div class="row">';
                            html += '<label class="control-label">Hành lý</label>';
                            html += '<select class="form-control baggage-depart" name="people[' + type + '][' + i + '][baggage]">' + baggage() + '</select>';
                            html += '</div>';
                            html += '</div>';
                        }
                }
                html += '</div>';
                html += '</div>';
            }
        }
    }
    html += '</div>';
    $('#people').append(html);
    // Material
    $.material.init();
    isPrintPeople = true;
}

function printBaggage() {
    var baggage = {};
    var baggagePrice = {
        BG15: 150000,
        BG20: 170000,
        BG25: 230000,
        BG30: 300000,
        BG35: 350000,
        BG40: 400000
    };
    $('.baggage-depart').each(function() {
        var val = $(this).val();
        if (!baggage.hasOwnProperty('depart')) {
            baggage['depart'] = {};
        }
        if (baggage['depart'].hasOwnProperty(val)) {
            baggage['depart'][val]++;
        } else {
            baggage['depart'][val] = 1;
        }
    });
    $('.baggage-return').each(function() {
        var val = $(this).val();
        if (!baggage.hasOwnProperty('return')) {
            baggage['return'] = {};
        }
        if (baggage['return'].hasOwnProperty(val)) {
            baggage['return'][val]++;
        } else {
            baggage['return'][val] = 1;
        }
    });
    var totalBaggagePrice = {
        'depart': 0,
        'return': 0,
    };
    for (key in baggage) {
        $('.baggage-' + key + '-box').addClass('hidden');
        if (baggage.hasOwnProperty(key)) {
            for (type in baggage[key]) {
                if (baggage[key].hasOwnProperty(type) && type != '0') {
                    if (totalBaggagePrice.hasOwnProperty(key)) {
                        totalBaggagePrice[key] += baggagePrice[type] * baggage[key][type];
                    } else {
                        totalBaggagePrice[key] = baggagePrice[type] * baggage[key][type];
                    }
                    var ins = $('#baggage-' + key + '-' + type);
                    ins.removeClass('hidden');
                    ins.find('.baggage-value').html(baggagePrice[type].formatMoney(0, ',', '.'));
                    ins.find('.baggage-quantity').html('x' + baggage[key][type]);
                    ins.find('.baggage-price').html((baggagePrice[type] * baggage[key][type]).formatMoney(0, ',', '.'));
                }
            }
        }
    }
    var totalPayment = parseInt($('#total-price').data('base'));
    for (key in totalBaggagePrice) {
        totalPayment += totalBaggagePrice[key];
        $('#total-' + key + '-value').html((parseInt($('#total-' + key + '-value').data('base')) + totalBaggagePrice[key]).formatMoney(0, ',', '.'));
    }
    $('#total-price').html(totalPayment.formatMoney(0, ',', '.') + ' VND');
}

var chooseTickets;
var people;
var isPrintPrice = false;
var isPrintTickets = false;
var isPrintPeople = false;

$(document).ready(function() {
    $.fn.datepicker.defaults.startDate = null;
    chooseTickets = JSON.parse(sessionStorage.getItem('chooseTickets'));
    people = JSON.parse(sessionStorage.getItem('people'));
    printPrice();
    printTickets();
    printPeople();
    $('#bind-to-contact').change(function() {
        if ($('#contact-name').val() == '') {
            $('#contact-name').val($(this).val());
            $('#contact-name').closest('.form-group').removeClass('is-empty');
        }
    });
    $('#bind-to-contact').focus();
    $('#payment-value').change(function() {
        if ($(this).val() == 'at_store') {
            $('#at_store').show();
            $('#bank').hide();
        } else {
            $('#at_store').hide();
            $('#bank').show();
        }
    });
    $('.baggage-depart').on('change', function() {
        printBaggage();
    });
    $('.baggage-return').on('change', function() {
        printBaggage();
    });
});
