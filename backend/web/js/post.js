/**
 *
 */
$(document).ready(function () {
    $('.tab-content').find('.summernote').summernote({
        height: 150
    });
});


$('.edit-inline').click(function () {
    var post_id = $(this).data('post-id');
    $('#the-list tr').each(function () {
        if ($(this).hasClass('iedit')) {
            $(this).css('display', 'table-row');
        }

        if ($(this).hasClass('inline-edit-row')) {
            $(this).css('display', 'table-row').css('display', 'none');
        }

    });

    $('#post-' + post_id).css('display', 'none');
    $('#post-inline-' + post_id).css('display', 'table-row');

});

$('.cancel-edit-inline').click(function () {
    var post_id = $(this).data('post-id');

    $('#post-' + post_id).css('display', 'table-row');
    $('#post-inline-' + post_id).css('display', 'none');

});

$('.submit-edit-inline').click(function () {

    var post_id = $(this).data('post-id');

    $('#loader').css('display', 'block');

    var data = {
        id: post_id,
        title: $('#post-title-' + post_id).val(),
        category_id: $('#post-category-id-' + post_id).val(),
        avatar: $('#post-avatar-' + post_id).find('img').attr('src'),
        featured: $('#post-featured-' + post_id).is(":checked") ? 1 : 0,
        display_homepage: $('#post-display-homepage-' + post_id).is(":checked") ? 1 : 0,
        seo_title: $('#seo-title-' + post_id).val(),
        meta_keywords: $('#meta-keywords-' + post_id).val(),
        meta_description: $('#meta-description-' + post_id).val()
    };

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: base + 'ajax/update-post',
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
});


var show_images = function (event) {
    var loader = $('#loader');
    loader.css('display', 'block');

    var fd = new FormData();

    var auto = $(event.target).data('auto');

    var id = $(event.target).data('id');

    var column_parent_id = $(event.target).data('column-parent-id');

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
                        var children = $(event.target).closest('.inside').find('#list-img-temp');

                        children.children().children().find('img').attr('src', '/uploads/advertises/' + response[i]);
                        children.find('.caption').html(response[i]);
                        $(event.target).closest('.inside').find('#list-img').append(children.html());
                    }
                }

                loader.css('display', 'none');
            }
        });
    }

    loader.css('display', 'none');
};
var tab_size = $('#tab-older').find('li').length-1;
var tab_count = 0;
var tab = 0;
var add_tab = function () {
    tab_count++;
    tab = (tab_size>0)? tab_count+tab_size : tab_count;
    var menu_tab = $('.tab-menu');
    var tab_temp = $('.tab-temp');
    var tab_content = $('.tab-content');

    menu_tab.find('.new-tab').remove();
    tab_temp.find('.tab-pane').attr('id', 'tab-' + tab);
    menu_tab.find('.active').attr('class', '');
    menu_tab.append(' <li class="active"><a data-toggle="tab" id="tab-' + tab +'"  href="#tab-' + tab + '"> Tab ' + tab + ' &nbsp &nbsp &nbsp' + ' <i onclick="close_tab(event)"class="fa fa-remove"></i></a></li>');
    tab_content.find('.tab-pane').each(function () {
        $(this).attr('class', 'tab-pane');
    });
    tab_temp.find('#tab-' + tab).attr('class', 'tab-pane active');
    tab_temp.find('.ibox-content').append();
    menu_tab.append(' <li class="new-tab"><a style="cursor: pointer;" onclick="add_tab()"><i class="fa fa-plus-circle"></i> New tab</a></li>');
    tab_content.append(tab_temp.html());
    tab_content.find('.summernote').summernote({
        height: 150
    });
};


var close_tab = function (event) {
    var r = confirm('Bạn có chắc chắn muốn đóng tab này không? ');
    if (r === true) {
        var remove_tab = $(event.target).closest('a');
        var tab_id = remove_tab.attr('href');
        remove_tab.closest('li').remove();
        $('.tab-content').find(tab_id).remove();
        if ($('.tab-menu li').first().attr('class') !== 'new-tab') {
            $('.tab-menu').find('.active').attr('class', '');
            $('.tab-content').find('.tab-pane').each(function () {
                $(this).attr('class', 'tab-pane');
            });
            $('.tab-menu li').first().attr('class', 'active');
            $('.tab-content div').first().attr('class', 'tab-pane active');
        }


    }

};

var create_post_tab = function () {
    //getImages();
    var tabs = [];
    $('.tab-content').find('.tab-pane').each(function () {
        var title = $(this).find('.title-tab').val();
        if (title) {
            var content = $(this).find('.summernote').summernote('code');
            var id = $(this).find('.btn-danger').attr('id')?$(this).find('.btn-danger').attr('id') : null;
            var images = [];
            $(this).find('#list-img .file-preview-frame').each(function () {
                var img = {};
                var img_id = null;
                var url = $(this).find('.kv-file-content img').attr('src');
                img_id = $(this).find('.file-footer-caption .editable').attr('data-pk')?$(this).find('.file-footer-caption .editable').attr('data-pk'): null;
                img.id = img_id;
                img.url = url;
                images.push(img);

            });
            var tab = {};
            tab.id = id;
            tab.title = title;
            tab.content = content;
            tab.images = images;
            tabs.push(tab);

        }
    });
    $('#tab-post').val(JSON.stringify(tabs));
};
var delete_tab = function (event) {
    var id = $(event.target).attr('id');
    var tab_data = $(event.target).attr('data-id');
    var r = confirm('Bạn có chắc chắn muốn xóa tab này không? ');
    if(r=== true){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base + 'ajax/delete-tab',
            data: {
                id: id
            },
            error: function () {
            },
            success: function (response) {
                if (response) {
                    $.notify('Cập nhật thành công', "success");

                    location.reload();
                    $('.tab-menu').find("li a[href$='#"+tab_data+"']").remove();
                    $('.tab-content').find('.tab-pane #'+tab_data).remove();
                    if ($('.tab-menu li').first().attr('class') !== 'new-tab') {
                        $('.tab-menu').find('.active').attr('class', '');
                        $('.tab-content').find('.tab-pane').each(function () {
                            $(this).attr('class', 'tab-pane');
                        });
                        $('.tab-menu li').first().attr('class', 'active');
                        $('.tab-content div').first().attr('class', 'tab-pane active');
                    }
                }
                else {
                    $.notify('Đã có lỗi xảy ra', "error");
                }

                $('#loader').css('display', 'none');
            }
        });
    }

};

var search_post = function () {
    var  category = $('#post-category').val();
    var key = $('#key-word').val();
    var path = base + 'post/index?category=' + category + '&key=' + key;
    window.location.replace(path);
};
var task = function () {
    var check = $('#post-task').val();
    if(check!=''){
        var posts= [];
        $('input[name="post-check"]:checked').each(function () {
            var post={};
            var status= $(this).data('status');
            var id = $(this).data('id');
            if(check != status){
                post.id=id;
                post.status = check;
                posts.push(post);
            }
        });
        console.log(posts);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base + 'ajax/update-post-status',
            data: {
                posts: posts
            },
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
                console.log(response);
                $('#loader').css('display', 'none');
            }
        });
    }

};