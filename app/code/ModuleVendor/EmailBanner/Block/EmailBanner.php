<?php declare(strict_types=1);

/**
 * Display login for email banner
 *
 * @copyright    Copyright (C) 2020 iFuel (www.ifuelinteractive.com)
 * @author       Anton Semiletov <asemiletov@ifuelinteractive.com>
 */

namespace Ifuel\EmailBanner\Block;

use Ifuel\EmailBanner\ViewModel\Config;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class EmailBanner
 */
class EmailBanner extends Template
{
    /**
     * Email banner cms block id
     */
    const FORM_ACTION_PATH = 'cw_dotdigital/email/register';

    /**
     * @var Config
     */
    private $config;

    /**
     * EmailBanner constructor.
     *
     * @param Context $context
     * @param Config  $config
     * @param array   $data
     */
    public function __construct(
        Context $context,
        Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
    }

    /**
     * Returns email banner HTML if it's enabled
     *
     * @return string
     */
    protected function _toHtml(): string
    {
        $result = '';
        if ($this->config->isEnabled()) {
            $result = parent::_toHtml();
        }

        return $result;
    }

    /**
     * Gets action url for email form
     *
     * @return string
     */
    public function getFormUrl(): string
    {
        return $this->_urlBuilder->getUrl(self::FORM_ACTION_PATH);
    }
}
