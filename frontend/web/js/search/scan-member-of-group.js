document.addEventListener("DOMContentLoaded", function () {
    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        columns: [{
            title: "TT"
        }, {
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Giới tính"
        }, {
            title: "Tuổi"
        }, {
            title: "Quê quán"
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

let valid_url = function (str) {
    let regular_expression = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    return regular_expression.test(str);
};

let identify_gender = function (gender) {
    return gender === 'male' ? 'Nam' : (gender === 'gender' ? 'Nữ' : 'Không xác định');
};

let generate_table = function (data) {
    let rows = [];
    $.each(data, (i, item) => {
        rows[i] = [
            (i + 1),
            item.id,
            '<a target="_blank" href="https://fb.com/' + item.id + '">' + '<img src="https://graph.facebook.com/' + item.id + '/picture" class="img-circle">' + item.name + '</a>',
            'gender' in item ? identify_gender(item.gender) : '',
            'birthday' in item ? item.birthday : '',
            'location' in item ? '' : ''
        ]
    });

    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        data: rows,
        columns: [{
            title: "TT",
            width: "10px"
        }, {
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Giới tính"
        }, {
            title: "Tuổi"
        }, {
            title: "Quê quán"
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
                "next": "Trang trước",
                "previous": "Trang sau"
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

let scan_member_of_group = function (event) {

    let $btn = $(event.target);

    $btn.button('loading');

    let e = $('#id-group').val();

    if (!valid_url(e)) {
        $.ajax({
            type: 'GET',
            url: 'https://graph.facebook.com/' + e + '/members?method=GET&limit=500&fields=name,gender,id,birthday,location&access_token=' + $('#access-token').val(),
            error: function () {
                $btn.button('reset');
                showErrorMessage('Đã có lỗi xảy ra');
            },
            success: function (response) {
                generate_table(response.data);
                $btn.button('reset');
            }
        });
    }
    else {
        let t = "", o = e.match(/[^](fbid=[0-9]{9})\d+/);
        if (null !== o) t = (o[0].replace("?fbid=", "")).replace("_fbid=", ""); else {
            let n = e.match(/[^\/|.!=][0-9]{7,}(?!.*[0-9]{7,})\d+/);
            null !== n && (t = n[0]);
        }

        $.ajax({
            type: 'POST',
            url: 'https://findmyfbid.com',
            data: {
                url: e
            },
            error: function () {
                $btn.button('reset');
                showErrorMessage('Đã có lỗi xảy ra');
            },
            success: function (response) {

                $.ajax({
                    type: 'POST',
                    url: server + '/facebook-tool/check-uid',
                    data: {
                        uid: response['id'],
                        post_id: t
                    },
                    error: function () {
                        $btn.button('reset');
                        showErrorMessage('Đã có lỗi xảy ra');
                    },
                    success: function (response) {
                        $.ajax({
                            type: 'GET',
                            url: 'https://graph.facebook.com/' + response['id'] + '/members?method=GET&limit=500&fields=name,gender,id,birthday,location&access_token=' + $('#access-token').val(),
                            error: function () {
                                $btn.button('reset');
                                showErrorMessage('Đã có lỗi xảy ra');
                            },
                            success: function (response) {
                                generate_table(response.data);
                                $btn.button('reset');
                            }
                        });
                    }
                });
            }
        });
    }
};