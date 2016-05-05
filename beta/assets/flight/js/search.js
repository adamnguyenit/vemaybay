function resizeTable() {
    var visible = false;
    if ($(window).width() > flightTablesHidedWidth) {
        visible = true;
    }
    $.each(flightTablesHidedColumn, function() {
        flightTables['depart'].column(this).visible(visible);
        flightTables['return'].column(this).visible(visible);
    });
    $('#depart-table').css('width', '100%');
    $('#return-table').css('width', '100%');
}
var flightTablesHidedColumn = [4];
var flightTablesHidedWidth = 480;
var flightTableOption = {
    paging: false,
    autoWidth: true,
    dom: 't',
    aaSorting: [],
    language: {
        sProcessing: "Đang xử lý...",
        sZeroRecords: "Không tìm thấy dữ liệu phù hợp"
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
        data: 'flightNumber'
    }, {
        data: 'priceFrom',
        type: 'num-fmt',
        render: $.fn.dataTable.render.number('.', ',', 0),
        className: 'text-right color-red'
    }, {
        data: 'seatAvailable',
        render: function(data, type, full, meta) {
            if (data > 0 && data <= 4) {
                return '<span class="label label-danger">Sắp hết</span>';
            }
            return '<span class="label label-primary">Còn nhiều</span>';
        }
    }]
};
var flightTables = {};

function startSearch() {
    if (flightTables['depart']) {
        flightTables['depart'].clear().draw();
    }
    if (flightTables['return']) {
        flightTables['return'].clear().draw();
    }
};

function childOfTicket() {
    var html = '<table class="ticket-detail"><tbody>';
    // Ticket detail
    html += '<tr>';
    html += '<td>Đà Nẵng</td>';
    html += '<td><span class="fa fa-fighter-jet"></span></td>';
    html += '<td>Hồ Chí Minh</td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td>05:50 08/05/2016</td>';
    html += '<td></td>';
    html += '<td>07:55 08/05/2016</td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td colspan="3">Mã chuyến bay: VietnamAirlines VN 224</td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td colspan="3">Thời gian bay: 2 giờ 5 phút</td>';
    html += '</tr>';
    html += '</tbody></table>';
    // Price detail
    html += '<table class="table" style="margin-bottom: 0">';
    html += '<thead><tr><th>Loại</th><th>Giá</th><th>Tổng</th><th></th></tr></thead>';
    html += '<tbody>';

    html += '<tr>';
    html += '<td>Super Deal</td>';
    html += '<td>299.000</td>';
    html += '<td class="color-red">568.000</td>';
    html += '<td><div class="radio radio-primary"><label><input type="radio" name="choose"></label></div></td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td colspan="4" style="border-top: 0">';
    html += '<table class="price-detail"><tbody>';
    html += '<tr><td>Giá vé người lớn x 2</td><td>299.000</td></tr>';
    html += '<tr><td>Thuế + phí người lớn x 2</td><td>369.000</td></tr>';
    html += '</tbody></table>';
    html += '</td>';
    html += '</tr>';

    html += '<tr>';
    html += '<td>Super Deal</td>';
    html += '<td>299.000</td>';
    html += '<td class="color-red">568.000</td>';
    html += '<td><div class="radio radio-primary"><label><input type="radio" name="choose"></label></div></td>';
    html += '</tr>';
    html += '<tr>';
    html += '<td colspan="4" style="border-top: 0">';
    html += '<table class="price-detail"><tbody>';
    html += '<tr><td>Giá vé người lớn x 2</td><td>299.000</td></tr>';
    html += '<tr><td>Thuế + phí người lớn x 2</td><td>369.000</td></tr>';
    html += '</tbody></table>';
    html += '</td>';
    html += '</tr>';

    html += '</tbody>';
    html += '</table>';
    return html;
}

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
    if (roundTrip) {
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
        flightTables[type].columns.adjust().draw();
        $('#' + type + '-table').css('width', '100%');
    });
    flightTables['depart'] = $('#depart-table').DataTable(flightTableOption);
    flightTables['return'] = $('#return-table').DataTable(flightTableOption);
    $('#depart-table').on('click', 'td', function() {
        var tr = $(this).closest('tr');
        var row = flightTables['depart'].row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(childOfTicket()).show();
            $.material.init();
            tr.addClass('shown');
        }
    });

    resizeTable();

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
    $.each(_sources, function() {
        searchTickets(getSearchData([this]), function(data) {
            if (data.hasOwnProperty('depart')) {
                flightTables['depart'].rows.add(data['depart']).draw();
                flightTables['depart'].columns.adjust().draw();
            }
            if (data.hasOwnProperty('return')) {
                flightTables['return'].rows.add(data['return']).draw();
                flightTables['return'].columns.adjust().draw();
            }
        });
    });
});

$(window).resize(function() {
    resizeTable();
});
