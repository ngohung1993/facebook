/**
 * Created by vietv on 3/10/2018.
 */

$(function () {

    $('#tree-5aa383cc537d1').nestable([]);

    $('.tree_branch_delete').click(function () {
        var id = $(this).data('id');

        $.ajax({
            method: 'post',
            url: '/demo/categories/' + id,
            data: {
                _method: 'delete'
            },
            success: function () {
                $.pjax.reload('#pjax-container');
            }
        });
    });

    $('.tree-5aa383cc537d1-save').click(function () {
        var loader = $('#loader');
        loader.css('display', 'block');

        var serialize = $('#tree-5aa383cc537d1').nestable('serialize');
        console.log(JSON.stringify(serialize));
        $.ajax({
            url: base + 'ajax/serial',
            type: 'post',
            data: {
                serialize: JSON.stringify(serialize)
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

    });

    $('.tree-5aa383cc537d1-tree-tools').on('click', function (e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });

});

$('.edit-inline').click(function () {
    var category_id = $(this).data('category-id');

    $('#the-list tr').each(function () {
        if ($(this).hasClass('iedit')) {
            $(this).css('display', 'table-row');
        }

        if ($(this).hasClass('inline-edit-row')) {
            $(this).css('display', 'table-row').css('display', 'none');
        }

    });

    $('#category-' + category_id).css('display', 'none');
    $('#category-inline-' + category_id).css('display', 'table-row');

});

$('.cancel-edit-inline').click(function () {
    var category_id = $(this).data('category-id');

    $('#category-' + category_id).css('display', 'table-row');
    $('#category-inline-' + category_id).css('display', 'none');

});

$('.submit-edit-inline').click(function () {

    var category_id = $(this).data('category-id');

    $('#loader').css('display', 'block');

    var data = {
        id: category_id,
        title: $('#category-title-' + category_id).val(),
        parent_id: ($('#parent-id-' + category_id).val()!='0')?$('#parent-id-' + category_id).val():null,
        avatar: $('#category-avatar-' + category_id).find('img').attr('src'),
        featured: $('#category-featured-' + category_id).is(":checked") ? 1 : 0,
        display_homepage: $('#category-display-homepage-' + category_id).is(":checked") ? 1 : 0,
        seo_title: $('#seo-title-' + category_id).val(),
        meta_keywords: $('#meta-keywords-' + category_id).val(),
        meta_description: $('#meta-description-' + category_id).val()
    };
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: base + 'ajax/update-category',
        data: data,
        error: function () {
        },
        success: function (response) {
            console.log(response);
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