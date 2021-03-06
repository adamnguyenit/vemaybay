function isUsePlaces() {
    return true;
}

function isUseDatepicker() {
    return true;
}

function isUseClipboard() {
    return true;
}

function isUseWeather() {
    return false;
}

function isPageLoaded() {
    return true;
}

var flightTables = {};
var tickets = {};
var _count = 0;
var chooseTickets = {};
var flightTablesHidedColumn = [2, 5];
var flightTablesHidedWidth = 480;
var flightTableOption = {
    paging: false,
    autoWidth: true,
    dom: 't',
    aaSorting: [],
    language: {
        sProcessing: "Đang xử lý...",
        sZeroRecords: "Không tìm thấy vé"
    },
    columns: [{
        data: 'airline',
        type: 'html',
        render: function(data, type, full, meta) {
            switch (data) {
                case 'JetStar':
                    return '<span class="label label-danger">JS</span>';
                case 'VietnamAirlines':
                    return '<span class="label label-primary">VN</span>';
                case 'VietJetAir':
                    return '<span class="label label-warning">VJ</span>';
                default:
                    return '<span class="label label-default">' + data + '</span>';
            }
        }
    }, {
        data: 'departTime',
        type: 'html',
        render: function(data, type, full, meta) {
            var d = dateDecode(data);
            return d.hour + ':' + d.min;
        }
    }, {
        data: 'flightDuration',
        type: 'flight-duration',
        render: function(data, type, full, meta) {
            return data.replace('P', '').replace('T', '').replace('D', ' ngày ').replace('H', ' giờ ').replace('M', ' phút').trim();
        }
    }, {
        data: 'flightNumbers',
        type: 'flight-number',
        render: function(data, type, full, meta) {
            return data.join(', ');
        }
    }, {
        data: 'priceFrom',
        type: 'num-fmt',
        render: $.fn.dataTable.render.number('.', ',', 0),
        className: 'text-right color-red'
    }, {
        data: 'seatAvailable',
        render: function(data, type, full, meta) {
            if (data > 0) {
                return '<span class="label label-warning">Còn ' + data + ' chỗ</span>';
            }
            return null;
        }
    }],
    createdRow: function(row, data, index) {
        $(row).addClass('ticket');
        $(row).attr('data-id', data.id);
        $(row).attr('data-airline', data.airlineCode);
    }
};

$.extend($.fn.dataTableExt.oSort, {
    'flight-duration-pre': function(a) {
        var str = String(a);
        var x = 0;
        str = str.split(' ngày');
        if (str.length == 2 || (str.length == 1 && str[0].length > 0 && !isNaN(str[0]))) {
            x += parseInt(str[0]) * 24 * 60;
        }
        if (str.length > 0) {
            str = str[str.length - 1].trim();
            str = str.split(' giờ');
            if (str.length == 2 || (str.length == 1 && str[0].length > 0 && !isNaN(str[0]))) {
                x += parseInt(str[0]) * 60;
            }
        }
        if (str.length > 0) {
            str = str[str.length - 1].trim();
            str = str.split(' phút');
            if (str.length == 2 || (str.length == 1 && str[0].length > 0 && !isNaN(str[0]))) {
                x += parseInt(str[0]);
            }
        }
        return x;
    },
    'flight-duration-asc': function(a, b) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
    'flight-duration-desc': function(a, b) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
});

$.extend($.fn.dataTableExt.oSort, {
    'flight-number-pre': function(a) {
        var str = String(a);
        return str.split(', ').length;
    },
    'flight-number-asc': function(a, b) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
    'flight-number-desc': function(a, b) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
});

function resizeTable() {
    var visible = false;
    if ($(window).width() > flightTablesHidedWidth) {
        visible = true;
    }
    $.each(flightTablesHidedColumn, function() {
        if (flightTables['depart']) {
            flightTables['depart'].column(this).visible(visible);
            $('#depart-table').css('width', '100%');
        }
        if (flightTables['return']) {
            flightTables['return'].column(this).visible(visible);
            $('#return-table').css('width', '100%');
        }
    });
}

