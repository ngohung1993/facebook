<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 3/9/2018
 * Time: 11:19 PM
 */

/** @var $facebook_accounts array */
/** @var $category \common\models\Category */

?>

<style>
    .table-responsive thead {
        background: #fff;
    }

    td {
        line-height: 3.5 !important;
        text-align: center;
    }

    table.dataTable tbody th, table.dataTable tbody td {
        padding: 5px 10px !important;
    }

    .img-circle {
        height: 40px;
        width: 40px;
    }

    .alert {
        padding: 10px 35px 10px 15px;
    }

    .panel-body {
        background: #fff;
    }

    .panel-heading {
        padding: 10px 15px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
        text-align: center;
    }

    .panel-title {
        text-transform: uppercase;
    }

    #result-msg {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
        display: none;
        font-size: 16px;
    }

    #result-msg img {
        width: 30px;
        height: 30px;
    }

</style>

<script src="<?= 'https://code.jquery.com/jquery-3.3.1.min.js' ?>"></script>

<div class="col-xs-12" style="background: #fff;padding-top: 15px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">
                Lọc danh sách bạn bè
            </h2>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Chọn Tài khoản</label>
                        <select title="" id="accessToken" class="form-control">
                            <?php foreach ($facebook_accounts as $key => $value): ?>
                                <option value="<?= $value['access_token'] ?>">
                                    <?= $value['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chọn Giới Tính</label>
                        <select name="" id="gender" class="form-control" required="required"
                                title="Giới Tính Bạn Bè Muốn Lọc">
                            <option value="all">Tất Cả</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                            <option value="500fr">Bạn Bè Dưới 500</option>
                            <option value="vn">Bạn Bè Là Người Nước Ngoài</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Số Lượng Post Của Bạn Để Quét Tương Tác</label>
                        <select name="" id="total_post" class="form-control" required="required"
                                title="Tổng số like và comment của bạn bè trong tổng bài viết">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="50">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group button-action">
                        <div class="get-list-friends" style="float: left;">
                            <button type="button" class="btn" style="background: #3b5999; color: #fff"
                                    onclick="getListFriend();">
                                <span class="fa fa-filter"></span>
                                Tiến hành lọc
                            </button>
                        </div>
                        <div class="action-list-friends" style="display: none">
                            <button type="button" class="btn btn-success" onclick="Show_0_Point();">
                                Hiển thị bạn bè không tương tác
                            </button>
                            <button type="button" class="btn btn-danger" onclick="Del_0_Point();">
                                Xóa Bạn không Tương Tác
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="showFriends(_Friends);">
                                Tải lại bạn bè
                            </button>
                        </div>
                    </div>
                </div>
                <div style="display: none; padding-top: 10px" class="col-md-12">
                    <div class="alert" id="result-msg">
                        Thành công. Chú ý càng ở bên dưới bảng càng tương tác kém.!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="panel-body">

    </div>
    <div class="panel-body" style="background: #fff;">
        <div class="table-responsive">
            <table class="table table-bordered" style="overflow-x: hidden;" id="table-friends">
            </table>
        </div>
    </div>
</div>
<script>
    let _Friends = new Array();
    let _Comments = new Array();
    let _Reactions = new Array();
    let _TOKEN = "";
    let getListFriend = function () {
        _TOKEN = $('#accessToken').val();
        if (!_TOKEN) {
            alert("Vui Lòng Nhập Mã Access Token Full Quyền!");
            return false;
        }
        _Friends.length = 0;
        $('#result-msg').closest(".col-md-12").css('display', 'block');
        $("#result-msg").html('<img src="http://th.facebook.com.vn/complete-admin/assets/images/throbber_13.gif" width="30" height="30" /> Đang Lấy Thông Tin. Vui Lòng Đợi...').fadeIn("slow");
        let gender = $("#gender").val();
        if (gender == 'male') {
            var a = 'AND sex != \'female\'';
            var a = 'SELECT friend_count, uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND sex != "female" ORDER BY rand() LIMIT 5000';

        } else if (gender == "female") {
            var a = 'SELECT friend_count, uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND sex != "male" ORDER BY rand() LIMIT 5000';
        } else if (gender == 'die') {
            var a = 'SELECT id, name FROM profile WHERE id IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND name = "Facebook User" ORDER BY rand() LIMIT 5000';
        } else if (gender == '500fr') {
            var a = 'SELECT friend_count, uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND friend_count < 500 ORDER BY rand() LIMIT 5000';
        } else if (gender == 'vn') {
            var a = 'SELECT locale, uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND locale != "vi_VN" ORDER BY rand() LIMIT 5000';
        } else if (gender == 'vn') {
            var a = 'SELECT locale, uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) AND locale != "vi_VN" ORDER BY rand() LIMIT 5000';
        } else {
            var a = 'SELECT uid, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) ORDER BY rand() LIMIT 5000';

        }
        $.ajax({
            url: "https://graph.facebook.com/fql",
            type: "GET",
            dataType: "JSON",
            data: {
                access_token: _TOKEN,
                q: a
            },
            success: (data) => {
                if (typeof data.error != "undefined") {
                    $("#result-msg").html(data.error.message).fadeIn("slow");
                } else {
                    _Friends = data.data;
                    getStatus();
                }
            }
        })
    };

    function showFriends(Data) {
        console.clear();
        $('.action-list-friends').css('display', 'block');
        let arrFriends = new Array();
        $.each(Data, (i, item) => {
            arrFriends[i] = [
                (i + 1),
                '<center><img src="https://graph.facebook.com/' + item.uid + '/picture" class="img-circle"></center>',
                '<img src=""><a target="_blank" href="https://fb.com/' + item.uid + '"> ' + item.name + '</a>',
                item.uid,
                item.reaction,
                item.comment,
                (item.comment + item.reaction) * 500,
                '<span id="row_' + item.uid + '"></span>'
            ];
        });
        $('#table-friends').DataTable({
            dom: 'Bfrtip',
            destroy: true,
            data: arrFriends,
            columns: [{
                title: "STT"
            }, {
                title: "Avatar"
            }, {
                title: "Tài khoản Facebook"
            }, {
                title: "FB UID"
            }, {
                title: "Tương tác"
            }, {
                title: "Bình luận"
            }, {
                title: "Điểm"
            }, {
                title: "Thao tác"
            },],
            "order": [
                [5, "DESC"], [6, "DESC"], [7, "DESC"],
            ],
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
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[3]);
            },

        });
    }

    let getStatus = function () {
        let limit = $('#total_post').val();
        $.ajax({
            url: "https://graph.facebook.com/me/feed",
            type: "GET",
            dataType: "JSON",
            timeout: "300000",
            data: {
                limit: limit,
                access_token: _TOKEN,
                fields: "id"
            },
            success: (data) => {
                getComments(data.data);
                getReactions(data.data);
                setTimeout((e) => {
                    Ranking();
                }, 10000);

            }
        })
    };
    let getComments = function (Status) {
        let limit = 5000;
        for (let i = 0; i < Status.length; i++) {
            $.ajax({
                url: "https://graph.facebook.com/" + Status[i].id + "/",
                type: "GET",
                dataType: "JSON",
                data: {
                    access_token: _TOKEN,
                    fields: "comments.limit(" + limit + ").summary(true)"
                },
                success: (data) => {
                    if (data.comments.data) {
                        getComments2(data.comments.data);
                    }

                }
            })
        }
    };

    function getComments2(Comments) {
        let limit = 5000;
        for (let i = 0; i < Comments.length; i++) {
            _Comments.push(parseInt(Comments[i].from.id));
            $.ajax({
                url: "https://graph.facebook.com/" + Comments[i].id + "/",
                type: "GET",
                dataType: "JSON",
                data: {
                    access_token: _TOKEN,
                    fields: "comments.limit(" + limit + ").summary(true)"
                },
                success: (data) => {
                    if (data.comments) {
                        exPortComments(data.comments.data);
                    }
                }
            })
        }
    }

    function exPortComments(Comments) {
        for (let i = 0; i < Comments.length; i++) {
            _Comments.push(parseInt(Comments[i].from.id));
        }
    }

    //end comments
    function getReactions(Status) {
        let limit = 10000;
        for (let i = 0; i < Status.length; i++) {
            $.ajax({
                url: "https://graph.facebook.com/" + Status[i].id + "/",
                type: "GET",
                dataType: "JSON",
                data: {
                    access_token: _TOKEN,
                    fields: "reactions.limit(" + limit + ").summary(true)"
                },
                success: (data) => {
                    if (data.reactions.data) {
                        exPortReactions(data.reactions.data)
                    }
                }
            })
        }
    }

    function exPortReactions(Reactions) {
        for (let i = 0; i < Reactions.length; i++) {
            _Reactions.push(parseInt(Reactions[i].id));
        }
    }

    function Ranking() {
        $("#result-msg").empty().html('<img src="http://th.facebook.com.vn/complete-admin/assets/images/throbber_13.gif" width="30" height="30" /> Đang Tính Toán Thứ Hạng ...');
        for (let i = 0; i < _Friends.length; i++) {
            _Friends[i].reaction = countItems(_Reactions, _Friends[i].uid);
            _Friends[i].comment = countItems(_Comments, _Friends[i].uid);
        }
        $("#ds-friends").fadeIn("slow");
        setTimeout((e) => {
            $("#result-msg").empty().html('Thành Công. Chú ý càng ở bên dưới bảng càng tương tác kém.!');
            show();
        }, 5000)
    }

    function countItems(arr, what) {
        let count = 0,
            i;
        while ((i = arr.indexOf(what, i)) != -1) {
            ++count;
            ++i;
        }
        return count;
    }

    function show() {
        //console.clear();
        showFriends(_Friends);

    }

    function Show_0_Point() {
        let arrFriends0Point = new Array();
        let count = 0;
        $.each(_Friends, (i, item) => {
            if ((item.reaction + item.comment) !== 0) {
                $('#' + item.uid).remove();
            } else {
                arrFriends0Point[count] = [
                    (count + 1),
                    '<center><img src="https://graph.facebook.com/' + item.uid + '/picture" class="img-circle"></center>',
                    '<img src=""><a target="_blank" href="https://fb.com/' + item.uid + '"> ' + item.name + '</a>',
                    item.uid,
                    item.reaction,
                    item.comment,
                    (item.comment + item.reaction) * 500,
                    '<span id="row_' + item.uid + '"></span>'
                ];
                count++;
            }

        });
        showFriends0point(arrFriends0Point);
    }

    function showFriends0point(arrFriends0Point) {
        $('#table-friends').DataTable().clear();
        $('#table-friends').DataTable().rows.add(arrFriends0Point).draw();
    }

    let _Friends_0_Point = new Array();

    function Del_0_Point() {
        let k = 0;

        $.each(_Friends, (i, item) => {
            if ((item.reaction + item.comment) === 0) {
                _Friends.splice(i, 1);
                _Friends_0_Point[k] = [
                    (k + 1),
                    '<center><img src="https://graph.facebook.com/' + item.uid + '/picture" class="img-circle"></center>',
                    '<img src=""><a target="_blank" href="https://fb.com/' + item.uid + '"> ' + item.name + '</a>',
                    item.uid,
                    item.reaction,
                    item.comment,
                    (item.comment + item.reaction) * 500,
                    '<span id="row_' + item.uid + '"></span>'
                ];
                k++;
                removeFriend(i, item);
            }
        });

    }

    function removeFriend(i, USER) {
        !function (i, USER) {
            setTimeout(function () {
                $.ajax({
                    url: 'https://graph.facebook.com/me/friends/' + USER.uid,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        access_token: _TOKEN,
                        method: "delete",
                    }
                }).done(function () {
                    $("#row_" + USER.uid).html('thành công');
                    $("#row_" + USER.uid).attr('style', 'color: blue;');
                    $("#result-msg").empty().html(' Đã Xóa: <img src="https://graph.facebook.com/' + USER.uid + '/picture?width=30&height=30" /> ' + USER.name + '(' + USER.uid + ')');
                }).fail(function () {
                    $("#row_" + USER.uid).html('Thành công');
                    $("#row_" + USER.uid).attr('style', 'color: blue;');
                    $("#result-msg").empty().html(' Đã Xóa: <img src="https://graph.facebook.com/' + USER.uid + '/picture?width=30&height=30" /> ' + USER.name + '(' + USER.uid + ')');
                });
            }, i * 2000)
        }(i, USER);
    }
</script>