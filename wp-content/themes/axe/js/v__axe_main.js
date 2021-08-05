$(document).ready(function () {
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }

    const rangeSlider = document.getElementById('range-slider');

    if (rangeSlider) {

        let slider_price = $('.filter-price__slider').attr('data-price').split(';');
        let get_params_price = $('.filter-price__slider').attr('data-get_params_price').split(';');

        noUiSlider.create(rangeSlider, {
            start: [Number.parseInt(get_params_price[0]), Number.parseInt(get_params_price[1])],
            connect: true,
            step: 1,
            range: {
                'min': Number.parseInt(slider_price[0]),
                'max': Number.parseInt(slider_price[1])
            }
        });
        rangeSlider.noUiSlider.on('change', filter_params);

        const input0 = document.getElementById('input-0');
        const input1 = document.getElementById('input-1');
        const inputs = [input0, input1];

        rangeSlider.noUiSlider.on('update', function (values, handle) {
            inputs[handle].value = Math.round(values[handle]);
        });

        const setRangeSlider = (i, value) => {
            let arr = [null, null];
            arr[i] = value;

            rangeSlider.noUiSlider.set(arr);
        };

        inputs.forEach((el, index) => {
            el.addEventListener('change', (e) => {
                setRangeSlider(index, e.currentTarget.value);
            });
        });
    }


    $('.js_change_select_filter').change(filter_params)
    $('.js_change_select_filter_order').click(filter_params)
    function filter_params(event){
        let filter_params = new Map();
        $('.check__block input:checked').each(function () {
            let params = $(this).closest('.input-box').find('.checkbox__label').attr('data-filter-params').split('=');
            if (filter_params.has(params[0])) {
                filter_params.set(params[0], filter_params.get(params[0]) + ';' + params[1])
            } else {
                filter_params.set(params[0], params[1]);
            }
        });
        filter_params.set('price', Number.parseInt($('.noUi-origin').find('[data-handle="0"]').attr('aria-valuenow')) + ';' + Number.parseInt($('.noUi-origin').find('[data-handle="1"]').attr('aria-valuenow')));
        let orderby = $('.select__current').text().trim();
        if($(this).attr('data-orderby')){
            filter_params.set('orderby', $(this).attr('data-orderby'));
            $('.select__current').attr('data-orderby',  $(this).attr('data-orderby'))
        } else{
            filter_params.set('orderby', $('.select__current').attr('data-orderby'));
        }

        // filter_params.forEach((value, key, map) => {
        //     console.log(`${key}: ${value}`); // огурец: 500 и так далее
        // });

        let data = new FormData();
        data.append('action', 'ajax_filter_product');
        // data.append('id_menu', $(this).attr('data-change_active'));

        data.append('taxonomy', $('.products__inner').attr('data-js-taxonomy'));
        data.append('slug', $('.products__inner').attr('data-js-slug'));
        if(filter_params.has('functional'))
            data.append('functional', filter_params.get('functional'));
        if(filter_params.has('style'))
            data.append('style', filter_params.get('style'));
        if(filter_params.has('price'))
            data.append('price', filter_params.get('price'));
        if(filter_params.has('purpose'))
            data.append('purpose', filter_params.get('purpose'));
        if(filter_params.has('orderby'))
            data.append('orderby', filter_params.get('orderby'));


        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                let $html = $(data.html);
                $html.find('.js_click_like').click(like_controll)
                $html.find('.js_show_prew_order').click(show_prew_order)
                $html.find('.js_add_product_to_cart').click(add_product_to_cart)
                $('.products__inner').html($html)
                $('.count-colum').find('.red').text(data.count);
                window.history.pushState("get param", "Title", location.protocol + '//' + location.host + location.pathname + data.url);
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    }

    $('.js_get_success_form_info').click(function (event) {
        event.preventDefault();
        $('.js_paste_url_image').attr('src', $('.color-active').find('.js_get_image_url').attr('src'));
        $('.js_paste_price_product').text($('.js_get_price_product').text());
    })

    $('.js_get_product_variation').click(function () {
        if($(this).hasClass('color-active'))
            return;
        let product_id = $(this).closest('.card__item__color__img-block').attr('data-product-index');
        let variation_colour = $(this).attr('data-colour_product');
        $(this).closest('.card__item__color__img-block').find('.card__item__color__img').removeClass('color-active');
        $(this).addClass('color-active');
        let data = new FormData();
        data.append('action', 'ajax_variation_product');
        // data.append('id_menu', $(this).attr('data-change_active'));
        data.append('product_id', product_id);
        data.append('variation_colour', variation_colour);


        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                // console.log('saving = ' + data.saving);
                let $html = $(data.html);
                $('.card__item__price-block').html($html)
                let saving = data.saving;
                if(saving)
                    $('.card__item__discount-text').text('Вы экономите ' + data.saving + ' р.')
                else
                    $('.card__item__discount-text').text( '')
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
            }
        })
    })
    $('#tab__video').click(function (event) {
        // console.log('add_video');
        let link_video = $('.tab__vido-block').attr('data-link-video').split('v=')[1]
        let index_end = link_video.indexOf('&');
        // console.log('link = ' + link_video);
        // console.log('index_end = ' + index_end);
        let frame = '<iframe width="710" height="400" src="https://www.youtube.com/embed/'+ (index_end !== -1 ? link_video.substring(0, index_end) : link_video) + '"\n' +
            '                                        frameborder="0"\n' +
            '                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"\n' +
            '                                        allowfullscreen></iframe>'
        $('.tab__vido-block').html(frame);
    })
    let id_file_input = 1;
    $('.js_open_input').click(function(event){
        input_field = '<input id="file-input-'+ id_file_input +'" type="file" id="profile_pic" name="profile_pic"\n' +
            '                                           accept=".jpg, .jpeg, .png">';

        $('.input_select_photo').append(input_field);
        $('#file-input-'+id_file_input).change(select_file).trigger('click');

        id_file_input++;
    })
    function select_file(){
        var file = this.files.item(0).name;
        let append_file = '<p class="photo__name-in text-in">\n' +
            ''+ file +'\n' +
            '<span class="photo__name-close" data-id-delete="file-input-'+ (id_file_input-1) +'"></span>\n' +
            '</p>'
        let file_id = 'file-input-'+ (id_file_input-1) +'';
        $('.selected_file').append(append_file);

        $('[data-id-delete=' + file_id + ']').click(close_file);
    }
    function close_file(){
        let input_field = $(this).attr('data-id-delete');
        document.getElementById(input_field).remove();
        $(this).closest('.photo__name-in').remove();
    }

    $('.js_click_app_label').click(function(event){
        $(this).closest('.js_get_appraisal').attr('data-appraisal', $(this).attr('data-appr'));
    })

    $('.js_send_review').click(function (event) {
        event.preventDefault();
        let this_click = $(this);
        grecaptcha.ready(function () {
            grecaptcha.execute($('.js_get_reCAPTCHA_site_key').attr('data-reCAPTCHA_site_key'), {action: 'submit'}).then(function (token) {
                // Add your logic to submit to your backend server here.


                let count_files = 0;

                let get_form_info = this_click.closest('.js_get_form_info');
                let name = get_form_info.find('.js_get_name').val();
                if (name.length < 2) {
                    get_form_info.find('.js_get_name').addClass('error');
                    return;
                }
                get_form_info.find('.js_get_name').removeClass('error');
                let stars = get_form_info.find('.js_get_appraisal').attr('data-appraisal');
                let text_review = get_form_info.find('.js_get_text_message').val();
                if (text_review.length < 2) {
                    get_form_info.find('.js_get_text_message').addClass('error');
                    return;
                }
                get_form_info.find('.js_get_text_message').removeClass('error');
                let title_product = get_form_info.attr('data-title-product');
                let id_product = get_form_info.attr('data-id-product');

                let data = new FormData();
                data.append('action', 'ajax_review_product');


                let $items = $('.input_select_photo').children();

                $items.each
                (
                    function (index) {
                        try {
                            // let element = this.files.item(0).name;
                            data.append('file_' + count_files, this.files[0]);
                            count_files++;
                        } catch (e) {
                            console.log('error')
                        }
                    }
                );

                data.append('count_files', count_files);
                data.append('name', name);
                data.append('stars', stars);
                data.append('text_review', text_review);
                data.append('title_product', title_product);
                data.append('id_product', id_product);

                // console.log('count_files = ' + count_files);
                // for (let value of data.values()) {
                //     console.log(value);
                // }

                $.ajax({
                    url: window.ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (data) {
                        // console.log('data' + data);
                        // console.log('data = ' + data.html);
                        if (data.result === 'ok') {
                            id_file_input = 1;
                            get_form_info.find('.js_get_name').val('');
                            get_form_info.find('.js_get_text_message').val('');
                            $('.rating-area input:checked').each(function () {
                                this.checked = false;
                            });
                            $('.input_select_photo').html('');
                            $('.selected_file').html('');
                            $.fancybox.open({
                                src: '#fncbx-success-send_review',
                                type: 'inline'
                            })
                        }
                    },
                    error: function (jqXHR, status, errorThrown) {
                        console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                        $.fancybox.open({
                            src: '#fncbx-error-send_review',
                            type: 'inline'
                        })
                    }
                })
            });
        });
    })

    function openPopup(id) {
        $(".js-popup[data-id-popup='" + id + "']").fadeIn(300);
    }

    function close_popup() {
        $('.js-popup').fadeOut(300);
    }

    $('.js_send_contact_mess').click(function (event) {
        event.preventDefault();
        let this_info = $(this);
        grecaptcha.ready(function () {
            grecaptcha.execute($('.js_get_reCAPTCHA_site_key').attr('data-reCAPTCHA_site_key'), {action: 'submit'}).then(function (token) {
                // Add your logic to submit to your backend server here.

                let get, name, phone, mail, mess;
                let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

                get = this_info.closest('.js_get_form_info');
                name = get.find('.js_get_name').val();
                if (name.length < 2) {
                    get.find('.js_get_name').addClass('error');
                    return;
                }
                get.find('.js_get_name').removeClass('error');
                mail = get.find('.js_get_mail').val();

                if (!re.test(String(mail).toLowerCase())) {
                    get.find('.js_get_mail').addClass('error');
                    return;
                }
                get.find('.js_get_mail').removeClass('error');
                phone = get.find('.js_get_phone').val().replace(/\D/g, '');
                if (phone.length < 11) {
                    get.find('.js_get_phone').addClass('error');
                    return;
                }
                get.find('.js_get_phone').removeClass('error');

                mess = get.find('.js_get_mess').val();
                if (mess.length < 2) {
                    get.find('.js_get_mess').addClass('error');
                    return;
                }
                get.find('.js_get_mess').removeClass('error');

                let data = new FormData();
                data.append('action', 'ajax_send_mess');
                data.append('name', name);
                data.append('phone', phone);
                data.append('mail', mail);
                data.append('mess', mess);

                // for (let value of data.values()) {
                //     console.log(value);
                // }

                $.ajax({
                    url: window.ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (data) {
                        // console.log('data' + data);
                        // console.log('data = ' + data.html);
                        if (data.result === 'success send') {
                            $('.js_clear').val('');
                            $.fancybox.open({
                                src: '#fncbx-success-contact-send',
                                type: 'inline'
                            })
                        }
                    },
                    error: function (jqXHR, status, errorThrown) {
                        console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                        $.fancybox.open({
                            src: '#fncbx-error-ajax',
                            type: 'inline'
                        })
                    }
                })
            });
        });
    })

    $('.js_click_like').click(like_controll)

    function like_controll(event) {
        event.preventDefault()
        add_loader();
        let this_product = $(this);

        let id_product = $(this).attr('data-id_product');

        let data = new FormData();
        data.append('action', 'ajax_like_product');
        data.append('id_product', id_product);

        // for (let value of data.values()) {
        //     console.log(value);
        // }

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                if(data.result === 'add like'){
                    this_product.addClass('v_active_like')
                    if(Number.parseInt(data.count) > 0){
                        if(!$('.like__counter').hasClass('v_like_header')){
                            $('.like__counter').addClass('v_like_header')
                        }
                    }
                    $('.like__counter').text(data.count);
                }
                if(data.result === 'remove like'){
                    this_product.removeClass('v_active_like')
                    if(Number.parseInt(data.count) === 0){
                        if($('.like__counter').hasClass('v_like_header')){
                            $('.like__counter').removeClass('v_like_header')
                        }
                    }
                    if(this_product.hasClass('js_can_remove')){
                        this_product.closest('.card__item-price_btn').remove();
                        if(Number.parseInt(data.count) === 0){
                            location.reload();
                        }
                    }
                    $('.like__counter').text(data.count);
                }
                remove_loader();
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                remove_loader();
                $.fancybox.open({
                    src: '#fncbx-error-ajax',
                    type: 'inline'
                });
            }
        })
    }

    $('.js_get_footer_form').click(function (event) {
        event.preventDefault();
        let button_this = $(this);
        let mail = $(this).closest('.js_get_form_info').find('.js_get_mail')
        let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

        if(!re.test(String(mail.val()).toLowerCase())){
            mail.addClass('error');
            return;
        }
        mail.removeClass('error');


        let data = new FormData();
        data.append('action', 'ajax_following');
        data.append('mail', mail.val());

        // for (let value of data.values()) {
        //     console.log(value);
        // }

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                if(data.result === 'success send'){
                    $('.js_clear').val('');
                    $.fancybox.open({
                        src: '#fncbx-success-following-send',
                        type: 'inline'
                    });
                    // button_this.attr('data-fancybox', '');
                    // button_this.attr('href', '#fncbx-success-following-send')
                    // // openPopup('success-following-send');
                    // button_this.fancybox();
                    // button_this.click();
                }
                // fdgdgdfg@sdf.ho
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                $('.js_send_review').find('.btn').attr('href', '#fncbx-error-send_review')
                $.fancybox.open({
                    src: '#fncbx-error-following-send',
                    type: 'inline'
                });
            }
        })

    })

    $('.js_add_product_to_cart').click(add_product_to_cart);
    function add_product_to_cart(event) {
        event.preventDefault();

        add_loader();
        let this_but = $(this);


        let product_id = $(this).attr('data-product_id');

        let data = new FormData();
        data.append('action', 'add_product_to_cart');
        data.append('product_id', product_id);

        if($(this).hasClass('js_has_variation')){
            let variation = $(this).closest('.card__item-price_btn').find('.color-active').attr('data-colour_product');
            if(variation){
                data.append('variation', variation);
            } else {
                let variation = $(this).closest('.card__item-price_btn').find('.js_get_variable_product').attr('data-colour_product');
                if(variation){
                    data.append('variation', variation);
                }
            }
        }

        for (let value of data.values()) {
            console.log(value);
        }

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                console.log('data' + data);
                // console.log('data = ' + data.html);
                if(data.result === 'add'){
                    console.log("add to cart")
                    console.log( "total_order = " +  data.total_order)
                    console.log( "count_products = " +  data.count_products)

                    this_but.text('В корзине')
                    if(Number.parseInt(data.count_products) === 0){
                        $('.js_paste_cart_statistic').html(
                            '<span class="basket__text">Нету покупок</span>'
                        )
                        $('.js_paste_count_cart_products').html(
                            '<span class="like__counter counter">' + data.count_products + '</span>'
                        )
                    } else {
                        console.log( "total_order = " +  data.total_order)
                        $('.js_paste_cart_statistic').html(
                        '<span class="basket__text">В корзине<span class="light-red">' + data.total_order + '</span>р.</span>'
                        )
                        $('.js_paste_count_cart_products').html(
                            '<span class="like__counter counter v_like_header">' + data.count_products + '</span>'
                        )
                    }
                } else {
                    console.log("do not add to cart");
                }
                remove_loader();
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                remove_loader();
                $.fancybox.open({
                    src: '#fncbx-error-add-to-cart',
                    type: 'inline'
                });
            }
        })

    }

    // $(document).on('click', '.js_sub_input_val', function (event) {
    //     event.preventDefault()
    //     console.log('-')
    //
    //     let $quantityNum = $(this).closest('.js_find_class').find('.input-text')
    //
    //     if ($quantityNum.val() > 1) {
    //         $quantityNum.val(+$quantityNum.val() - 1);
    //         $quantityNum.change();
    //         $("[name='update_cart']").trigger("click");
    //     }
    // });
    //
    // $(document).on('click', '.js_add_input_val', function (event) {
    //     event.preventDefault()
    //     console.log('+')
    //
    //     let $quantityNum = $(this).closest('.js_find_class').find('.input-text')
    //
    //     if ($quantityNum.val() < 300) {
    //         $quantityNum.val(+$quantityNum.val() + 1);
    //         $quantityNum.change();
    //         $("[name='update_cart']").trigger("click");
    //     }
    // });

    $('.js_add_product_order').click(function (event) {
        event.preventDefault();
        let this_info = $(this);
        grecaptcha.ready(function () {
            grecaptcha.execute($('.js_get_reCAPTCHA_site_key').attr('data-reCAPTCHA_site_key'), {action: 'submit'}).then(function (token) {
                // Add your logic to submit to your backend server here.


                let find_form_info = this_info.closest('.js_find_form_fields');
                let name, mail, phone, address, addition_text, pay_method;

                let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

                name = find_form_info.find('.js_get_name').val();
                if (name.length < 2) {
                    find_form_info.find('.js_get_name').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_name').removeClass('error');
                mail = find_form_info.find('.js_get_mail').val();

                if (!re.test(String(mail).toLowerCase())) {
                    find_form_info.find('.js_get_mail').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_mail').removeClass('error');
                phone = find_form_info.find('.js_get_phone').val().replace(/\D/g, '');
                if (phone.length < 11) {
                    find_form_info.find('.js_get_phone').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_phone').removeClass('error');

                address = find_form_info.find('.js_get_address').val();
                if (address.length < 2) {
                    find_form_info.find('.js_get_address').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_address').removeClass('error');

                addition_text = find_form_info.find('.js_get_addition_text').val();

                pay_method = find_form_info.find('.js_get_pay_method').attr('data-pay-method');
                if (pay_method === '0') {
                    find_form_info.find('.order-add-error').addClass('error');
                    return;
                }
                find_form_info.find('.order-add-error').removeClass('error');


                let data = new FormData();
                data.append('action', 'ajax_order_products');
                data.append('name', name);
                data.append('phone', phone);
                data.append('address', address);
                data.append('pay_method', pay_method);
                data.append('mail', mail);
                if (addition_text.trim().length > 0) {
                    data.append('mess', addition_text);
                }

                // for (let value of data.values()) {
                //     console.log(value);
                // }

                add_loader();

                $.ajax({
                    url: window.ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (data) {
                        // console.log('data' + data);
                        // console.log('data = ' + data.html);
                        // console.log('send = ' + data.result)
                        if (data.result === 'add order') {
                            remove_loader();
                            window.location.replace(data.order_url)
                            // console.log(data.order_url)
                            // console.log("set_order" + data.set_stat)
                            $('.js_clear').val('');
                            let index_btn_popup = $(this).attr('href');
                            openPopup(index_btn_popup);
                        }
                    },
                    error: function (jqXHR, status, errorThrown) {
                        console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                        remove_loader();
                        $.fancybox.open({
                            src: '#fncbx-error-ajax',
                            type: 'inline'
                        });
                    }
                })
            });
        });
    })


    function selectChoose() {
        let text = this.innerHTML,
            select = this.closest('.select-order'),
            currentText = select.querySelector('.select__current-order');
        currentText.innerHTML = text;
        select.classList.remove('is-active');
        $(this).closest('.select-order').find('.select__current-order').attr('data-pay-method', $(this).attr('data-pay-method'));
    }

    $('.js_click_select_shipping').click(function (event) {
        event.preventDefault()
        let shipping = $(this).attr('data-shipping');

        let data = new FormData();
        data.append('action', 'select_shipping');
        data.append('shipping', shipping);

        // for (let value of data.values()) {
        //     console.log(value);
        // }

        add_loader();

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                // console.log('send = ' + data.result)
                if(data.result === 'add'){
                    // console.log('status = ' + data.status)
                    // console.log('count__ = ' + data.count__);
                    $('.js_paste_shipping_method').text(data.cost + '₽')
                    $('.js_total_cart').text(data.total_cost)
                    // console.log('data.payment = ' + data.payment);
                    $('.js_paste_payment').html(data.payment);
                    $('.js_get_pay_method').attr('data-pay-method', '0').text('Выберите метод оплаты');
                    let selectItem = document.querySelectorAll('.select__item-order');
                    selectItem.forEach(item => {
                        item.addEventListener('click', selectChoose)
                    });
                }
                remove_loader();
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                remove_loader();
                $.fancybox.open({
                    src: '#fncbx-error-ajax',
                    type: 'inline'
                });
            }
        })

    })

    $('.js_delete_product_from_cart').click(function (event) {
        // console.log('delete element')
        add_loader();
        event.preventDefault()
        let this_element = $(this);
        let product_id = $(this).attr('data-delete-product');

        let data = new FormData();
        data.append('action', 'delete_product_from_cart');
        data.append('product_id', product_id);

        // for (let value of data.values()) {
        //     console.log(value);
        // }

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                // console.log('send = ' + data.result)
                if(data.result === 'remove'){
                    // console.log('success delete');
                    this_element.closest('.basket__wrapp-card').remove();
                    if(Number.parseInt(data.count_products) === 0){
                        location.reload();
                    }else {
                        $('.js_paste_cart_statistic').html(
                            '<span class="basket__text">В корзине<span class="light-red">' + data.total_order + '</span>р.</span>'
                        )
                        $('.js_paste_count_cart_products').html(
                            '<span class="like__counter counter v_like_header">' + data.count_products + '</span>'
                        )
                    }


                    $('.js_total_cart').html(data.cart_total);
                    $('.js_cart_subtotal').html(data.cart_subtotal);
                }
                remove_loader();
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                remove_loader();

                $.fancybox.open({
                    src: '#fncbx-error-ajax',
                    type: 'inline'
                });
            }
        })
    })

    function add_loader(){
        $('.js_loader_control').addClass('v_loader')
    }

    function remove_loader(){
        $('.js_loader_control').removeClass('v_loader')
    }

    $('.js_input_press_enter').change(change_cart_quantity);

    $('.js_change_cart_quantity').click(change_cart_quantity)
    function change_cart_quantity(event) {
        event.preventDefault();
        let product_control = $(this).closest('.basket__count-inner')
        let cart_item_key = product_control.attr('data-product-id');
        let quantity_product = product_control.find('.basket__count').val()
        if(quantity_product < 1)
            return;

        let data = new FormData();
        data.append('action', 'add_product_quantity');
        data.append('cart_item_key', cart_item_key);
        data.append('new_quantity', quantity_product);


        // for (let value of data.values()) {
        //     console.log(value);
        // }

        add_loader()

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                if(data.result === 'change'){
                    product_control.closest('.basket__column-right').find('.basket__price-sum').html(data.subtotal);
                    $('.js_total_cart').html(data.cart_total);
                    $('.js_cart_subtotal').html(data.cart_subtotal);
                }
                remove_loader();
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                remove_loader()

                $.fancybox.open({
                    src: '#fncbx-error-ajax',
                    type: 'inline'
                });
            }
        })
    }

    $('.js_add_coupons').click(function (event) {
        event.preventDefault()
        let find_coupons = $(this).closest('.js_find_coupons')
        let coupons = find_coupons.find('.js_get_coupons').val().replace(/ /g,'');

        if(coupons.length < 1){
            find_coupons.find('.js_coupons_status').text('Не верный купон')
            setTimeout(function(){
                find_coupons.find('.js_coupons_status').text('')
                }, 3000
            )
            return;
        }


        let data = new FormData();
        data.append('action', 'add_product_coupons');
        data.append('coupons', coupons);


        // for (let value of data.values()) {
        //     console.log(value);
        // }

        add_loader();

        $.ajax({
            url: window.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (data) {
                // console.log('data' + data);
                // console.log('data = ' + data.html);
                // console.log('send = ' + data.result)
                if(data.result === 'add'){
                    if(!data.info){
                        find_coupons.find('.js_coupons_status').text('Не верный купон')
                        setTimeout(function(){
                                find_coupons.find('.js_coupons_status').text('')
                            }, 3000
                        )
                    } else {
                        find_coupons.find('.js_coupons_status').text('Купон добавлен')
                        setTimeout(function(){
                                find_coupons.find('.js_coupons_status').text('')
                            }, 3000
                        )
                        $('.js_total_cart').html(data.cart_total);
                        $('.js_coupons').text('- ' + data.amount);
                    }
                    find_coupons.find('.js_get_coupons').val('')
                }
                remove_loader();
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                remove_loader();
                $.fancybox.open({
                    src: '#fncbx-error-ajax',
                    type: 'inline'
                });
            }
        })
    })

    $('.js_bay_product_in_one_click').click(function (event) {
        event.preventDefault();
        let this_info = $(this);
        grecaptcha.ready(function () {
            grecaptcha.execute($('.js_get_reCAPTCHA_site_key').attr('data-reCAPTCHA_site_key'), {action: 'submit'}).then(function (token) {
                // Add your logic to submit to your backend server here.

                let find_form_info = this_info.closest('.js_get_form_info');
                let name, mail, phone, address;

                let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

                name = find_form_info.find('.js_get_name').val();
                if (name.length < 2) {
                    find_form_info.find('.js_get_name').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_name').removeClass('error');
                mail = find_form_info.find('.js_get_email').val();

                if (!re.test(String(mail).toLowerCase())) {
                    find_form_info.find('.js_get_email').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_email').removeClass('error');
                phone = find_form_info.find('.js_get_phone').val().replace(/\D/g, '');
                if (phone.length < 11) {
                    find_form_info.find('.js_get_phone').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_phone').removeClass('error');

                address = find_form_info.find('.js_get_address').val();
                if (address.length < 2) {
                    find_form_info.find('.js_get_address').addClass('error');
                    return;
                }
                find_form_info.find('.js_get_address').removeClass('error');


                let product_id = this_info.attr('data-product_id');


                let data = new FormData();
                data.append('action', 'ajax_order_in_one_click');

                data.append('product_id', product_id);

                if (this_info.hasClass('js_has_variation')) {
                    // console.log('+++++++');
                    let variation = $('.card__item-price_btn').find('.color-active').attr('data-variation_id');
                    if (variation) {
                        data.append('variation', variation);
                    }
                }

                data.append('name', name);
                data.append('phone', phone);
                data.append('address', address);
                data.append('email', mail);

                // for (let value of data.values()) {
                //     console.log(value);
                // }

                add_loader();

                $.ajax({
                    url: window.ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (data) {
                        // console.log('data' + data);
                        // console.log('data = ' + data.html);
                        // console.log('variation_id = ' + data.variation_id)
                        if (data.result === 'add') {
                            // console.log('send = ' + data.result)
                            $('.js_clear_input').val('')
                        }
                        $.fancybox.open({
                            src: '#fncbx-success-bay-in-one-click',
                            type: 'inline'
                        });
                        remove_loader();
                    },
                    error: function (jqXHR, status, errorThrown) {
                        console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                        remove_loader();
                        $.fancybox.open({
                            src: '#fncbx-error-ajax',
                            type: 'inline'
                        });
                    }
                })

            });
        });
    })

    myMap = new Map();

    $('.js_show_prew_order').click(show_prew_order);
    function show_prew_order(event) {
        event.preventDefault();
        let this_info = $(this);
        myMap.set('product_id', $(this_info).attr('data-product_id'));

        if($(this_info).hasClass('js_has_variation')){
            let variation = $(this_info).closest('.card__item-price_btn').find('.color-active').attr('data-colour_product');
            if(variation){
                myMap.set('variation', variation);
            } else {
                let variation = $(this_info).closest('.card__item-price_btn').find('.js_get_variable_product').attr('data-colour_product');
                if(variation){
                    myMap.set('variation', variation);
                }
            }
        }

        $.fancybox.open({
            src: '#fncbx-prew_order',
            type: 'inline'
        });
    };


    $('.js_show_prew_order_mail').click(show_prew_order_mail);
    function show_prew_order_mail(event) {
        event.preventDefault();
        console.log('mail')
        // console.log(myMap.get('product_id'))
        // console.log(myMap.get('variation'))
        let this_info = $(this);
        // grecaptcha.ready(function () {
        //     grecaptcha.execute($('.js_get_reCAPTCHA_site_key').attr('data-reCAPTCHA_site_key'), {action: 'submit'}).then(function (token) {
                // Add your logic to submit to your backend server here.


            let get, name, phone, mail, address;
            let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

            get = this_info.closest('.js_get_form_info_prew_order');
            name = get.find('.js_get_name').val();
            if (name.length < 2) {
                get.find('.js_get_name').addClass('error');
                return;
            }
            get.find('.js_get_name').removeClass('error');

            // console.log('name = ', name)
            mail = get.find('.js_get_email').val();

            if (!re.test(String(mail).toLowerCase())) {
                get.find('.js_get_email').addClass('error');
                return;
            }
            get.find('.js_get_email').removeClass('error');
            // console.log('mail = ', mail)
            phone = get.find('.js_get_phone').val().replace(/\D/g, '');
            // console.log('phone = ', phone)
            if (phone.length < 11) {
                get.find('.js_get_phone').addClass('error');
                return;
            }
            get.find('.js_get_phone').removeClass('error');

            address = get.find('.js_get_address').val();
            if (address.length < 2) {
                get.find('.js_get_address').addClass('error');
                return;
            }
            get.find('.js_get_address').removeClass('error');

            let data = new FormData();
            data.append('action', 'prew_order');
            data.append('product_id', myMap.get('product_id'));
            data.append('name', name);
            data.append('phone', phone);
            data.append('mail', mail);
            data.append('address', address);
            if(myMap.has('variation')) {
                data.append('variation', myMap.get('variation'));
            }

                for (let value of data.values()) {
                    console.log(value);
                }

                $.ajax({
                    url: window.ajaxUrl,
                    type: 'POST',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function (data) {
                        // console.log('data' + data);
                        // console.log('data = ' + data.html);
                        console.log( "result = " +  data.result)
                        if(data.result === 'add'){
                            $('.js_clear_input').val('')
                            myMap.clear();
                        } else {
                            console.log("do not add to cart");
                        }
                        $.fancybox.close({
                            src: '#fncbx-prew_order',
                            // type: 'inline'
                        })
                    },
                    error: function (jqXHR, status, errorThrown) {
                        console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                        remove_loader();
                        $.fancybox.open({
                            src: '#fncbx-error-ajax',
                            type: 'inline'
                        });
                    }
                })

        //     });
        // });
    }
});