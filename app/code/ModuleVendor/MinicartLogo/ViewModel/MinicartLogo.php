<?php

namespace ModuleVendor\MinicartLogo\ViewModel;

use Magento\Theme\Block\Html\Header\Logo;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class MinicartLogo implements ArgumentInterface
{
    private $storeLogo;

    public function __construct(Logo $logo)
    {
        $this->storeLogo = $logo;
    }

    public function logo() {
        return $this->storeLogo;
    }
}