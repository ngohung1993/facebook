/**
 * Created by vietv on 3/13/2018.
 */

var iCheck = $('input[type="checkbox"].check-image');

iCheck.on('ifChecked', function () {
    if (!$(this).hasClass('none-action')) {
        $(this).parents().eq(3).css('background-color', 'rgb(255, 255, 213)');
    }
});

iCheck.on('ifUnchecked', function () {
    if (!$(this).hasClass('none-action')) {
        $(this).parents().eq(3).css('background-color', '');
    }
});