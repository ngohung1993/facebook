
let gender_vn = function (gender) {
    return gender === 'male' ? 'Nam' : (gender === 'gender' ? 'Nữ' : 'Không xác định');
};

let generate_table = function (data) {
    let rows = [];
    $.each(data, (i, item) => {
        rows[i] = [
            (i + 1),
            '<img src="https://graph.facebook.com/' + item.id + '/picture" class="img-circle">',
            '<a target="_blank" href="https://fb.com/' + item.id + '"> ' + item.name + '</a>',
            'gender' in item ? gender_vn(item.gender) : '',
            'birthday' in item ? item.birthday : '',
            'location' in item ? '' : '',
            ''
        ];
    });

    $('#table-result').DataTable({
        dom: 'Bfrtip',
        destroy: true,
        data: rows,
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
            title: "Vị trí"
        }, {
            title: "Thao tác"
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

let get_uid_group = function () {
    loader_search.css('display', 'block');
    let table_temp = $('#table-uid-temp tbody');
    let table_group = $('#table-uid-group tbody');
    let table_content = $('#uid-group');
    table_group.html('');
    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v2.0/me/groups?fields=member_count,icon,name&limit=100&access_token=' + $('#access-token').val(),
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];
            for (let i = 0; i < data.length; i++) {
                table_temp.find('.serial').text(i + 1);
                table_temp.find('.icon').attr('src', data[i]['icon']);
                table_temp.find('.external-link').text(data[i]['name']);
                table_temp.find('.external-link').attr('href', 'https://www.fb.com/' + data[i]['id']);
                table_temp.find('.uid').text(data[i]['id']);
                table_temp.find('.uid').attr('href', 'http://tool-facebook.com/site/get-uid-group?uid=' + data[i]['id']);
                table_temp.find('.member-count').text(data[i]['member_count']);
                table_group.append(table_temp.html());
            }
            loader_search.css('display', 'none');
            table_content.css('display', 'block');
        }
    });
};

let get_members_of_group = function () {

    let uid = $('#uid-group').val();

    loader_search.css('display', 'block');

    $.ajax({
        type: 'GET',
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];

            generate_table(data);

            loader_search.css('display', 'none');
        }
    });
};


let get_comment_post = function () {
    let uid = $('#uid-group').val();
    let list_comment_temp = $('#list-comment-temp tbody');
    let list_comment = $('#list-comment tbody');
    let table_result = $('#example-1_wrapper');
    loader_search.css('display', 'block');
    list_comment.html('');
    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/' + uid + '/comments?method=get&limit=300&fields=from,id,message,name,picture&method=get&access_token=' + access_token,
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];
            for (let i = 0; i < data.length; i++) {
                list_comment_temp.find('.uid').text(data[i]['from']['id']);
                list_comment_temp.find('.uid').attr('href', 'https://www.fb.com/' + data[i]['from']['id']);
                list_comment_temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['from']['id'] + '/picture?type=small');
                list_comment_temp.find('.name').text(data[i]['from']['name']);
                list_comment_temp.find('.message').text(('message' in data[i]) ? data[i]['message'] : '');

                list_comment.append(list_comment_temp.html());
            }
            loader_search.css('display', 'none');
            table_result.css('display', 'block');
        }
    });
};


let get_uid_share = function () {
    let uid = $('#uid-group').val();
    let list_uid_share_temp = $('#list-uid-share-temp tbody');
    let list_uid_share = $('#list-uid-share tbody');
    let table_result = $('#example-1_wrapper');
    loader_search.css('display', 'block');
    list_uid_share.html('');
    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/' + uid + '/sharedposts?limit=500&fields=from,id&method=get&access_token=' + access_token,
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];
            for (let i = 0; i < data.length; i++) {
                list_uid_share_temp.find('.uid').text(data[i]['from']['id']);
                list_uid_share_temp.find('.uid').attr('href', 'https://www.fb.com/' + data[i]['from']['id']);
                list_uid_share_temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['from']['id'] + '/picture?type=small');
                list_uid_share_temp.find('.name').text(data[i]['from']['name']);

                list_uid_share.append(list_uid_share_temp.html());
            }
            loader_search.css('display', 'none');
            table_result.css('display', 'block');
        }
    });
};


