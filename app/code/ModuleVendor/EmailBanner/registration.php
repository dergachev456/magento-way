<?php declare(strict_types=1);

/**
 * @copyright    Copyright (C) 2020 iFuel (www.ifuelinteractive.com)
 * @author       Anton Semiletov <asemiletov@ifuelinteractive.com>
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'ModuleVendor_EmailBanner',
    __DIR__
);
