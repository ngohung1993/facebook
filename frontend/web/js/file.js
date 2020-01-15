document.addEventListener("DOMContentLoaded", function () {
    generate_table();
});

let generate_table = function () {
    let loading = $('.loading-search');

    loading.css('display', 'block');

    $.ajax({
        type: 'GET',
        url: base + 'ajax/member?id=' + $('#file-id').val(),
        error: function () {
            loading.css('display', 'none');
        },
        success: function (response) {

            let rows = [];

            $.each(response, (i, item) => {
                rows[i] = [
                    '<input type="checkbox"/>',
                    item.uid,
                    '<img src="https://graph.facebook.com/' + item.uid + '/picture" class="img-circle"><a target="_blank" href="https://fb.com/' + item.uid + '"> ' + item.name + '</a>',
                ];
            });

            $('#table-result').DataTable({
                dom: 'Bfrtip',
                destroy: true,
                data: rows,
                columns: [{
                    title: "<input type='checkbox'/>",
                    width: "25px;"
                }, {
                    title: "UID"
                }, {
                    title: "Facebook"
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

            loading.css('display', 'none');
        }
    });
};

let add_member = function (event) {
    let members = $('#members');

    let data = [];

    let $btn = $(event.target);
    $btn.button('loading');

    members.find('.row').each(function () {
        data.push([$(this).find('.uid').val(), $(this).find('.name').val()]);
    });

    console.log(data);

    $.ajax({
        type: 'POST',
        url: base + 'ajax/add-member',
        data: {
            data: JSON.stringify(data),
            file_id: $('#file-id').val()
        },
        success: function () {
            $btn.button('reset');
            location.reload();
        }
    });
};