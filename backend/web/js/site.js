/**
 * Created by vietv on 4/21/2018.
 */

var change_password = function () {

    var error = 0;

    error += check_required('password');
    error += check_required('new-password');
    error += check_required('re-password');

    if (error == 0) {
        $('#loader').css('display', 'block');

        var password_old = $('#password').val();
        var password = $('#new-password').val();
        var re_password = $('#re-password').val();

        var data = {};

        if (password_old)
            data.password_old = password_old;

        if (password) {
            data.password = password;
        }

        if (re_password) {
            data.re_password = re_password;
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base + 'ajax/change-password',
            data: data,
            error: function () {
            },
            success: function (response) {
                $('#loader').css('display', 'none');

                if (response == true) {
                    $('#compose-modal').modal('toggle');

                    $.notify("Cập nhật thành công", "success");

                    $.confirm({
                        title: 'Đổi mật khẩu thành công',
                        content: 'Hệ thống sẽ tự đông đăng xuất',
                        autoClose: 'logoutUser|5000',
                        buttons: {
                            logoutUser: {
                                text: 'Đăng xuất',
                                btnClass: 'btn-red',
                                action: function () {
                                    location.href = base + 'site/logout';
                                }
                            }
                        }
                    });
                }
                else {
                    $.notify(response, "error");
                }
            }
        });
    }
    else {
        $.notify('Vui lòng nhập đầy đủ thông tin', "error");
    }
};