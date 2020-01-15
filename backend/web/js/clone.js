/**
 * Created by vietv on 4/4/2018.
 */

var clone = function (url) {

    var category = null;
    var sub_website = null;
    var website = null;

    $.ajax({
        type: 'GET',
        url: base + 'ajax/get-sub-website?path=https://batdongsan.com.vn/ban-can-ho-chung-cu',
        crossDomain: true,
        error: function () {
        },
        success: function (response) {
            category = response['category_classified_id'];
            sub_website = response['id'];
            website = response['website_id'];

            $.ajax({
                type: 'GET',
                url: url,
                crossDomain: true,
                error: function () {
                },
                success: function (response) {
                    var html = $(response);

                    html.find('.Main .p-title a').each(function () {
                        var url_child = $(this).attr('href');

                        $.ajax({
                            type: 'GET',
                            url: 'https://batdongsan.com.vn' + url_child,
                            crossDomain: true,
                            error: function () {
                            },
                            success: function (response) {
                                var html = $(response);

                                var title = html.find('#product-detail h1').text().trim();
                                var email = html.find('#contactEmail script').text().trim();
                                var phone = html.find('#LeftMainContent__productDetail_contactPhone .right').text().trim();
                                phone += '||' + html.find('#LeftMainContent__productDetail_contactMobile .right').text().trim();

                                if (title) {
                                    $.ajax({
                                        type: 'POST',
                                        dataType: 'json',
                                        url: base + '/ajax/clone-classified',
                                        crossDomain: true,
                                        data: {
                                            path: 'https://batdongsan.com.vn' + url_child,
                                            title: title,
                                            website: website,
                                            sub_website: sub_website,
                                            category: category,
                                            email: email,
                                            phone: phone
                                        },
                                        error: function () {
                                        },
                                        success: function (response) {
                                            console.log(response);
                                        }
                                    });
                                }
                            }
                        });
                    });
                }
            });
        }
    });
};