<?php


class LAFavoriteProducts 
{
	// переменная для хранения списка избранных в куках
	public $la_favorite_products = array();

	public function __construct()
	{
		$this->la_get_cookie_favorite_products();

		// добавить в список
		add_action('wp_ajax_la_favorite_add', array($this, 'la_favorite_add'));
		add_action('wp_ajax_nopriv_la_favorite_add',  array($this, 'la_favorite_add'));

		// получить список
		add_action('wp_ajax_la_favorite_list', array($this, 'la_favorite_list'));
		add_action('wp_ajax_nopriv_la_favorite_list',  array($this, 'la_favorite_list'));

		// удалить из списка
		add_action('wp_ajax_la_favorite_remove', array($this, 'la_favorite_remove'));
		add_action('wp_ajax_nopriv_la_favorite_remove',  array($this, 'la_favorite_remove'));
	}

	// загружает список избранных с куков
	function la_get_cookie_favorite_products()
	{
		$ids = $_COOKIE["la_favorite_products"];

		if(!isset($ids)) 
			$ids = array();
		else
		{
			$ids = explode(',', $ids);
			foreach($ids as $id)
			{
				$this->la_favorite_products[$id] = $id;
			}   
		}

	}

	
	// обновление куков на избранные товары
	function la_set_cookie_favorite_products()
	{
		$i = 0;

		$ids = implode(',', $this->la_favorite_products);

		setcookie("la_favorite_products", $ids, time()+31536000, COOKIEPATH, COOKIE_DOMAIN, false);
	}

	// возвращает верстку карточки товара из избранного
	function la_favorite_get_card($product_id)
	{
		$card = '<div class="js-card" data-id="' . $product_id . '">card ' . $product_id . '</div>';

		return $card;
	}

	// добавляет карточку в избранное
	function la_favorite_add()
	{
		if(!isset($_POST['product_id']))
			la_ajax_result('error', 'Not set product ID');

		$product_id = intval($_POST['product_id']);

		$card = '';

		if(!isset($this->la_favorite_products[$product_id]))
			$card = $this->la_favorite_get_card($product_id);

		$this->la_favorite_products[$product_id] = $product_id;

		$this->la_set_cookie_favorite_products();

		
	
		echo json_encode
		(
			array
			(
				'result'	=> 'ok',
				'card'		=> $card,
			)
		);

		die;
	}

	// получает список всех карточек
	function la_favorite_list()
	{
		$cards = array();
		foreach($this->la_favorite_products as $product_id)
		{
			$card = $this->la_favorite_get_card($product_id);
			$cards[] = $card;
		}

		echo json_encode
		(
			array
			(
				'result'	=> 'ok',
				'cards'		=> implode($cards),
			)
		);

		die;
	}

	// удаляет карточку с избранных
	function la_favorite_remove()
	{
		if(!isset($_POST['product_id']))
			la_ajax_result('error', 'Not set product ID');

		$product_id = intval($_POST['product_id']);

		unset($this->la_favorite_products[$product_id]);

		$this->la_set_cookie_favorite_products();

	 	// ищи функцию в template-functions.php
		la_ajax_result('ok');
	}

	
}

$la_favorite_products = new LAFavoriteProducts();


?>