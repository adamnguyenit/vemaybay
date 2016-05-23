function isUsePlaces() {
    return false;
}

function isUseDatepicker() {
    return false;
}

function isUseClipboard() {
    return false;
}

function isUseWeather() {
    return false;
}

function isPageLoaded() {
    return isGetBookings;
}

var isGetBookings = false;
var table;
var bookings = {};
var tableOpt = {
    paging: false,
    autoWidth: true,
    aaSorting: [],
    columns: [{
        data: 'identity'
    }, {
        data: 'contact.name'
    }, {
        data: 'price',
        type: 'num-fmt',
        render: $.fn.dataTable.render.number('.', ',', 0),
        className: 'text-right color-red'
    }, {
        data: 'statusString'
    }, {
        data: 'createdAt'
    }],
    createdRow: function(row, data, index) {
        $(row).addClass('book');
        $(row).attr('data-identity', data.identity);
    }
};

$(document).ready(function() {
    getList('bookings/completed', function(data) {
        table = $('#table').DataTable(tableOpt);
        table.rows.add(data['items']).draw();
        isGetBookings = true;
        $.each(data['items'], function() {
            bookings[this.identity] = this;
        });
    });
    $('#table').on('click', 'tr.book td', function() {
        var identity = $(this).closest('tr').data('identity');
        var booking = bookings[identity];
        var html = '';
        html += '<h3>Chi tiết giá</h3>';
        html += '<div id="price-detail">';
        for (type in booking.priceDetail) {
            if (booking.ticketsDetail[type] && booking.ticketsDetail[type].ticket) {
                html += '<h4>' + booking.ticketsDetail[type].ticket.fromPlace + ' - ' + booking.ticketsDetail[type].ticket.toPlace + '</h4>';
                html += '<div class="table-responsive">';
                html += '<table class="table">';
                html += '<thead><tr><th>Mục</th><th class="text-right">Đơn giá</th><th class="text-right">Số lượng</th><th class="text-right">Tổng</th></tr></thead>';
                html += '<tbody>';
                for (priceType in booking.priceDetail[type]) {
                    for (passengerType in booking.priceDetail[type][priceType]) {
                        html += '<tr>';
                        html += '<td>' + booking.priceDetail[type][priceType][passengerType].description + '</td>';
                        html += '<td class="color-red text-right">' + parseInt(booking.priceDetail[type][priceType][passengerType].price).formatMoney(0, ',', '.') + '</td>';
                        html += '<td class="text-right">' + booking.priceDetail[type][priceType][passengerType].quantity + '</td>';
                        html += '<td class="color-red text-right">' + parseInt(booking.priceDetail[type][priceType][passengerType].total).formatMoney(0, ',', '.') + '</td>';
                        html += '</tr>';
                    }
                }
                html += '</tbody>';
                html += '</table>';
                html += '</div>';
            }
        }
        html += '</div>';
        html += '<h3>Liên hệ</h3>';
        html += '<div id="contact">';
        html += '<div class="contact-title">Họ và tên</div>';
        html += '<p>' + booking.contact.name + '</p>';
        html += '<div class="contact-title">Số ĐT</div>';
        html += '<p>' + booking.contact.phone + '</p>';
        html += '<div class="contact-title">Email</div>';
        html += '<p>' + booking.contact.email + '</p>';
        html += '</div>';
        html += '<h3>Hành trình</h3>';
        html += '<div id="flight-details">';
        for (type in booking.ticketsDetail) {
            if (booking.ticketsDetail[type].ticket.flightDetails) {
                html += '<h4>' + booking.ticketsDetail[type].ticket.fromPlace + ' - ' + booking.ticketsDetail[type].ticket.toPlace + '</h4>';
                html += '<p>Hạng ghế: ' + booking.selectedTicketOptions[type].ticketType + '</p>';
                html += '<p>Hãng: ' + booking.ticketsDetail[type].ticket.airline + '</p>';
                html += '<div class="table-responsive">';
                html += '<table class="table">';
                html += '<tbody>';
                $.each(booking.ticketsDetail[type].ticket.flightDetails, function() {
                    html += '<tr>';
                    html += '<td>' + this.from + '</td>';
                    html += '<td><i class="fa fa-fighter-jet"></i></td>';
                    html += '<td>' + this.to + '</td>';
                    html += '</tr>';
                    html += '<tr>';
                    html += '<td>' + dateDecode(this.departTime, true) + '</td>';
                    html += '<td>' + this.flightNumber + '</td>';
                    html += '<td>' + dateDecode(this.landingTime, true) + '</td>';
                    html += '</tr>';
                });
                html += '</tbody>';
                html += '</table>';
                html += '</div>';
            }
        }
        html += '</div>';
        html += '<div id="passengers">';
        html += '<h3>Hành khách</h3>';
        html += '<p>Người lớn: <span class="color-red">' + booking.people.adult + '</span>, trẻ em: <span class="color-red">' + booking.people.child + '</span>, em bé: <span class="color-red">' + booking.people.infant + '</span></p>';
        html += '<div class="table-responsive">';
        html += '<table class="table">';
        html += '<thead><tr><th></th><th>Họ và tên</th><th>Năm sinh</th><th>Địa chỉ</th><th>Tỉnh/Thành phố</th><th>Quốc gia</th></tr></thead>';
        html += '<tbody>';
        for (type in booking.passengersDetail) {
            $.each(booking.passengersDetail[type], function() {
                html += '<tr>';
                html += '<td>' + this.title + '</td>';
                html += '<td>' + this.name + '</td>';
                html += '<td>' + this.birth + '</td>';
                html += '<td>' + this.address + '</td>';
                html += '<td>' + this.city + '</td>';
                html += '<td>' + this.country + '</td>';
                html += '</tr>';
            });
        }
        html += '</tbody>';
        html += '</table>';
        html += '</div>';
        html += '<div id="payment">';
        html += '<h3>Thanh toán</h3>';
        if (booking.paymentDetail.method == 'at_store') {
            html += '<p class="color-blue">Thanh toán trực tiếp</p>'
        } else {
            html += '<p>Chuyển khoản ngân hàng: <span class="color-blue">' + booking.paymentDetail.bank + '</span></p>'
        }
        html += '</div>'
        $('#info-box').find('.modal-title').html('Giao dịch #' + identity);
        $('#info-box').find('.modal-body').html(html);
        $('#info-box').modal('toggle');
    });
});