function getSearchData(s) {
    var roundTrip = parseInt($('#params input[name=params_round-trip]').val());
    var fromPlace = $('#params input[name=params_place-from]').val().split(' - ');
    var toPlace = $('#params input[name=params_place-to]').val().split(' - ');
    var departDate = $('#params input[name=params_date-depart]').val().split('/');
    var returnDate = $('#params input[name=params_date-return]').val().split('/');
    var adult = parseInt($('#params input[name=params_adult]').val());
    var child = parseInt($('#params input[name=params_child]').val());
    var infant = parseInt($('#params input[name=params_infant]').val());
    var sources = s.join(',');
    fromPlace = fromPlace[fromPlace.length - 1];
    toPlace = toPlace[toPlace.length - 1];
    departDate = departDate[2] + '-' + departDate[1] + '-' + departDate[0];
    returnDate = returnDate[2] + '-' + returnDate[1] + '-' + returnDate[0];
    if (roundTrip == 0) {
        returnDate = departDate;
    }
    return {
        roundTrip: roundTrip,
        fromPlace: fromPlace,
        toPlace: toPlace,
        departDate: departDate,
        returnDate: returnDate,
        adult: adult,
        child: child,
        infant: infant,
        sources: sources
    };
}

function startSearch() {
    _count = 0;
    $('.hide-when-done').show();
    var onComplete = function() {
        _count++;
        if (_count >= _sources.length) {
            if (flightTables['depart'] == null) {
                flightTables['depart'] = $('#depart-table').DataTable(flightTableOption);
                resizeTable();
            }
            if (parseInt($('#params input[name=params_round-trip]').val()) == 1 && flightTables['return'] == null) {
                flightTables['return'] = $('#return-table').DataTable(flightTableOption);
                resizeTable();
            }
            $('.hide-when-done').hide();
        }
    }
    var onSuccess = function(data) {
        if (data.hasOwnProperty('depart')) {
            if (flightTables['depart'] == null) {
                flightTables['depart'] = $('#depart-table').DataTable(flightTableOption);
                resizeTable();
                tickets['depart'] = [];
            }
            flightTables['depart'].rows.add(data['depart']).draw();
            flightTables['depart'].columns.adjust().draw();
            $.each(data['depart'], function() {
                tickets['depart'][this.id] = this;
            });
        }
        if (data.hasOwnProperty('return')) {
            if (flightTables['return'] == null) {
                flightTables['return'] = $('#return-table').DataTable(flightTableOption);
                resizeTable();
                tickets['return'] = [];
            }
            flightTables['return'].rows.add(data['return']).draw();
            flightTables['return'].columns.adjust().draw();
            $.each(data['return'], function() {
                tickets['return'][this.id] = this;
            });
        }
        processScroll();
        onComplete();
    };
    var onError = function() {
        onComplete();
    };
    $.each(_sources, function() {
        searchTickets(getSearchData([this]), onSuccess, onError);
    });
};

function isOk() {
    var roundTrip = parseInt($('#params input[name=params_round-trip]').val());
    if (roundTrip == 0) {
        if (chooseTickets.hasOwnProperty('depart') && chooseTickets['depart'] != null) {
            return true;
        }
    } else {
        if (chooseTickets.hasOwnProperty('depart') && chooseTickets.hasOwnProperty('return') && chooseTickets['return'] != null) {
            return true;
        }
    }
    return false;
}

function processScroll() {
    if (isOk()) {
        if ($('#next-step').visible()) {
            $('#scroll-to-next').hide();
        } else {
            $('#scroll-to-next').show();
        }
    }
}

