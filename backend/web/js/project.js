/**
 * Created by vietv on 4/21/2018.
 */

var crud_project = function () {

    var error = 0;

    error += check_required('crud-title');
    error += check_required('crud-describe');
    error += check_required('crud-leader');
    error += check_required('crud-customer-id');
    error += check_required('crud-duration');

    if (!error) {
        $('#loader').css('display', 'block');

        var data = {
            project_id: $('#project-id').val(),
            title: $('#crud-title').val(),
            describe: $('#crud-describe').val(),
            content: CKEDITOR.instances['crud-content'].getData(),
            leader: $('#crud-leader').val(),
            customer_id: $('#crud-customer-id').val(),
            duration: $('#crud-duration').val(),
            point: $('#crud-point').val(),
            price: $('#crud-price').val(),
            domain: $('#crud-domain').val(),
            website_code: $('#crud-website-code').val()
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base + 'ajax/crud-project',
            data: data,
            error: function () {
            },
            success: function (response) {
                if (response) {
                    $.notify('Cập nhật thành công', "success");

                    location.reload();
                }
                else {
                    $.notify('Đã có lỗi xảy ra', "error");
                }

                $('#loader').css('display', 'none');
            }
        });
    }
    else {
        $.notify('Vui lòng nhập đầy đủ thông tin', "warn");
    }

};

var setting_project = function () {
    var error = 0;

    error += check_required('crud-folder');
    error += check_required('crud-webmaster-account');
    error += check_required('crud-webmaster-password');
    error += check_required('crud-db-account');
    error += check_required('crud-db-password');

    if (!error) {
        $('#loader').css('display', 'block');

        var data = {
            project_id: $('#project-id').val(),
            folder: $('#crud-folder').val(),
            webmaster_account: $('#crud-webmaster-account').val(),
            webmaster_password: $('#crud-webmaster-password').val(),
            db_account: $('#crud-db-account').val(),
            db_password: $('#crud-db-password').val()
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base + 'ajax/setting-project',
            data: data,
            error: function () {
            },
            success: function (response) {
                if (response) {
                    $.notify('Cập nhật thành công', "success");

                    location.reload();
                }
                else {
                    $.notify('Đã có lỗi xảy ra', "error");
                }

                $('#loader').css('display', 'none');
            }
        });
    }
    else {
        $.notify('Vui lòng nhập đầy đủ thông tin', "warn");
    }
};

var load_project_crud = function (id) {
    $('#loader').css('display', 'block');

    $('#project-id').val(id);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: base + 'ajax/load-project',
        data: {
            project_id: id
        },
        error: function () {
        },
        success: function (response) {
            if (response) {
                $('#crud-title').val(response['title']);
                $('#crud-describe').val(response['describe']);
                CKEDITOR.instances['crud-content'].setData(response['content']);
                $('#crud-leader').val(response['leader']);
                $('#crud-customer-id').val(response['customer_id']);

                var date = new Date(response['duration']);

                $('#crud-duration').val(date.getFullYear() + '-' + ((date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1)) + '-' + (date.getDate() < 10 ? '0' + date.getDate() : date.getDate()));
                $('#crud-point').val(response['point']);
                $('#crud-price').val(response['price']);
                $('#crud-domain').val(response['domain']);
                $('#crud-website-code').val(response['website_code']);
            }

            $('#loader').css('display', 'none');
        }
    });
};

var load_project_view = function (id) {
    $('#loader').css('display', 'block');

    $('#project-id').val(id);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: base + 'ajax/load-project',
        data: {
            project_id: id
        },
        error: function () {
        },
        success: function (response) {
            if (response) {
                $('#title-view').text(response['title']);
                $('#describe-view').text(response['describe']);
                $('#customer-id-view').text(response['customer']['full_name']);
                $('#leader-view').text(response['leader0']['first_name'] + ' ' + response['leader0']['last_name']);
                $('#price-view').text('**********');
                $('#point-view').text(response['point']);

                var date = new Date(response['duration']);

                $('#duration-view').text(date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear());
                $('#domain-view').text(response['domain']);
                $('#website-code-view').text(response['website_code']);
                $('#content-view').html(response['content']);
                $('#folder-view').text(response['folder']);
                $('#webmaster-account-view').text(response['webmaster_account']);
                $('#webmaster-password-view').text(response['webmaster_password']);
                $('#db-account-view').text(response['db_account']);
                $('#db-password-view').text(response['db_password']);
            }

            $('#loader').css('display', 'none');
        }
    });
};

$('.send-project').click(function () {

    var project_id = $(this).data('project-id');

    console.log(project_id);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: base + 'ajax/send-project',
        data: {
            project_id: project_id
        },
        error: function () {
        },
        success: function (response) {
            if (response) {
                $.notify('Gửi thông tin dự án thành công', "success");
            }

            $('#loader').css('display', 'none');
        }
    });
});