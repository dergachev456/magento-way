<?php


namespace Ifuel\Setup\Setup\Patch\Data;


use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class Homepage implements DataPatchInterface {
    protected $_pageFactory;
    protected $_dataSetup;
    protected $_blockFactory;

    public function __construct(
        PageFactory $pageFactory,
        BlockFactory $blockFactory,
        ModuleDataSetupInterface $moduleDataSetup) {

        $this->_pageFactory = $pageFactory;
        $this->_blockFactory = $blockFactory;
        $this->_dataSetup = $moduleDataSetup;
    }
    public function apply() {
        $homepageHtml = '<div class="homepage">
                            {{block class="Magento\\Cms\\Block\\Block" block_id="hp-banner"}}
                            {{block class="Magento\\Cms\\Block\\Block" block_id="hp-how"}}
                            {{block class="Magento\\Cms\\Block\\Block" block_id="hp-features"}}
                            {{block class="Magento\\Cms\\Block\\Block" block_id="hp-loveit"}}
                            {{block class="Magento\\Cms\\Block\\Block" block_id="hp-footer-features"}}
                        </div>';
        $blockBanner = '<div class="homepage-banner full-screen">
                        <div class="banner-content">
                        <h1 class="banner-header">New York City’s cloth diaper service.</h1>
                        <a class="action primary" href="#">Sign Up</a></div>
                        </div>';
        $blockHow = '<div class="how-it-works"><a class="action primary support" href="#">Support</a>
                    <h2 class="hw-header">How it works</h2>
                    <p class="hw-content">We’re here to provide you with a weekly supply of unbleached cotton diapers that we launder using an EPA-certified plant-derived detergent. So that, in the process, we leave the smallest eco-footprint possible. If you’d like to cloth diaper but find the prospect to be overwhelming, then consider us your one-stop low-fuss solution!</p>
                    <div class="hw-services">
                    <div class="hw-service"><img class="frequency" src="{{view url="images/homepage/diaper.svg"}}" alt="">
                    <h3>Choose your size and frequency</h3>
                    <p>Change or cancel anytime</p>
                    </div>
                    <div class="hw-service"><img class="order" src="{{view url="images/homepage/box.svg"}}" alt="">
                    <h3>Receive your first order in 7-10 days</h3>
                    </div>
                    <div class="hw-service"><img class="pickup" src="{{view url="images/homepage/can.svg"}}" alt="">
                    <h3>Leave used diapers for pickup</h3>
                    </div>
                    <div class="hw-service"><img class="sanitized" src="{{view url="images/homepage/towels.svg"}}" alt="">
                    <h3>Clean sanitized diapers will be delivered to your door</h3>
                    </div>
                    </div>
                    <a class="action primary" href="#">Get Started</a></div>';
        $blockFeatures = '<div class="features">
                    <div class="feature first full-screen">
                    <div class="feature-content">
                    <div class="part left">
                    <div class="description"><img class="feature-icon" src="{{view url="images/homepage/feature-icon.svg"}}" alt="">
                    <h2>Our unbleached cotton fitted diaper</h2>
                    <p class="item-description">Made of multiple absorbent layers of super soft unbleached birdseye cotton. It is contour shaped so it goes on your baby with no folding required. This convenient diaper is soft, trim, and fits great. With the addition of super soft and stretchy elastic around the legs, this fitted does a bang-up job at preventing leaks and blowouts.</p>
                    </div>
                    </div>
                    <div class="feature-img"><img src="{{view url="images/homepage/feature-img1.png"}}" alt=""></div>
                    </div>
                    </div>
                    <div class="feature second full-screen">
                    <div class="feature-content">
                    <div class="feature-img"><img src="{{view url="images/homepage/feature-img2.png"}}" alt=""></div>
                    <div class="part right">
                    <div class="description"><img class="feature-icon" src="{{view url="images/homepage/feature-icon.svg"}}" alt="">
                    <h2>Our organic cotton prefold diapers</h2>
                    <p class="item-description">Our Organic Cotton Prefolds are made of 100% certified organic cotton twill. Woven with luxurious Pakistani cotton, they are wonderfully thick and thirsty (they’re 4-ply along each side and 8-ply down the center). The cotton for these diapers is grown and harvested according to GOTA (Global Organic Textile Standards) under the EKO Sustainable Textile Scheme.</p>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="features-banner full-screen">
                    <div class="banner-content">
                    <h2 class="banner-header">Find out everything you need to know about cloth diapering at one of our monthly classes held around the city.</h2>
                    <a class="action primary" href="#">Learn More</a></div>
                    </div>
                    </div>';
        $blockLoveit = '<div class="love-it">
                    <h2>Why you’ll love it</h2>
                    <div class="reasons">
                    <div class="reson-item"><img src="{{view url="images/homepage/washmachine.svg"}}" alt="">
                    <h3>We do the dirty work</h3>
                    <p>We know you’ve got your hands full so let us do the pickup, washing, folding, and delivery of your cloth diapers.</p>
                    </div>
                    <div class="reson-item"><img src="{{view url="images/homepage/baby.svg"}}" alt="">
                    <h3>Better for Baby</h3>
                    <p>We use only a plant-derived detergent certified by the EPA. All diapers are fully cleaned, sanitized, pH balanced, and rinsed at extremely high temperatures in commercial washer/extractors so the no soap or residue remains that could irritate your baby’s skin.</p>
                    </div>
                    <div class="reson-item"><img src="{{view url="images/homepage/leaves.svg"}}" alt="">
                    <h3>good for the planet</h3>
                    <p>A baby can go through up to 6,000 disposable diapers before becoming potty trained! In most cases, disposable diapers won’t compost or biodegrade in a landfill which makes cloth so much better for the environment.</p>
                    </div>
                    </div>
                    <a class="action primary" href="#">More about cloth diapering</a></div>';
        $footerFeatures = '<div class="features footer">
                    <div class="feature first">
                    <div class="feature-content">
                    <div class="part right">
                    <div class="description">
                    <h2>Diaper Starter Kit</h2>
                    <p class="item-description">Wipe, soothe and protect with our organic skincare line made from natural uncomplicated ingredients.</p>
                    <a class="action primary" href="#">Shop Now</a></div>
                    </div>
                    <div class="feature-image"><img src="{{view url="images/homepage/footer-f1.jpg"}}" alt=""></div>
                    </div>
                    </div>
                    <div class="feature second">
                    <div class="feature-content">
                    <div class="feature-image"><img src="{{view url="images/homepage/footer-f2.jpg"}}" alt=""></div>
                    <div class="part left">
                    <div class="description">
                    <h2>We’ve got you covered</h2>
                    <p class="item-description">We also have adorable waterproof cloth diaper covers that layers over our soft and thirsty Inner to make one blowout-proof diaper.</p>
                    <a class="action primary" href="#">Shop diaper covers</a></div>
                    </div>
                    </div>
                    </div>
                    </div>';
        $homepage = [
            'title' => 'Home page',
            'identifier' => 'home',
            'is_active' => 1,
            'page_layout' => '1column',
            'stores' => [0],
            'content' => $homepageHtml,
            'content_heading' => ''
        ];

        $banner = [
            'title' => 'Homepage top banner',
            'identifier' => 'hp-banner',
            'content' => $blockBanner,
        ];

        $how = [
            'title' => 'Homepage how it works',
            'identifier' => 'hp-how',
            'content' => $blockHow,
        ];

        $features = [
            'title' => 'Homepage features',
            'identifier' => 'hp-features',
            'content' => $blockFeatures,
        ];

        $loveit = [
            'title' => 'Homepage love it',
            'identifier' => 'hp-loveit',
            'content' => $blockLoveit,
        ];

        $featuresFut = [
            'title' => 'Homepage footer Features',
            'identifier' => 'hp-footer-features',
            'content' => $footerFeatures,
        ];

        $applyBlocks = [$banner, $how, $features, $loveit, $featuresFut];
        $applyPages = [$homepage];

        $this->_dataSetup->getConnection()->startSetup();

        try {

            $this->createPage($applyPages);
            $this->createBlock($applyBlocks);

        } catch (\Exception $e) {
            throw $e;
        }

        $this->_dataSetup->getConnection()->endSetup();
    }

    public function createBlock($dataArray) {
        $config = [
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        foreach ($dataArray as $blockData) {
            $block = $this->_blockFactory->create()->load($blockData['identifier']);
            if (!$block->getId()) {
                $block->setData(array_merge($config, $blockData))->save();
            } else {
                $block->setData('content', $blockData['content'])->save();
            }
        }
    }

    public function createPage($dataArray) {
        foreach ($dataArray as $pageData) {
            $page = $this->_pageFactory->create()->load($pageData['identifier']);
            if (!$page->getId()) {
                $page->setData($pageData)->save();
            } else {
                $page->setData('content', $pageData['content'])->save();
            }
        }
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