function nextStep() {
    $('#choose-tickets').hide();
    $('#choose-tickets-body').html(null);
    var flightTypes = ['depart', 'return'];
    $.each(flightTypes, function() {
        if (chooseTickets.hasOwnProperty(this) && chooseTickets[this] != null) {
            $('#choose-tickets').show();
            var ticket = chooseTickets[this].ticket;
            var ticketOption = null;
            for (var i = 0; i < ticket.ticketOptions.length; i++) {
                if (ticket.ticketOptions[i].fareBasis == chooseTickets[this].fareBasis) {
                    ticketOption = ticket.ticketOptions[i];
                    break;
                }
            }
            var html = '<div id="' + this + '-ticket" class="choose-ticket">';
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
            $('#choose-tickets-body').append(html);
        }
    });
    if (isOk()) {
        $('#next-step').show();
        if ($('#next-step').visible()) {
            $('#scroll-to-next').hide();
        } else {
            $('#scroll-to-next').show();
        }
        sessionStorage.setItem('chooseTickets', JSON.stringify(chooseTickets));
        sessionStorage.setItem('people', JSON.stringify({
            adult: parseInt($('#params input[name=params_adult]').val()),
            child: parseInt($('#params input[name=params_child]').val()),
            infant: parseInt($('#params input[name=params_infant]').val())
        }));
    } else {
        $('#next-step').hide();
        $('#scroll-to-next').hide();
    }
}

