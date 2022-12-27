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
namespace North521\HyperfScout\Provider;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Elasticsearch\ClientBuilderFactory;
use North521\HyperfScout\Engine\ElasticsearchEngine;
use North521\HyperfScout\Engine\Engine;
use Psr\Container\ContainerInterface;

class ElasticsearchProvider implements ProviderInterface
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function make(string $name): Engine
    {
        $config = $this->container->get(ConfigInterface::class);
        $builder = $this->container->get(ClientBuilderFactory::class)->create();
        $client = $builder->setHosts($config->get("scout.engine.{$name}.hosts"))->build();
        $index = $config->get("scout.engine.{$name}.index");
        return new ElasticsearchEngine($client, $index);
    }
}
