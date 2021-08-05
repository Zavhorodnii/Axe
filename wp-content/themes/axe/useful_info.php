<?php
$product_info = wc_get_product( $product->ID );

// Now you have access to (see above)...

$product_info->get_type();
$product_info->get_name();
echo 'product type = ' . $product_info->get_type(). '<br>';
echo 'product name = ' . $product_info->get_name(). '<br>';
//                                        echo 'product _attributes 1 = <br><br>';
//                                        var_export($product_info->get_attributes());
echo $index . ' price = ' . $product_info->get_price() . '<br>';
echo $index . ' get_regular_price = ' . $product_info->get_regular_price() . '<br>';
echo $index . ' sale price = ' . $product_info->get_sale_price() . '<br>';

$index = 0;
foreach ($product_info->get_attributes() as $attribute){
    $attr = $attribute['data']['name'];
    echo $index . ' attribute = ' . $attr . '<br>';
    echo $index . ' attribute = ' . wc_attribute_label( $attr ) . '<br>';
    echo 'product _attributes 2 = ' . $product_info->get_attribute( $attr ). '<br><br>';
    $index++;
}

// from here $_product will be a fully functional WC Product object,
// you can use all functions as listed in their api

?>