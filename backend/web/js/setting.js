/**
 * Created by vietv on 3/8/2018.
 */

$(function () {
    var content = $('#content');
    var describe = $('#describe');


    if (content.length !== 0) {
        initSample();
    }


    if (describe.length !== 0) {
        initDescribe();
    }

    var iCheck = $('input[type="checkbox"].minimal, input[type="radio"].minimal');

    iCheck.iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    iCheck.on('ifChanged', function () {
        if (this.checked) {
            $(this).closest('tr').css('background-color', '#ffffd5');
        } else {
            $(this).closest('tr').css('background-color', '');
        }
    });

    var myCheckbox = $("[name='switch-checkbox']");

    myCheckbox.bootstrapSwitch();

    myCheckbox.on('switchChange.bootstrapSwitch', function () {
        $('#loader').css('display', 'block');

        $.ajax({
            url: base + $(this).data('api'),
            type: 'post',
            data: {
                id: $(this).data('id'),
                table: $(this).data('table'),
                api: $(this).data('api'),
                column: $(this).data('column')
            },
            success: function (response) {
                $('#loader').css('display', 'none');

                if (response) {
                    $.notify('Cập nhật thành công', 'success');
                }
                else {
                    $.notify('Đã có lỗi xảy ra', 'error');
                }
            }
        });

    });

    $('.editable').editable();

});

$('.kv-file-drop-zone-one-image').change(function () {
    var loader = $('#loader');
    loader.css('display', 'block');

    var btn_upload = $(this);

    var fd = new FormData();

    var files = event.target.files;

    for (var i = 0; i < files.length; i++) {
        fd.append('files[]', files[i]);
    }

    if (files) {
        $.ajax({
            url: '/uploads/core/upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.length !== 0) {
                    for (i = 0; i < response.length; i++) {
                        var children = $('#list-img-temp');

                        children.children().children().find('img').attr('src', '/uploads/advertises/' + response[i]);
                        children.find('.caption').html(response[i]);

                        btn_upload.closest('.box-upload-image').find('.thumbnails').append(children.html());

                        btn_upload.parent().css('display', 'none');
                    }
                }

                loader.css('display', 'none');
            }
        });
    }

    loader.css('display', 'none');
});


$('.kv-file-drop-zone').change(function () {
    var loader = $('#loader');
    loader.css('display', 'block');

    var fd = new FormData();

    var auto = $(this).data('auto');

    var id = $(this).data('id');

    var column_parent_id = $(this).data('column-parent-id');

    var files = event.target.files;

    for (var i = 0; i < files.length; i++) {
        fd.append('files[]', files[i]);
    }

    if (files) {
        $.ajax({
            url: '/uploads/core/upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.length !== 0) {
                    if (auto === 1) {
                        $.ajax({
                            url: base + 'ajax/upload-image',
                            type: 'post',
                            data: {
                                images: JSON.stringify(response),
                                id: id,
                                column_parent_id: column_parent_id
                            },
                            success: function (response) {
                                loader.css('display', 'none');

                                if (response) {
                                    $.notify('Cập nhật thành công', 'success');
                                }
                                else {
                                    $.notify('Đã có lỗi xảy ra', 'error');
                                }

                            }
                        });
                    }

                    for (i = 0; i < response.length; i++) {
                        var children = $('#list-img-temp');

                        children.children().children().find('img').attr('src', '/uploads/advertises/' + response[i]);
                        children.find('.caption').html(response[i]);
                        $('#list-img').append(children.html());
                    }
                }

                loader.css('display', 'none');
            }
        });
    }

    loader.css('display', 'none');

});

var deleteFileOne = function (event) {
    var loader = $('#loader');

    loader.css('display', 'block');

    var btn_upload = $(event.target).closest('.box-upload-image').find('.spanButtonPlaceholder');

    var url = $(event.target).closest(".file-preview-frame").find('img').attr('src');

    var r = confirm('Bạn có chắc chắn muốn xóa ' + url);

    if (r === true) {

        $.ajax({
            url: '/uploads/core/delete.php',
            type: 'post',
            data: {path: url},
            success: function () {

                $(event.target).closest(".file-preview-frame").remove();

                btn_upload.css('display', 'block');

                loader.css('display', 'none');
            }
        });
    }
    else {
        loader.css('display', 'none');
    }
};

