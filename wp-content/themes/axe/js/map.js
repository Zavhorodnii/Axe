

// Функция ymaps.ready() будет вызвана, когда
// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
//ymaps.ready(init);

setTimeout
(
    function()
    {
        ymaps.ready(init);
    },
    1000
)

function init(){
    // $('.map').removeClass('loading');
    // Создание карты.
    $('.js_loader_control').addClass('v_loader')
    let count_map = Number.parseInt($('.map_count').attr('data-map_count'));
    for (let i = 1; i <= count_map; i++){

        let map = [];
        let val = $('.map_' + i).attr('data-address');
        // if(!val)
        //     map = [55.796127, 49.106405];
        // else
        map = val.split(', ')
        var myMap = new ymaps.Map("y_masters_map_" + i, {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.

            center: map,
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 13
        }, {
            searchControlProvider: 'yandex#search'
        });
        if(val) {
            var myPlacemark = new ymaps.Placemark(map);
            myMap.geoObjects.add(myPlacemark);
        }
    }
    $('.js_loader_control').removeClass('v_loader')
}