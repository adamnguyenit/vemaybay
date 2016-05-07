function addSlide(slide) {
    $('#promotions-slider').prepend(slide);
    $('#promotions-slider').carousel();
}

function addPanel(panel) {
    $('#panel-box').append(panel);
}

function isPageLoaded() {
    return isSlidesLoaded && isPanelsLoaded;
}

var isSlidesLoaded = false;
var isPanelsLoaded = false;

$.extend($.fn.dataTableExt.oSort, {
    'flight-duration-pre': function(a) {
        var str = String(a);
        var x = 0;
        str = str.split(' ngày');
        if (str.length > 0) {
            x += parseInt(str[0]) * 24 * 60;
        }
        if (str.length > 1) {
            str = str[str.length - 1];
            str = str.split(' giờ');
            if (str.length > 0) {
                x += parseInt(str[0]) * 60;
            }
        }
        if (str.length > 1) {
            str = str[str.length - 1];
            str = str.split(' phút');
            if (str.length > 0) {
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
            var val = data.match(/PT(.*)/)[1];
            return val.replace('D', ' ngày').replace('H', ' giờ ').replace('M', ' phút');
        }
    }, {
        data: 'flightNumber'
    }, {
        data: 'priceFrom',
        type: 'num-fmt',
        render: $.fn.dataTable.render.number('.', ',', 0),
        className: 'text-right color-red'
    }, {
        data: 'seatAvailable',
        render: function(data, type, full, meta) {
            if (data == 1) {
                return '<span class="label label-danger">Còn 1 vé</span>';
            } else if (data > 0 && data <= 4) {
                return '<span class="label label-warning">Sắp hết</span>';
            }
            return null;
        }
    }],
    createdRow: function(row, data, index) {
        $(row).attr('data-id', data.id);
        $(row).attr('data-airline', data.airlineCode);
    }
};
var flightTables = {};
var tickets = {};
var _count = 0;

function childOfTicket(type, id) {
    var types = ['adult', 'child', 'infant'];
    var ticket = tickets[type][id];
    var html = '<table class="ticket-detail"><tbody>';
    // Ticket detail
    html += '<tr>';
    html += '<td>' + ticket.fromPlace + '</td>';
    html += '<td><span class="fa fa-fighter-jet"></span></td>';
    html += '<td>' + ticket.toPlace + '</td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td>' + dateDecode(ticket.departTime, true) + '</td>';
    html += '<td></td>';
    html += '<td>' + dateDecode(ticket.landingTime, true) + '</td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td colspan="3">Mã chuyến bay: ' + ticket.airline + ' ' + ticket.flightNumber + '</td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td colspan="3">Thời gian bay: ' + ticket.flightDuration.match(/PT(.*)/)[1].replace('D', ' ngày').replace('H', ' giờ ').replace('M', ' phút') + '</td>';
    html += '</tr>';
    html += '</tbody></table>';
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
        html += '<td><div class="radio radio-primary"><label><input type="radio" name="choose"></label></div></td>';
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
    return html;
}

function getSearchData(s) {
    var roundTrip = parseInt(getParameterByName('round-trip'));
    var fromPlace = getParameterByName('place-from').split(' - ');
    var toPlace = getParameterByName('place-to').split(' - ');
    var departDate = getParameterByName('date-depart').split('/');
    var returnDate = getParameterByName('date-return').split('/');
    var adult = parseInt(getParameterByName('adult'));
    var child = parseInt(getParameterByName('child'));
    var infant = parseInt(getParameterByName('infant'));
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
            if (parseInt(getParameterByName('round-trip')) == 1 && flightTables['return'] == null) {
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
        onComplete();
    };
    var onError = function() {
        onComplete();
    };
    $.each(_sources, function() {
        searchTickets(getSearchData([this]), onSuccess, onError);
    });
};

$(document).ready(function() {
    // Show/hide some element for trip
    $('input[name=round-trip]').click(function() {
        if ($(this).val() == 0) {
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
    $('#depart-table').on('click', 'td', function() {
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
    });
    $('#return-table').on('click', 'td', function() {
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
    });

    getList('panels?per-page=100', function(data) {
        if (data) {
            addPanel(data);
            isPanelsLoaded = true;
        }
    });

    getList('slides?per-page=100', function(data) {
        if (data) {
            addSlide(data);
            isSlidesLoaded = true;
        }
    });

    startSearch();

    resizeTable();
});

$(window).resize(function() {
    resizeTable();
});
