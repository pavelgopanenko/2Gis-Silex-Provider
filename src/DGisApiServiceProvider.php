<?php

namespace DGis\Silex\Api\Provider;

use DGApiClient\ApiConnection;
use DGApiClient\Catalog;
use DGApiClient\Geo;
use DGApiClient\Region;
use DGApiClient\Transport;
use Silex\Application;
use Silex\ServiceProviderInterface;

class DGisApiServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Application $app)
    {
        $app['dgis.api.options'] = array();

        $app['dgis.api.connection'] = $app->share(function(Application $app) {
            $options = $app['dgis.api.options'];
            if (empty($options['key'])) {
                throw new \InvalidArgumentException('Requirement key option for 2Gis API');
            }

            /* @var \Psr\Log\LoggerInterface $logger */
            $logger = isset($app['logger']) ? $app['logger'] : null;

            return new ApiConnection($options['key'], $logger);
        });

        $app['dgis.api.mapper'] = $app->share(function(Application $app) {
            $options = $app['dgis.api.options'];
            $mapperClass = isset($options['mapper_factory']) ? $options['mapper_factory'] : '\DGApiClient\Mappers\MapperFactory';
            $classMap = isset($options['class_map']) ? $options['class_map'] : array();

            return new $mapperClass($classMap);
        });

        $app['dgis.api.region'] = $app->share(function(Application $app) {
            return new Region($app['dgis.api.connection'], $app['dgis.api.mapper']);
        });

        $app['dgis.api.catalog'] = $app->share(function(Application $app) {
            return new Catalog($app['dgis.api.connection'], $app['dgis.api.mapper']);
        });

        $app['dgis.api.transport'] = $app->share(function(Application $app) {
            return new Transport($app['dgis.api.connection'], $app['dgis.api.mapper']);
        });

        $app['dgis.api.geo'] = $app->share(function(Application $app) {
            return new Geo($app['dgis.api.connection'], $app['dgis.api.mapper']);
        });
    }

    /**
     * @inheritdoc
     */
    public function boot(Application $app)
    {
    }
}