var deleteFile = function (event) {
    var loader = $('#loader');

    loader.css('display', 'block');

    var auto = 0;
    var id = 0;
    if ($(event.target).is('i')) {
        auto = $(event.target).parent().data('auto');
        id = $(event.target).parent().data('id');
    }
    else {
        auto = $(event.target).data('auto');
        id = $(event.target).data('id');
    }
    var url = $(event.target).closest(".file-preview-frame").find('img').attr('src');

    var r = confirm('Bạn có chắc chắn muốn xóa ' + url);

    if (r === true) {
        $.ajax({
            url: '/uploads/core/delete.php',
            type: 'post',
            data: {path: url},
            success: function () {
                $(event.target).closest(".file-preview-frame").remove();

                if (auto) {
                    $.ajax({
                        url: '/uploads/core/delete.php',
                        type: 'post',
                        data: {id: id},
                        success: function () {
                            $(event.target).closest(".file-preview-frame").remove();

                            if (auto) {
                                $.ajax({
                                    url: base + 'ajax/delete-image',
                                    type: 'post',
                                    data: {id: id},
                                    success: function (response) {
                                        if (response) {
                                            $.notify('Cập nhật thành công', 'success');
                                        }
                                        else {
                                            $.notify('Đã có lỗi xảy ra', 'error');
                                        }

                                        loader.css('display', 'none');
                                    }
                                });

                                loader.css('display', 'none');
                            }
                        }
                    });
                }

                loader.css('display', 'none');
            }
        });
    }
    else {
        loader.css('display', 'none');
    }
};

var getImages = function () {
    var images = [];

    $('#list-img').find('.kv-file-content img').each(function () {

        var url = $(this).attr('src');

        images.push(url);

    });

    $('#images').val(JSON.stringify(images));

};

var save_content_image = function () {
    var id = $('#id-image').val();
    var link = $('#link').val();
    var describe = $('#describe-temp').val();
    var content = CKEDITOR.instances['describe'].getData();

    var loader = $('#loader');
    loader.css('display', 'block');

    $.ajax({
        url: base + 'ajax/edit-content-image',
        type: 'post',
        data: {
            id: id,
            content: content,
            link: link,
            describe: describe
        },
        success: function (response) {
            if (response) {
                $.notify('Cập nhật thành công', 'success');
            }
            else {
                $.notify('Đã xảy ra lỗi', 'error');
            }

            loader.css('display', 'none');
        }
    });

};

var load_content_image = function (id) {
    $('#id-image').val(id);

    var loader = $('#loader');
    loader.css('display', 'block');

    $.ajax({
        url: base + 'ajax/get-content-image',
        type: 'post',
        data: {
            id: id
        },
        success: function (response) {

            $('#link').val(response['link']);
            $('#describe-temp').val(response['describe']);
            CKEDITOR.instances['describe'].setData(response['content']);

            loader.css('display', 'none');
        }
    });
};

var check_required = function (id) {

    var tag = $('#' + id);

    if (tag.val() === '' || tag.val() === '0') {
        tag.css('border', '1px solid #da3535');
        return 1;
    }
    else {
        tag.css('border', '1px solid #ccc');
        return 0;
    }

};

$(document).ready(function () {
    $("[data-toggle=popover]").popover({
        html: true,
        content: function () {
            return $('#popover-content-' + $(this).data('id')).html();
        }
    });
});

var frame = $('.frame-btn');

frame.fancybox({
    'width': 900,
    'height': 600,
    'type': 'iframe',
    'autoScale': false
});

function OnMessage(e) {
    var event = e.originalEvent;
    if (event.data.sender === 'responsivefilemanager') {
        if (event.data.field_id) {
            var fieldID = event.data.field_id;
            var url = event.data.url;

            $('#' + fieldID).val(url).trigger('change');
            $.fancybox.close();
            $(window).off('message', OnMessage);
        }
    }
}

function responsive_filemanager_callback(field_id) {

    var image = jQuery('#' + field_id);
    var thumbnail = jQuery('.' + field_id);

    var url = image.val();
    image.val('/uploads/source/' + url);

    $('.thumbnail-' + field_id).css('display', 'none');
    $('.remove-thumbnail-' + field_id).css('display', 'block');

    thumbnail.attr('src', '/uploads/source/' + url);
    thumbnail.css('display', 'block');
}

var remove_thumbnail = function (field_id) {
    $('.thumbnail-' + field_id).css('display', 'block');
    $('.remove-thumbnail-' + field_id).css('display', 'none');

    var image = jQuery('#' + field_id);
    var thumbnail = jQuery('.' + field_id);

    image.val('');
    thumbnail.css('display', 'none');
};