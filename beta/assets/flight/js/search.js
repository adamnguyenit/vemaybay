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
var flightTablesHidedColumn = [0];
var flightTablesHidedWidth = 480;
var flightTableOption = {
    paging: false,
    autoWidth: true,
    dom: 't',
    aaSorting: [],
    language: {
        sProcessing: "Đang xử lý...",
        sZeroRecords: "Không tìm thấy dữ liệu phù hợp"
    }
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

function addPanel(panel) {
    $('#panel-box').append(panel);
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

    getList('panels', function(data) {
        if (data) {
          addPanel(data);
        }
    });
});

$(window).resize(function() {
    resizeTable();
});
