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

use North521\HyperfScout\Console\FlushCommand;
use North521\HyperfScout\Console\ImportCommand;
use North521\HyperfScout\Engine\Engine;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                Engine::class => EngineFactory::class,
            ],
            'commands' => [
                ImportCommand::class,
                FlushCommand::class,
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of hyperf scout.',
                    'source' => __DIR__ . '/../publish/north521-scout.php',
                    'destination' => BASE_PATH . '/config/autoload/north521-scout.php',
                ],
            ],
        ];
    }
}
