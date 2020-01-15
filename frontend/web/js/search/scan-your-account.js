let valid_url = function (str) {
    let regular_expression = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
    return regular_expression.test(str);
};

let identify_gender = function (gender) {
    return gender === 'male' ? 'Nam' : (gender === 'gender' ? 'Nữ' : 'Không xác định');
};

let scan_your_post = function () {
    let loading = $('.loading-search');

    loading.css('display', 'block');

    let your_post = $('#your-post');

    your_post.html('');

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.0/me/posts?fields=privacy,shares,likes,comments,story,from,created_time,updated_time,link,full_picture,message&locale=vi_VN&limit=100&access_token=' + $('#access-token').val(),
        error: function () {
        },
        success: function (response) {

            let data = response['data'];

            for (let i = 0; i < data.length; i++) {
                let temp = $('#social-feed-temp');

                temp.find('.copy-uid').attr('data-uid', data[i]['id']);

                temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['from']['id'] + '/picture?type=large');

                temp.find('.name').text(data[i]['story']);

                temp.find('.created-time').text(data[i]['created_time']);

                if (('updated_time' in data[i]) && data[i]['updated_time'] !== data[i]['created_time']) {
                    temp.find('.updated-time').text(data[i]['updated_time']);
                }
                else {
                    temp.find('.updated-time').text('Bài viết chưa được chỉnh sửa');
                }

                if ('privacy' in data[i]) {
                    if (data[i]['privacy']['value'] === 'EVERYONE') {
                        temp.find('.everyone').css('display', 'block');
                        temp.find('.self').css('display', 'none');
                        temp.find('.all-friends').css('display', 'none');
                    }
                    else if ((data[i]['privacy']['value'] === 'ALL_FRIENDS') || (data[i]['privacy']['value'] === 'CUSTOM')) {
                        temp.find('.all-friends').css('display', 'block');
                        temp.find('.self').css('display', 'none');
                        temp.find('.everyone').css('display', 'none');
                    }
                    else {
                        temp.find('.self').css('display', 'block');
                        temp.find('.everyone').css('display', 'none');
                        temp.find('.all-friends').css('display', 'none');
                    }
                }
                else {
                    temp.find('.self').css('display', 'none');
                    temp.find('.everyone').css('display', 'none');
                    temp.find('.all-friends').css('display', 'none');
                }

                temp.find('.scan-emotion').attr('href', base + 'search/index?act=scan-emotion-of-post&search=' + data[i]['id'] + '&facebook=' + $("select#access-token option:checked").attr('data-facebook'));

                temp.find('.like').text(('likes' in data[i]) ? data[i]['likes']['count'] : 0);
                temp.find('.comment').text(('comments' in data[i]) ? data[i]['comments']['count'] : 0);
                temp.find('.share').text(('shares' in data[i]) ? data[i]['shares']['count'] : 0);

                temp.find('.content').html('');

                if ('description' in data[i]) {
                    temp.find('.content').append('<p>' + data[i]['description'] + '</p>');
                }

                if (('message' in data[i])) {
                    if (valid_url(data[i]['message'])) {
                        temp.find('.content').append('<p><a href="' + data[i]['message'] + '">' + data[i]['message'] + '</a></p>');
                    }
                    else {
                        temp.find('.content').append('<p>' + data[i]['message'] + '</p>');
                    }
                }

                if (('full_picture' in data[i])) {
                    temp.find('.content').append('<img src="' + data[i]['full_picture'] + '"/>');
                }

                your_post.append(temp.html());
            }

            loading.css('display', 'none');
        }
    });
};

let scan_your_friend = function () {
    let loading = $('.loading-search');

    loading.css('display', 'block');

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.10/me/friends?fields=id,name,email,location,birthday,gender&limit=5000&access_token=' + $('#access-token').val(),
        error: function () {
            loading.css('display', 'none');
        },
        success: function (response) {

            let rows = [];

            $.each(response['data'], (i, item) => {
                rows[i] = [
                    item.id,
                    '<img src="https://graph.facebook.com/' + item.id + '/picture" class="img-circle"><a target="_blank" href="https://fb.com/' + item.id + '"> ' + item.name + '</a>',
                    'gender' in item ? identify_gender(item.gender) : '',
                    'birthday' in item ? item.birthday : '',
                    'location' in item ? '' : ''
                ];
            });

            $('#table-your-friend').DataTable({
                dom: 'Bfrtip',
                destroy: true,
                data: rows,
                columns: [{
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

            loading.css('display', 'none');
        }
    });
};

let scan_your_group = function () {
    let loading = $('.loading-search');

    loading.css('display', 'block');

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.0/me/groups?fields=member_count,icon,name&limit=5000&access_token=' + $('#access-token').val(),
        error: function () {
            loading.css('display', 'none');
        },
        success: function (response) {

            let rows = [];

            $.each(response['data'], (i, item) => {
                rows[i] = [
                    item.id,
                    '<img src="' + item.icon + '" class="icon"><a target="_blank" href="https://fb.com/' + item.id + '" > ' + item.name + '</a>',
                    item['member_count'],
                    '<a target="_blank" class="btn btn-danger btn-sm" href="' + base + 'search/index?act=scan-member-of-group&search=' + item.id + '&facebook=' + $("select#access-token option:checked").attr('data-facebook') + '"><i class="fa fa-external-link"></i>Quét UID</a>'
                ];
            });

            $('#table-your-group').DataTable({
                dom: 'Bfrtip',
                destroy: true,
                data: rows,
                columns: [{
                    title: "UID"
                }, {
                    title: "Facebook"
                }, {
                    title: "Thành viên",
                    width: "100px"
                }, {
                    title: "Thao tác",
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

            loading.css('display', 'none');
        }
    });
};