function childOfTicket(type, id) {
    var types = ['adult', 'child', 'infant'];
    var ticket = tickets[type][id];
    var copyText = 'Hành trình: ' + ticket.fromPlace + ' - ' + ticket.toPlace + "\n";
    copyText += 'Bay lúc: ' + dateDecode(ticket.departTime, true) + ' - đến lúc: ' + dateDecode(ticket.landingTime, true) + "\n";
    copyText += 'Thời gian bay: ' + ticket.flightDuration.match(/PT(.*)/)[1].replace('D', ' ngày').replace('H', ' giờ ').replace('M', ' phút') + "\n";
    copyText += 'Mã chuyến bay: ' + ticket.airline + ' ' + ticket.flightNumbers.join(', ') + "\n";
    copyText += 'Giá vé bao gồm ' + $('#params input[name=params_adult]').val() + ' người lớn, ' + $('#params input[name=params_child]').val() + ' trẻ em và ' + $('#params input[name=params_infant]').val() + ' em bé' + "\n";
    copyText += 'Giá vé theo hạng ghế (đã bao gồm thuế phí): ' + "\n";
    for (var i = 0; i < ticket.ticketOptions.length; i++) {
        copyText += '    - ' + ticket.ticketOptions[i].ticketType + ': ' + parseInt(ticket.ticketOptions[i].totalPrice).formatMoney(0, ',', '.') + " VND\n";
    }
    copyText += 'Vui lòng xem chi tiết tại: http://vemaybayhaiphiyen.com';
    var placeFromCode = $('#params input[name=params_place-from]').val().split(' - ');
    placeFromCode = placeFromCode[placeFromCode.length - 1];
    var placeToCode = $('#params input[name=params_place-to]').val().split(' - ');
    placeToCode = placeToCode[placeToCode.length - 1];
    var smsText = 'HT: ';
    if (type === 'depart') {
        smsText += placeFromCode + ' - ' + placeToCode + ', ';
    } else {
        smsText += placeToCode + ' - ' + placeFromCode + ', ';
    }
    var flightStart = dateDecode(ticket.departTime, false);
    smsText += flightStart.day + '/' + flightStart.month + ', LUC ' + flightStart.hour + ':' + flightStart.min + ', ';
    smsText += 'CBAY ' + ticket.flightNumber + ', ';
    smsText += 'GIA ' + parseInt(ticket.ticketOptions[0].totalPrice).formatMoney(0, ',', '.') + ' VND';
    var html = '<div class="ticket-detailed">';
    html += '<button class="btn btn-sm btn-info copy-to-clipboard" data-clipboard-text="' + copyText + '"><span class="fa fa-clipboard"></span></button> <button class="btn btn-sm btn-info copy-to-clipboard" data-clipboard-text="' + smsText + '">SMS</button>';
    // Ticket detail
    if (!ticket.flightDetails || ticket.flightDetails.length < 1) {
        console.log(ticket);
    }
    $.each(ticket.flightDetails, function() {
        html += '<table class="ticket-detail"><tbody>';
        html += '<tr>';
        html += '<td><b>' + this.from + '</b></td>';
        html += '<td><span class="fa fa-fighter-jet"></span></td>';
        html += '<td><b>' + this.to + '</b></td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td>' + dateDecode(this.departTime, true) + '</td>';
        html += '<td></td>';
        html += '<td>' + dateDecode(this.landingTime, true) + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td colspan="3">Mã chuyến bay: ' + this.airline + ' ' + this.flightNumber + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td colspan="3">Thời gian bay: ' + this.flightDuration + '</td>';
        html += '</tr>';
        html += '<tr>';
        html += '</tbody></table>';
    });
    // Price detail
    html += '<table class="table" style="margin-bottom: 0">';
    html += '<thead><tr><th class="mobile-no-padding-left">Loại</th><th style="text-align: right">Giá</th><th style="text-align: right">Tổng</th><th></th></tr></thead>';
    html += '<tbody>';

    var currentOption;
    for (var i = 0; i < ticket.ticketOptions.length; i++) {
        currentOption = ticket.ticketOptions[i];
        html += '<tr>';
        html += '<td class="mobile-no-padding-left"><b>' + currentOption.ticketType + '</b></td>';
        html += '<td style="text-align: right">';
        if (currentOption.priceSummary.hasOwnProperty('net')) {
            if (currentOption.priceSummary['net'].hasOwnProperty('adult')) {
                html += parseInt(currentOption.priceSummary['net']['adult'].price).formatMoney(0, ',', '.');
            }
        }
        html += '</td>';
        html += '<td class="color-red" style="text-align: right">' + parseInt(currentOption.totalPrice).formatMoney(0, ',', '.') + '</td>';
        html += '<td><div class="radio radio-primary" style="margin-top: 0"><label>';
        if (chooseTickets.hasOwnProperty(type) && chooseTickets[type] != null && chooseTickets[type]['ticket']['id'] == ticket.id && chooseTickets[type]['fareBasis'] == currentOption.fareBasis) {
            html += '<input data-ticket-id="' + ticket.id + '" type="radio" name="choose" value="' + currentOption.fareBasis + '" checked>';
        } else {
            html += '<input data-ticket-id="' + ticket.id + '" type="radio" name="choose" value="' + currentOption.fareBasis + '">';
        }
        html += '</label></div></td>';
        html += '</tr>';
        html += '<tr>';
        html += '<td class="mobile-no-padding-left" colspan="4" style="border-top: 0">';
        html += '<table class="price-detail"><tbody>';
        if (currentOption.priceSummary.hasOwnProperty('net')) {
            for (var j = 0; j < types.length; j++) {
                if (currentOption.priceSummary['net'].hasOwnProperty(types[j])) {
                    temp = currentOption.priceSummary['net'][types[j]];
                    if (temp) {
                        html += '<tr><td class="mobile-no-padding-left">' + temp.description + ' x ' + temp.quantity + '</td><td style="text-align: right">' + parseInt(temp.total).formatMoney(0, ',', '.') + '</td></tr>';
                    }
                }
            }
        }
        if (currentOption.priceSummary.hasOwnProperty('tax')) {
            for (var j = 0; j < types.length; j++) {
                if (currentOption.priceSummary['net'].hasOwnProperty(types[j])) {
                    temp = currentOption.priceSummary['tax'][types[j]];
                    if (temp) {
                        html += '<tr><td>' + temp.description + ' x ' + temp.quantity + '</td><td style="text-align: right">' + parseInt(temp.total).formatMoney(0, ',', '.') + '</td></tr>';
                    }
                }
            }
        }
        html += '</tbody></table>';
        html += '</td>';
        html += '</tr>';
    }

    html += '</tbody>';
    html += '</table>';
    html += '</div>';
    return html;
}

