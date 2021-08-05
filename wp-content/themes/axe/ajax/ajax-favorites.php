<?php


add_action('wp_ajax_ajax_like_product', 'ajax_like_product');
add_action('wp_ajax_nopriv_ajax_like_product', 'ajax_like_product');


function ajax_like_product(){

    if(!isset($_POST['id_product'])){
        $result = array(
            'result'    => 'error',
        );
        echo json_encode($result);
        die();
    }

    $id_product = $_POST['id_product'];
    $like_control = '';

    $cookie = explode('&', $_COOKIE["Cookie_like_product"]);
    if(!in_array(strval($id_product), $cookie)){
        $cookie[] = $id_product;
        $like_control = 'add like';
    } else{
        $index = array_search($id_product, $cookie);
        unset($cookie[$index]);
        $like_control = 'remove like';
    }
    $count_cookie = count($cookie)-1;
//    var_export($cookie);
    setcookie("Cookie_like_product", implode('&', $cookie), time() + 3600 * 24 * 365, "/", null, null, true);

    $result = array(
        'result'    => $like_control,
        'count'     => $count_cookie,
    );
    echo json_encode($result);
//    var_export($result);
    die();

}




?>