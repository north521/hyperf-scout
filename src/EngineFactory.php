<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace North521\HyperfScout;

use Hyperf\Contract\ConfigInterface;
use North521\HyperfScout\Provider\ElasticsearchProvider;
use North521\HyperfScout\Provider\ProviderInterface;
use Psr\Container\ContainerInterface;

class EngineFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        $name = $config->get('scout.default', 'elasticsearch');
        $driver = $config->get("scout.engine.{$name}.driver", ElasticsearchProvider::class);
        $driverInstance = make($driver);
        if ($driverInstance instanceof ProviderInterface) {
            return $driverInstance->make($name);
        }
        return $driverInstance;
    }
}
