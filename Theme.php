<?php

namespace CMW\Theme\Feather;

use CMW\Manager\Theme\IThemeConfig;

class Theme implements IThemeConfig
{
    public function name(): string
    {
        return 'Feather';
    }

    public function version(): string
    {
        return '0.0.1';
    }

    public function cmwVersion(): string
    {
        return 'alpha-07';
    }

    public function author(): ?string
    {
        return 'Overheat Studio';
    }

    public function authors(): array
    {
        return [];
    }

    public function compatiblesPackages(): array
    {
        return [
            'Core',
            'Pages',
            'Users',
            'News',
            'Newsletter',
            'Contact',
        ];
    }

    public function requiredPackages(): array
    {
        return ['Core', 'Users', 'News'];
    }

    public function imageLink(): ?string
    {
        return null;
    }
}
