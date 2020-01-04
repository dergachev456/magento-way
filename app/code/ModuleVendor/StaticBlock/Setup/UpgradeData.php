<?php

namespace ModuleVendor\StaticBlock\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\BlockFactory;

class UpgradeData implements UpgradeDataInterface {

    protected $_blockFactory;

    public function __construct(BlockFactory $blockFactory)
    {
        $this->_blockFactory = $blockFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.1', '<')) {
            $this->createBlock();
        }
        $setup->endSetup();
    }

    public function createBlock() {
        $content = '<h1>CMS Static Block</h1>';
        $data = [
            'title' => 'New CMS Block',
            'identifier' => 'store_cms_block',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $block = $this->_blockFactory->create()->load($data['identifier']);

        if (!$block->getId()) {
            $block->setData($data)->save();
        } else {
            $block->setData('content', $content)->save();
        }
    }
}