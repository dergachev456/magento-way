<?php

namespace ModuleVendor\StaticPage\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Cms\Model\PageFactory;

class UpgradeData implements UpgradeDataInterface
{
    protected $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.1') < 0) {
            $content = 'Static Page content <em>here it is</em>';
            /*
             * Массив со свойствами для создания страницы
             * все возможные свойства и методы можно найти в файле
             * vendor/magento/module-cms/Api/Data/PageInterface.php
             * */
            $pageData = [
                'title' => 'New CMS page prog',
                'identifier' => 'custom-cms-page',
                'is_active' => 1,
                'page_layout' => '1column',
                'stores' => [0],
                'content' => $content,
                'content_heading' => 'Content Heading',
                'meta_keywords' => 'Meta keywords',
                'meta_description' => 'meta description'
            ];

            $page = $this->pageFactory->create()->load($pageData['identifier']);

            if (!$page->getId()) {
                $page->setData($pageData)->save();
            } else {
                $page->setData('content', $pageData['content'])->save();
            }
        }

        $setup->endSetup();
    }
}