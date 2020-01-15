document.addEventListener("DOMContentLoaded", function () {
    $('#table-result').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        destroy: true,
        columns: [{
            title: "<input type='checkbox'>",
            width: "40px"
        }, {
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Giới tính"
        }, {
            title: "Tuổi"
        }, {
            title: "Vị trí"
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

let identify_gender = function (gender) {
    return gender === 'male' ? 'Nam' : (gender === 'gender' ? 'Nữ' : 'Không xác định');
};

let scan_your_friend = function (event) {

    $(event.target).button('loading');

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.10/me/friends?fields=id,name,email,location,birthday,gender&limit=5000&access_token=' + $('#access-token').val(),
        error: function () {
            $(event.target).button('reset');
        },
        success: function (response) {

            let rows = [];

            $.each(response['data'], (i, item) => {
                rows[i] = [
                    '<input type="checkbox" value="' + item.id + '@@' + item.name + '">',
                    '<span class="uid">' + item.id + '</span>',
                    '<img src="https://graph.facebook.com/' + item.id + '/picture" class="img-circle"><a target="_blank" href="https://fb.com/' + item.id + '"> ' + '<span class="name">' + item.name + '</span></a>',
                    'gender' in item ? identify_gender(item.gender) : '',
                    'birthday' in item ? item.birthday : '',
                    'location' in item ? '' : ''
                ];
            });

            $('#table-result').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
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
                    title: "Giới tính"
                }, {
                    title: "Tuổi"
                }, {
                    title: "Vị trí"
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

            $(event.target).button('reset');
        }
    });
};

let un_friend = function (event) {
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
        send_un_friend(data, 0, length, $('#access-token').val(), $(event.target));
    }
    else {
        $(event.target).button('reset');
    }
};

function send_un_friend(selected, a, length, access_token, btn) {
    let ex = selected.split('|');
    let b = ex[a].split('@@');
    let c = b[0];
    let f = b[1] ? b[1] : 'UID ' + b[0];
    $('#' + c).html('<span style="color: blue;">Đang gửi</span>');
    $('#status').html('<span style="color: blue;">Đang gửi yêu cầu hủy kết bạn tới  <b>' + f + '</b></span> ' + loading());

    $.ajax({
        type: 'POST',
        url: 'https://graph.facebook.com/me/friends/' + c,
        data: {
            access_token: access_token,
            method: 'delete'
        },
        error: function () {
            $('#status').html('<span style="color: red;">Yêu cầu xóa bạn bè đến <b>' + f + '</b> thất bại, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
        },
        success: function () {
            $('#' + c).html('<span style="color: blue">Thành công</span>');
            $('#status').html('<span style="color: green">Yêu cầu xóa bạn bè đến <b>' + f + '</b> thành công, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
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
            send_un_friend(selected, a + 1, length, access_token, btn);
        });

        if (a === length - 1) {
            $('#status').html('<span style="color: red;">Đang đợi yêu cầu</span>');
            btn.button('reset');
        }
    });
}