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