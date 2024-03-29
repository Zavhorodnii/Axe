<?php

class WC_Yandex_Money_Gateway extends WC_Payment_Gateway {
	function __construct() {
		$this->id = 'wc_yandex_money_gateway';
		$this->method_title = __( 'WC Yandex.Money Gateway');
		$this->method_description = __( 'Оплата с помощью Яндекс.Деньги');
		$this->title = __( 'WC Yandex.Money Gateway');
		$this->icon = '/wp-content/themes/hepa/images/pay-logo3.svg';
		$this->has_fields = true;
		$this->supports = array();

		$this->init_form_fields();
		$this->init_settings();

		$this->title = $this->get_option('title');
		$this->description = $this->get_option('description');
		$this->wallet_number = $this->get_option('wallet_number');
		$this->formcomment = $this->get_option('formcomment');
		$this->notification_secret = $this->get_option('notification_secret');

		$this->url = 'https://money.yandex.ru/quickpay/confirm.xml';

		foreach ( $this->settings as $setting_key => $value ) {
			$this->$setting_key = $value;
		}
		
		add_action( 'woocommerce_receipt_' . $this->id, array( $this, 'receipt_page' ) );
		add_action( 'woocommerce_api_' . $this->id, array( $this, 'check_ipn_response' ) );

		// Save settings
		if ( is_admin() ) {
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		}		
	}

	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'		=> __( 'Включение / Отключение'),
				'label'		=> __( 'Включить'),
				'type'		=> 'checkbox',
				'default'	=> 'no',
			),
			'title' => array(
				'title'		=> __( 'Title'),
				'type'		=> 'text',
				'desc_tip'	=> __( 'Название оплаты клиент будет видеть в процессе оформления заказа.'),
				'default'	=> __( 'Яндекс.Деньги'),
			),
			'description' => array(
				'title'		=> __( 'Description'),
				'type'		=> 'textarea',
				'desc_tip'	=> __( 'Описание оплаты клиент будет видеть в процессе оформления заказа.'),
				'default'	=> __( 'Оплата через Яндекс.Деньги.')
			),
			'wallet_number' => array(
				'title'		=> __( 'Номер кошелька'),
				'type'		=> 'text'
			),
			'formcomment' => array(
				'title'		=> __( '
Название получателя'),
				'type'		=> 'text'
			),
			'notification_secret' => array(
				'title'		=> __( 'Секретное слово уведомления'),
				'type'		=> 'text',
				'description' => __('Секретное слово смотрим  здесь https://money.yandex.ru/myservices/online.xml <br> укажите адрес в HTTP-уведомлениях http://www.ваш сайт.ru/?wc-api=WC_Yandex_Money_Gateway ', 'woocommerce'),
			)
		);
	}

	public function generate_form($order_id) {
		$order = new WC_Order( $order_id );

		$order_name = __('Order No. ') . $order_id;

		$args = array(
				'receiver' => $this->wallet_number,
				'formcomment' => $this->formcomment,
				'short-dest' => $order_name,
				'quickpay-form' => 'shop',
				'targets' => $order_name,
				'sum' => $order->order_total,
				'paymentType' => 'PC',
				'label' => $order_id,
			);

		$paypal_args = apply_filters('woocommerce_robokassa_args', $args);

		$args_array = array();

		foreach ($args as $key => $value) {
			$args_array[] = '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($value).'" />';
		}

		return
			'<form action="'.esc_url($this->url).'" method="POST" class="order_actions">'."\n".
			implode("\n", $args_array).
			'<input type="submit" class="button alt" value="'.__('Оплатить').'" /> <a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Отменить заказ').'</a>'."\n".
			'</form>';
	}

	public function process_payment($order_id) {
		$order = new WC_Order($order_id);

		return array(
			'result' => 'success',
			'redirect'	=> add_query_arg('order', $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay'))))
		);
	}

	public function receipt_page($order) {
		print '<p>'.__('Благодарим Вас за Ваш заказ.<br>После оплаты нажмите: вернуться на сайт магазина.', 'woocommerce').'</p>';
		print $this->generate_form($order);
	}

	// usage: /?wc-api=wc_yandex_money_gateway
	public function check_ipn_response() {
		$sha1_hash = $_POST['sha1_hash'];

		$string = array(
			$_POST['notification_type'],
			$_POST['operation_id'],
			$_POST['amount'],
			$_POST['currency'],
			$_POST['datetime'],
			$_POST['sender'],
			$_POST['codepro'],
			$this->notification_secret,
			$_POST['label']
		);

		$sha1_string = sha1(implode('&', $string));

		if ( $sha1_hash == $sha1_string ) {
			$order = new WC_Order($_POST['label']);
			$order->payment_complete();

			exit();
		} else {
			wp_die();
		}
	}
}