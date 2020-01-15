document.addEventListener("DOMContentLoaded", function () {
    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        columns: [{
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Cảm xúc",
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
            '<span class="uid">' + item.id + '</span>',
            '<img src="https://graph.facebook.com/' + item.id + '/picture" class="img-circle"><a target="_blank" href="https://fb.com/' + item.id + '"> ' + '<span class="name">' + item.name + '</span></a>',
            '<img class="emotion" src="/uploads/core/images/' + item.type.toLowerCase() + '.gif">'
        ]
    });

    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        data: rows,
        columns: [{
            title: "UID"
        }, {
            title: "Facebook"
        }, {
            title: "Cảm xúc",
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

let scan_emotion_of_post = function () {
    let loading = $('.loading-search');

    loading.css('display', 'block');

    let e = $('#id-post').val();

    if (!valid_url(e)) {
        $.ajax({
            type: 'GET',
            url: 'https://graph.facebook.com/' + e + '/reactions?method=GET&limit=5000&fields=id,name,type&access_token=' + $('#access-token').val(),
            error: function () {
                loading.css('display', 'none');
            },
            success: function (response) {

                generate_table(response.data);

                loading.css('display', 'none');
                body.css('display', 'block');
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
                    },
                    success: function (response) {

                        $.ajax({
                            type: 'GET',
                            url: 'https://graph.facebook.com/' + response['id'] + '/reactions?method=GET&limit=5000&fields=id,name,type&access_token=' + $('#access-token').val(),
                            error: function () {
                                loading.css('display', 'none');
                            },
                            success: function (response) {

                                generate_table(response.data);

                                loading.css('display', 'none');
                            }
                        });
                    }
                });
            }
        });
    }
};