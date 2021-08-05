<?php

add_action('wp_ajax_ajax_send_mess', 'ajax_send_mess');
add_action('wp_ajax_nopriv_ajax_send_mess', 'ajax_send_mess');

add_action('wp_ajax_ajax_following', 'ajax_following');
add_action('wp_ajax_nopriv_ajax_following', 'ajax_following');


function ajax_send_mess(){

    if(!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['mail']) || !isset($_POST['mess'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $mess = $_POST['mess'];

    $mail_send = get_field('notify_backcall', 'option');

    $mail_massage = 'Сайт: ' . get_site_url() . "\r\n" .'Имя: ' . $name . "\r\n" . 'Номер телефона: ' . $phone
        . "\r\n" . 'Почта: ' . $mail . "\r\n" . 'Сообщение: ' . $mess;

    $headers = 'From: Сообщение с  <axe/@axe.com>' . "\r\n";
    $success = wp_mail($mail_send, 'Обратная связь', $mail_massage, $headers);

    if ($success){
        $result = array(
            'result'    => 'success send',
        );
    } else{
        $result = array(
            'result'    => 'error2',
        );
    }
    echo json_encode($result);
//    var_export($result);
    die();
}

function ajax_following(){
    if(!isset($_POST['mail'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }
    $mail = $_POST['mail'];

    $mail_send = get_field('notify_backcall', 'option');

    $mail_massage = 'Сайт: ' . get_site_url() . "\r\n" . 'Почта: ' . $mail . "\r\n";

    $headers = 'From: Сообщение с  <axe/@axe.com>' . "\r\n";
    $success = wp_mail($mail_send, 'Подписка на рассылку', $mail_massage, $headers);

    if ($success){
        $result = array(
            'result'    => 'success send',
        );
    } else{
        $result = array(
            'result'    => 'error2',
        );
    }
    echo json_encode($result);
//    var_export($result);
    die();
}

?>