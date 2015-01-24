Silex Provider для API 2GIS
============================

Расширение Silex поставщиком данных из API 2GIS. Провайдер оборачивает компонент `2gis/api-client`.

[![Build Status](https://travis-ci.org/pavelgopanenko/2Gis-Silex-Provider.svg)](https://travis-ci.org/pavelgopanenko/2Gis-Silex-Provider)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pavelgopanenko/2Gis-Silex-Provider/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pavelgopanenko/2Gis-Silex-Provider/?branch=master)

## Установка

### composer

```yaml
{
    "require": {
        "2gis/api-silex-provider": "dev-master"
    }
}
```

### регистрация поставщика
```php
    use DGis\Silex\Api\Provider\DGisApiServiceProvider;
    // ...
    $app->register(new DGisApiServiceProvider(), array(
        'dgis.api.options' => array(
            'key' => 'test',
        ),
    ));
```

## Использование

### Параметры
* `key` - Уникальный [ключ для доступа к API](http://partner.api.2gis.ru/), обязательный параметр.
* `mapper_factory` - Класс фабрики [маппера сущностей](https://github.com/2gis/webapi-client/blob/master/src/DGApiClient/Mappers/MapperFactory.php) API в объекты приложения. По-умолчанию используется стандартный маппер.
* `class_map` - Массив сопоставления сущностей API с классами приложения, например `` 'Address' => '\MyCustomAddress' ``. По-умолчанию используются классы клинтской библиотеки.

### Сервисы
* ``$app['gdis.api.region']`` - [API регионов](http://api.2gis.ru/doc/2.0/region/quickstart)
* ``$app['gdis.api.catalog']`` - [API справочника](http://api.2gis.ru/doc/2.0/catalog/quickstart)
* ``$app['gdis.api.transport']`` - [API транспорта](http://api.2gis.ru/doc/2.0/transport/route/search)
* ``$app['gdis.api.geo']`` - [API геоданных](http://api.2gis.ru/doc/2.0/geo/method/search-query/query)

## Лицензия
* Билиотека поставляется под лицензией `MIT`
* [Правовая информация по API 2ГИС](http://help.2gis.ru/api-rules/)
