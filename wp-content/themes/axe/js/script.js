$(document).ready
(
	function()
	{
		console.log('scripts');

		// объект jQuery основного документа
		var $document = $(document);

		// избранные товары
		var FavoriteProducts = 
		{
			// добавить товар
			onAddProductClick: function(event)
			{
				event.preventDefault();

				console.log('on add');

				let $this = $(this);

				let id = $this.attr('data-id');

				if(id == null) return;

				var formData = new FormData();

                formData.append('action', 'la_favorite_add');
				formData.append('product_id', id);
				
				$.ajax
                (
                    {
                        url: window.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(data)
                        {
							console.log(data);
                            if(data.result == 'ok')
                            {
                                $document.find('body').append(data.card);
                            }
                        },
                        error: function(param1, param2, param3)
                        {
                            console.log(param1);
                            console.log(param2);
                            console.log(param3);
                        }
                    }
                );
			},
			// удалить товары
			onRemoveProductClick: function(event)
			{
				event.preventDefault();

				console.log('on remove');

				let $this = $(this);

				let id = $this.attr('data-id');

				if(id == null) return;

				var formData = new FormData();

                formData.append('action', 'la_favorite_remove');
				formData.append('product_id', id);
				
				$.ajax
                (
                    {
                        url: window.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(data)
                        {
							console.log(data);
                            if(data.result == 'ok')
                            {
                                $('.js-card[data-id=' + id + ']').remove();
                            }
                        },
                        error: function(param1, param2, param3)
                        {
                            console.log(param1);
                            console.log(param2);
                            console.log(param3);
                        }
                    }
                );
			},
			// загрузить список
			loadList: function()
			{
				console.log('on list');

				var formData = new FormData();

                formData.append('action', 'la_favorite_list');
				
				$.ajax
                (
                    {
                        url: window.ajaxUrl,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(data)
                        {
							console.log(data);
                            if(data.result == 'ok')
                            {
                                $document.find('body').append($(data.cards));
                            }
                        },
                        error: function(param1, param2, param3)
                        {
                            console.log(param1);
                            console.log(param2);
                            console.log(param3);
                        }
                    }
                );
			},
			// инициализация
			init: function()
			{
				$document.on('click', '.js-favorite-add', this.onAddProductClick);
				$document.on('click', '.js-favorite-remove', this.onRemoveProductClick);

				this.loadList();
			}
		};

		FavoriteProducts.init();
	}
);