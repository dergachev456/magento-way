<?php

namespace Ifuel\ProductGallery\Plugin;

class OriginalUrl
{

    const IMAGE_PATH_SEGMENT = 'catalog/product';

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->_storeManager = $storeManager;
    }

    public function afterGetGalleryImagesJson(\Magento\Catalog\Block\Product\View\Gallery $subject, $result)
    {
        $images = json_decode($result, true);
        $re = '/\/.\/.\/(.*)$/m';

        foreach ($images as $key => $value) {
            preg_match_all($re, $value['img'], $matches, PREG_SET_ORDER, 0);
            $images[$key]['direct'] = $value['img'];
            if (isset($matches[0][0])) {
                $images[$key]['direct'] = $this->_storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . self::IMAGE_PATH_SEGMENT . $matches[0][0];
            }
        }

        return json_encode($images);
    }
}