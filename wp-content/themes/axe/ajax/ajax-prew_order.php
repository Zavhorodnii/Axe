<?php


add_action('wp_ajax_prew_order', 'prew_order');
add_action('wp_ajax_nopriv_prew_order', 'prew_order');

function prew_order()
{
    if (!isset($_POST['product_id'])) {
        $result = array(
            'result' => 'error',
        );
        echo json_encode($result);
        die();
    }
    $product_id = $_POST['product_id'];

    if(!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['mail']) || !isset($_POST['address'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $address = $_POST['address'];
    $variation = isset($_POST['variation']) ? ('Вариация: ' . $_POST['variation'] . "\r\n") : null ;

    $mail_send = get_field('catalog_mail_order', 'option');

    $mail_massage = 'Сайт: ' . get_site_url() . "\r\n" . 'Товар: ' . get_site_url() . '/wp-admin/post.php?post=' . $product_id . '&action=edit' . "\r\n" . $variation .
     'Имя: ' . $name . "\r\n" . 'Номер телефона: ' . $phone
        . "\r\n" . 'Почта: ' . $mail . "\r\n" . 'Адрес: ' . $address;

    $headers = 'From: Сообщение с  <axe/@axe.com>' . "\r\n";
    $success = wp_mail($mail_send, 'Обратная связь', $mail_massage, $headers);


    $result = array(
        'result' => 'add',
    );
    echo json_encode($result);
    die();
}