let get_uid_subscribers = function () {
    let uid = $('#uid-group').val();
    let list_uid_subscribers_temp = $('#list-uid-subscribers-temp tbody');
    let list_uid_subscribers = $('#list-uid-subscribers tbody');
    let table_result = $('#example-1_wrapper');
    loader_search.css('display', 'block');
    list_uid_subscribers.html('');
    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/' + uid + '/subscribers?limit=300&fields=id,name,email,location,birthday,gender&method=get&access_token=' + access_token,
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];
            for (let i = 0; i < data.length; i++) {
                list_uid_subscribers_temp.find('.uid').text(data[i]['id']);
                list_uid_subscribers_temp.find('.uid').attr('href', 'https://www.fb.com/' + data[i]['id']);
                list_uid_subscribers_temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['id'] + '/picture?type=small');
                list_uid_subscribers_temp.find('.email').text(('email' in data[i]) ? data[i]['email'] : 'Không xác định');
                list_uid_subscribers_temp.find('.name').text(data[i]['name']);
                list_uid_subscribers_temp.find('.gender').text(('gender' in data[i]) ? data[i]['gender'] : 'Không xác định');
                list_uid_subscribers_temp.find('.age').text(('birthday' in data[i]) ? data[i]['birthday'] : 'Không xác định');
                list_uid_subscribers_temp.find('.country').text(('location' in data[i]) ? data[i]['location']['name'] : 'Không xác định');

                list_uid_subscribers.append(list_uid_subscribers_temp.html());
            }
            loader_search.css('display', 'none');
            table_result.css('display', 'block');
        }
    });
};

let get_uid_reactions = function () {
    let uid = $('#uid-group').val();
    let list_uid_reactions_temp = $('#list-uid-reactions-temp tbody');
    let list_uid_reactions = $('#list-uid-reactions tbody');
    let table_result = $('#example-1_wrapper');
    loader_search.css('display', 'block');
    list_uid_reactions.html('');
    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/' + uid + '/reactions?limit=500&fields=id,name,email,location,birthday,type,gender&method=get&access_token=' + access_token,
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];
            for (let i = 0; i < data.length; i++) {
                list_uid_reactions_temp.find('.uid').text(data[i]['id']);
                list_uid_reactions_temp.find('.uid').attr('href', 'https://www.fb.com/' + data[i]['id']);
                list_uid_reactions_temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['id'] + '/picture?type=small');
                list_uid_reactions_temp.find('.name').text(data[i]['name']);
                list_uid_reactions_temp.find('.reactions').text(data[i]['type']);

                list_uid_reactions.append(list_uid_reactions_temp.html());
            }
            loader_search.css('display', 'none');
            table_result.css('display', 'block');
        }
    });
};


let get_uid_friends = function () {
    let uid = $('#uid-group').val();
    let list_uid_friends_temp = $('#list-uid-reactions-temp tbody');
    let list_uid_friends = $('#list-uid-reactions tbody');
    let table_result = $('#example-1_wrapper');
    loader_search.css('display', 'block');
    list_uid_friends.html('');
    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/' + uid + '/friends?limit=300&fields=id,name,email,location,birthday,gender&method=get&access_token=' + access_token,
        error: function () {
            loader_search.css('display', 'none');
        },
        success: function (response) {
            let data = response['data'];
            for (let i = 0; i < data.length; i++) {
                list_uid_friends_temp.find('.uid').text(data[i]['id']);
                list_uid_friends_temp.find('.uid').attr('href', 'https://www.fb.com/' + data[i]['id']);
                list_uid_friends_temp.find('.avatar').attr('src', 'https://graph.facebook.com/' + data[i]['id'] + '/picture?type=small');
                list_uid_friends_temp.find('.email').text(('email' in data[i]) ? data[i]['email'] : 'Không xác định');
                list_uid_friends_temp.find('.name').text(data[i]['name']);
                list_uid_friends_temp.find('.gender').text(('gender' in data[i]) ? data[i]['gender'] : 'Không xác định');
                list_uid_friends_temp.find('.age').text(('birthday' in data[i]) ? data[i]['birthday'] : 'Không xác định');
                list_uid_friends_temp.find('.country').text(('location' in data[i]) ? data[i]['location']['name'] : 'Không xác định');

                list_uid_friends.append(list_uid_friends_temp.html());
            }
            loader_search.css('display', 'none');
            table_result.css('display', 'block');
        }
    });
};