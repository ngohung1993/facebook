let go_to = $('#back-to-top');

let loading = function () {
    return '<img src="//i.imgur.com/63EDGlY.gif"/>'
};

let get_random_int = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

let add_zero = function (c) {
    return 10 > c && (c = '0' + c), c
};

let timeout_array = [];
timer = {
    count_down: function (c, a, f, q, g) {
        return -1 === f && (a--, f = 59), -1 === a && (c--, a = 59), -1 == c ? (clearTimeout(timeout), g(), !1) : ($('#' + q).text(add_zero(c) + ':' + add_zero(a) + ':' + add_zero(f)), void((timeout = setTimeout(function () {
            f--, timer.count_down(c, a, f, q, g)
        }, 1e3))))
    },
    count_down_array: function (c, a, f, q, g, j) {
        return -1 === f && (a--, f = 59), -1 === a && (c--, a = 59), -1 == c ? (clearTimeout(timeout_array[g]), j(), !1) : ($('#' + q).text(add_zero(c) + ':' + add_zero(a) + ':' + add_zero(f)), void((timeout_array[g] = setTimeout(function () {
            f--, timer.count_down_array(c, a, f, q, g, j)
        }, 1e3))))
    }
};

if (go_to.length) {
    let scrollTrigger = 100,
        backToTop = function () {
            let scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                go_to.css('display', 'block');
            } else {
                go_to.css('display', 'none');
            }
        };

    backToTop();

    $(window).on('scroll', function () {
        backToTop();
    });

    go_to.on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

let save_file = function () {
    let data = [];

    $('#table-result').find('tbody tr').each(function () {
        data.push([$(this).find('.uid').text(), $(this).find('.name').text()]);
    });

    $.ajax({
        type: 'POST',
        url: base + 'ajax/save-file',
        data: {
            data: JSON.stringify(data),
            title: $('#file-title').val(),
            group_id: $('#group-id').val(),
        },
        success: function (response) {
        }
    });
};

$('#export-excel').click(function () {
    let $btn = $(this);
    $btn.button('loading');

    let result = [];
    let value = [];
    let table_result = $('#table-result');

    table_result.find('th').each(function ($key) {
        if ($key !== 0) {
            value.push($(this).text());
        }
    });

    result.push(value);

    let data_table = table_result.DataTable();
    let data = data_table.rows().data();


    for (let i = 0; i < data.length; i++) {
        value = [];
        for (let j = 1; j < data[i].length; j++) {
            value.push($('<td>' + data[i][j] + '</td>').text());
        }
        console.log(value);
        result.push(value);
    }

    $.ajax({
        type: 'POST',
        url: base + 'ajax/export-excel',
        data: {
            data: JSON.stringify(result)
        },
        success: function (response) {
            window.location.href = response;
            $btn.button('reset');
        }
    });
});

let crud_group = function () {
    $.ajax({
        type: 'POST',
        url: base + 'ajax/create-group',
        data: {
            title: $('#crud-title').val()
        },
        success: function (response) {
            if (response) {
                location.reload();
            }
        }
    });
};

let create_group = function () {
    $.ajax({
        type: 'POST',
        url: base + 'ajax/create-group',
        data: {
            title: $('#group-title').val()
        },
        success: function (response) {
            if (response) {

                let group_id = $('#group-id');

                group_id.append('<option value="' + response['id'] + '">' + response['title'] + '</option>');

                group_id.val(response['id']);
            }
        }
    });
};

$('#open-create-group').click(function () {
    $('.step-1').css('display', 'none');
    $('.step-2').css('display', 'block');
});

$('#add-member').click(function () {
    let members = $('#members');
    members.append($('#member-temp').html());
});

function showErrorMessage(msg) {
    Messenger({
        extraClasses: 'messenger-fixed messenger-on-right messenger-on-top',
        theme: 'flat'
    }).post({
        message: msg,
        type: 'error',
        showCloseButton: true
    });
}

function showSuccess(msg) {
    Messenger({
        extraClasses: 'messenger-fixed messenger-on-right messenger-on-top',
        theme: 'flat'
    }).post(msg);
}