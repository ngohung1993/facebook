document.addEventListener("DOMContentLoaded", function () {
    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        columns: [{
            title: "<input type='checkbox'>",
            width: "40px"
        }, {
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Trạng thái",
            width: "100px"
        }],
        "pageLength": 100,
        "columnDefs": [{
            "targets": 0,
            "searchable": false
        }],
        "language": {
            "search": "Tìm kiếm",
            "paginate": {
                "first": "Về Đầu",
                "last": "Về Cuối",
                "next": "Trang sau",
                "previous": "Trang trước"
            },
            "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
            "lengthMenu": "Hiển thị _MENU_ mục",
            "loadingRecords": "Đang tải...",
            "emptyTable": "Không có gì để hiển thị"
        }
    });
});

let generate_table = function (data) {
    let rows = [];
    $.each(data, (i, item) => {
        rows[i] = [
            '<input type="checkbox" value="' + item.from.id + '@@' + item.from.name + '">',
            '<span class="uid">' + item.from.id + '</span>',
            '<img src="https://graph.facebook.com/' + item.from.id + '/picture" class="img-circle"><a target="_blank" href="https://fb.com/' + item.from.id + '"> ' + '<span class="name">' + item.from.name + '</span></a>',
            '<span id=' + item.from.id + '>Đang chờ</span>'
        ]
    });

    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        data: rows,
        columns: [{
            title: "<input type='checkbox'>",
            width: "40px"
        }, {
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Trạng thái",
            width: "100px"
        }],
        "columnDefs": [{
            "targets": 0,
            "searchable": false
        }],
        "language": {
            "search": "Tìm Kiếm",
            "paginate": {
                "first": "Về Đầu",
                "last": "Về Cuối",
                "next": "Tiến",
                "previous": "Lùi"
            },
            "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
            "lengthMenu": "Hiển thị _MENU_ mục",
            "loadingRecords": "Đang tải...",
            "emptyTable": "Không có gì để hiển thị"
        },
        "fnCreatedRow": function (nRow, aData) {
            $(nRow).attr('id', aData[3]);
        },
    });
};

let scan_friend_request = function (event) {

    $(event.target).button('loading');

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v1.0/me/friendrequests?method=get&limit=1000&access_token=' + $('#access-token').val(),
        error: function () {
            $(event.target).button('reset');
        },
        success: function (response) {
            generate_table(response.data);
            $(event.target).button('reset');
        }
    });
};

let un_accept_friend = function (event) {
    $(event.target).button('loading');

    let data = [];
    let length = 0;

    $('#table-result input:checked').each(function () {
        data.push($(this).val());
        $(this).remove();
        length++;
    });

    data = data.join('|');

    if (length >= 1) {
        send_un_accept_request(data, 0, length, $('#access-token').val(), $(event.target));
    }
};

let accept_friend = function (event) {
    $(event.target).button('loading');

    let data = [];
    let length = 0;

    $('#table-result input:checked').each(function () {
        data.push($(this).val());
        $(this).remove();
        length++;
    });

    data = data.join('|');

    if (length >= 1) {
        send_accept_request(data, 0, length, $('#access-token').val(), $(event.target));
    }
};

let send_un_accept_request = function (selected, a, length, access_token, btn) {
    let ex = selected.split('|');
    let b = ex[a].split('@@');
    let c = b[0];
    let f = b[1] ? b[1] : 'UID ' + b[0];

    $('#' + c).html('<span style="color: blue;">Đang xóa</span>');
    $('#status').html('<span style="color: blue;">Đang xóa yêu cầu kết bạn từ  <b>' + f + '</b></span> ' + loading());

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com/me/friends/' + c,
        data: {
            access_token: access_token,
            method: 'delete'
        },
        error: function () {
            $('#status').html('<span style="color: red;">Xóa yêu cầu kết bạn từ <b>' + f + '</b> thất bại, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
        },
        success: function () {
            $('#' + c).html('<span style="color: blue">Thành công</span>');
            $('#status').html('<span style="color: green">Xóa yêu cầu kết bạn từ <b>' + f + '</b> thành công, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
        }
    }).always(function () {

        let number_get = 0;
        if (a % 35 === 0 && a !== 0) {
            number_get = 600;
        }
        else {
            number_get = get_random_int(15, 20);
        }

        a + 1 < length && timer.count_down(0, Math.floor(number_get / 60), number_get - 60 * Math.floor(number_get / 60), 'countdown', function () {
            send_un_accept_request(selected, a + 1, length, access_token, btn);
        });

        if (a === length - 1) {
            $('#status').html('<span style="color: red;">Đang đợi yêu cầu</span>');
            btn.button('reset');
        }
    });
};

let send_accept_request = function (selected, a, length, access_token, btn) {
    let ex = selected.split('|');
    let b = ex[a].split('@@');
    let c = b[0];
    let f = b[1] ? b[1] : 'UID ' + b[0];

    $('#' + c).html('<span style="color: blue;">Đang gửi</span>');
    $('#status').html('<span style="color: blue;">Đang gửi yêu cầu  kết bạn tới  <b>' + f + '</b></span> ' + loading());

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v1.0/me/friends/' + c + '?method=post&access_token=' + access_token,
        error: function () {
            $('#status').html('<span style="color: red;">Chấp nhận yêu cầu đến <b>' + f + '</b> thất bại, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
        },
        success: function () {
            $('#' + c).html('<span style="color: blue">Thành công</span>');
            $('#status').html('<span style="color: green">Chấp nhận yêu cầu đến <b>' + f + '</b> thành công, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
        }
    }).always(function () {

        let number_get = 0;
        if (a % 35 === 0 && a !== 0) {
            number_get = 600;
        }
        else {
            number_get = get_random_int(15, 20);
        }

        a + 1 < length && timer.count_down(0, Math.floor(number_get / 60), number_get - 60 * Math.floor(number_get / 60), 'countdown', function () {
            send_accept_request(selected, a + 1, length, access_token, btn);
        });

        if (a === length - 1) {
            $('#status').html('<span style="color: red;">Đang đợi yêu cầu</span>');
            btn.button('reset');
        }
    });
};