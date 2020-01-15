let shield_avatar = function () {

    let $btn = $(event.target);

    $btn.button('loading');

    $.ajax({
        type: 'POST',
        url: base + 'ajax/shield',
        data: {
            access_token: $('#access-token').val(),
            action: $('#action').val()
        },
        error: function () {
        },
        success: function (response) {

            showSuccess('Cập nhật thành công');

            $btn.button('reset');
        }
    });
};