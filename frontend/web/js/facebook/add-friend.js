let total = 0;
let success = 0;
let error = 0;
let data = [];

let count_uid = function (event) {
    if (event.which === 13) {
        total++;

        if (total > 150) {
            $('#warning').css('display', 'block');
        }

        $('#total').text(total);
    }
};

let add_friend = function () {
    $(event.target).button('loading');

    let data = $('#list-uid').val().split('\n');
    let length = data.length;

    data = data.join('@@');

    if (length >= 1) {
        send_add_friend(data, 0, length, $('#access-token').val(), $(event.target));
    }
    else {
        $(event.target).button('reset');
    }
};

function send_add_friend(selected, a, length, access_token, btn) {
    let ex = selected.split('@@');
    let b = ex[a].split('|');
    let c = b[0];
    let f = b[1] ? b[1] : 'UID ' + b[0];
    $('#status').html('<span style="color: blue;">Đang gửi yêu cầu kết bạn tới  <b>' + f + '</b></span> ' + loading());

    $.ajax({
        type: 'GET',
        url: 'https://graph.facebook.com/v1.0/me/friends/' + c + '?method=POST&access_token=' + $('#access-token').val(),
        error: function () {
            ++error;
            $('#error').text(error);
            $('#status').html('<span style="color: red;">Yêu cầu kết bạn đến <b>' + f + '</b> thất bại, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
        },
        success: function () {
            ++success;
            $('#success').text(success);
            $('#status').html('<span style="color: green">Yêu cầu kết bạn đến <b>' + f + '</b> thành công, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ' + loading());
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
            send_add_friend(selected, a + 1, length, access_token, btn);
        });

        if (a === length - 1) {
            $('#status').html('<span style="color: red;">Đang đợi yêu cầu</span>');
            btn.button('reset');
        }
    });
}

let sender = function (i) {
    let b = data[i].split('|');
    let c = b[0];
    let f = b[1] ? b[1] : 'UID ' + b[0];

    let status = $('#status');
    status.css('display', 'block');
    status.html('<span style="color: red;">Gửi yêu cầu đến <b>' + data[i].split('|')[1] + '</b>, vui lòng đợi <b id="countdown">00:00:05</b> để tiếp tục</span> ');

    let j = 5;
    let countdown = setInterval(function () {
        $('#countdown').text('00:00:0' + j);
        j--;
        if (j < 0) {
            clearInterval(countdown);
            $.ajax({
                type: 'GET',
                url: 'https://graph.facebook.com/v1.0/me/friends/' + c + '?method=post&access_token=' + $('#access-token').val(),
                error: function () {
                    ++error;
                    $('#error').text(error);
                    status.html('<span style="color: red;">Gửi yêu cầu đến <b>' + f + '</b> thất bại, vui lòng đợi <b id="countdown"></b> để tiếp tục</span> ');
                    i++;
                    sender(i);
                },
                success: function () {
                    ++success;
                    $('#success').text(success);
                    status.html('<spam style="color: green;">Gửi yêu cầu đến <b>' + f + '</b> thành công, vui lòng đợi <b id="countdown"></b> để tiếp tục</spam>');
                }
            });
        }
    }, 1000);
};