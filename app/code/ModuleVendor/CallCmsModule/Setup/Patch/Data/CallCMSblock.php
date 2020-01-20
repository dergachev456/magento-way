<?php

namespace ModuleVendor\CallCmsModule\Setup\Patch\Data;

use \Magento\Cms\Model\BlockFactory;
use \Magento\Framework\Setup\Patch\DataPatchInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

class CallCMSblock implements DataPatchInterface

{
    protected $blockFactory;

    protected $moduleDataSetup;

    public function __construct(
        BlockFactory $blockFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->blockFactory = $blockFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply() {

        $html = '<a href="#">Cms block</a>';
        $data = [
            'title' => 'Call ways for cms block',
            'identifier' => 'call_cms',
            'content' => $html,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $applyData = [$data];

        $this->moduleDataSetup->getConnection()->startSetup();
        try {
            $this->createBlock($applyData);
        } catch (\Exception $e) {
            throw $e;
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function createBlock($dataArray) {
        foreach ($dataArray as $blockData) {
            $block = $this->blockFactory->create()->load($blockData['identifier']);
            if (!$block->getId()) {
                $block->setData($blockData)->save();
            } else {
                $block->setData('content', $blockData['content'])->save();
            }
        }
    }

    public function revert() {}

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}