$(document).ready(function() {
    $('[name=round-trip]').change(function() {
        var value = $(this).val();
        var type = $(this).attr('type');
        if (type == 'radio') {
            $('select[name=round-trip]').val(value);
        } else {
            $('input[type=radio][name=round-trip][value=' + value + ']').prop('checked', true);
        }
        if (value == 0) {
            $('.show-unless-round-trip').hide();
        } else {
            $('.show-unless-round-trip').show();
        }
    });

    // Fix datatable within tab
    $('.nav-tabs a').on('shown.bs.tab', function(event) {
        var href = $(event.target).attr('href');
        if (href) {
            var type = 'return';
            if (href == '#depart-box') {
                type = 'depart';
            }
        }
        if (flightTables[type]) {
            flightTables[type].columns.adjust().draw();
            $('#' + type + '-table').css('width', '100%');
        }
    });

    // Show ticket information
    $('#depart-table').on('click', 'tr.ticket td', function() {
        var tr = $(this).closest('tr');
        var row = flightTables['depart'].row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(childOfTicket('depart', tr.data('id'))).show();
            $.material.init();
            tr.addClass('shown');
        }
        $('.copy-to-clipboard').tooltip({
            title: 'Đã sao chép',
            trigger: 'manual'
        });
    });
    $('#return-table').on('click', 'tr.ticket td', function() {
        var tr = $(this).closest('tr');
        var row = flightTables['return'].row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(childOfTicket('return', tr.data('id'))).show();
            $.material.init();
            tr.addClass('shown');
        }
        $('.copy-to-clipboard').tooltip({
            title: 'Đã sao chép',
            trigger: 'manual'
        });
    });
    $('.tickets-table').on('click', '.copy-to-clipboard', function() {
        var tooltip = $(this);
        tooltip.tooltip('show');
        setTimeout(function() {
            tooltip.tooltip('hide');
        }, 1000);
    });

    // Select tickets
    $('#depart-table').on('click', 'input[type=radio][name=choose]', function() {
        var ticketId = $(this).data('ticket-id');
        var fareBasis = $(this).val();
        if (fareBasis === 'null') {
            fareBasis = null;
        }
        var departTicket = tickets['depart'][ticketId];
        chooseTickets['depart'] = {
            ticket: departTicket,
            fareBasis: fareBasis
        };
        if (chooseTickets.hasOwnProperty('return') && chooseTickets['return'] != null && departTicket.airlineCode != chooseTickets['return']['ticket'].airlineCode) {
            chooseTickets['return'] = null;
        }
        $('#depart-table tr.ticket').removeClass('info');
        $('#depart-table tr.ticket[data-id=' + ticketId.replace('@', '\\@') + ']').addClass('info');
        if (flightTables['return'] != null) {
            $.fn.dataTable.ext.search.pop();
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    if (settings.sTableId != 'return-table') return true;
                    return $(flightTables['return'].row(dataIndex).node()).attr('data-airline') == chooseTickets['depart']['ticket']['airlineCode'];
                }
            );
            flightTables['return'].draw();
        }
        nextStep();
    });
    $('#return-table').on('click', 'input[type=radio][name=choose]', function() {
        if (!chooseTickets.hasOwnProperty('depart') || chooseTickets['depart'] == null) {
            showNotice('Vui lòng chọn vé chiều đi trước.');
            $(this).prop('checked', false);
        } else {
            var ticketId = $(this).data('ticket-id');
            var fareBasis = $(this).val();
            if (fareBasis === 'null') {
                fareBasis = null;
            }
            chooseTickets['return'] = {
                ticket: tickets['return'][ticketId],
                fareBasis: fareBasis
            };
            $('#return-table tr.ticket').removeClass('info');
            $('#return-table tr.ticket[data-id=' + ticketId.replace('@', '\\@') + ']').addClass('info');
            nextStep();
        }
    });

    $('#scroll-to-next').click(function() {
        $('html, body').animate({
            scrollTop: $('#next-step').offset().top
        }, 500);
    });

    startSearch();

    resizeTable();
});

$(window).resize(function() {
    resizeTable();
});

$(window).scroll(function() {
    processScroll();
});
