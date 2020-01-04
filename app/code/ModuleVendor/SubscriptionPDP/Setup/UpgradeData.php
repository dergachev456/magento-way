<?php

namespace ModuleVendor\SubscriptionPDP\Setup;

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
            $content = '
            <div class="subscription">
  <div class="subscription-prod-details">
    <div class="subscription-img">
      <div class="prod-img">
        <div class="img-wrapper">
          <img src="{{view url=images/magazine.png}}" alt="Magazine title page">
        </div>
      </div>
    </div>
    <div class="prod-short-discr">
      <div class="short-discr-content">
        <h1 class="page-title">Prevention</h1>
        <form class="prod-addtocart-form">         
          <p class="period">2 years subscription</p>
          <label class="container">
            <input type="radio" id="2year" name="radio"/>
            <span class="checkmark"></span>
            <span class="subscribe-price">$20.00</span><span class="val-description"> Best Value!</span>
          </label>
          <p class="period">1 year subscription w/ auto reneval</p>
          <label class="container">
            <input type="radio" id="1reneval" name="radio"/>
            <span class="checkmark"></span>
            <span class="subscribe-price">$12.00</span><span class="val-description"> 78% off the newsstand price</span>
          </label>          
          <p class="period">1 year subscription</p>
          <label class="container">
            <input type="radio" id="withdisc" name="radio"/>
            <span class="checkmark"></span>
            <span class="subscribe-price">$12.00</span><span class="val-description"> 73% off the newsstand price</span>
          </label>
          <div class="box-tocart">
              <div class="actions">
                <button 
                        type="submit" 
                        title="Add to Cart" 
                        class="action primary tocart" 
                        id="product-addtocart-button">
                  <span>Add to Cart</span>                  
                </button>
            </div>
          </div>
        </form>
        <div class="cs-program">
          <p class="cs-description">
            <strong>Continuouse Service Program</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
        nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
        qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="subscription-prod-bundles">
    <h3>Esquire Bundles</h3>
     <div class="bundles-list">
       <div class="bundle-item">
         <div class="bundle-thumbnail">
           <img src="{{view url=images/thumb1.jpg}}" alt="thumbnail">
         </div>
         <h4 class="item-header">Esquire + BicyLing + Runner\'s World</h4>
         <p class=\'item-description\'>1 year subscription</p>
         <div class="price-section">
           <p class="item-price">$20</p>
           <p class="price-description">Save 80%!</p>
         </div>
         <div class="box-tocart">
              <div class="actions">
                <button 
                        type="submit" 
                        title="Add to Cart" 
                        class="addto-cart">
                  <span>Add to Cart</span>                  
                </button>
            </div>
          </div>
       </div>
       <div class="bundle-item">
         <div class="bundle-thumbnail">
           <img src="{{view url=images/thumb2.jpg}}" alt="thumbnail">
         </div>
         <h4 class="item-header">Esquire + Men\'s Health</h4>
         <p class=\'item-description\'>1 year subscription</p>
         <div class="price-section">
           <p class="item-price">$20</p>
           <p class="price-description">Save 80%!</p>
         </div>
         <div class="box-tocart">
              <div class="actions">
                <button 
                        type="submit" 
                        title="Add to Cart" 
                        class="addto-cart">
                  <span>Add to Cart</span>                  
                </button>
            </div>
          </div>
       </div>
       <div class="bundle-item">
         <div class="bundle-thumbnail">
           <img src="{{view url=images/thumb3.jpg}}" alt="thumbnail">
         </div>
         <h4 class="item-header">Esquire + Car and Driver + Road & Track</h4>
         <p class=\'item-description\'>1 year subscription</p>
         <div class="price-section">
           <p class="item-price">$20</p>
           <p class="price-description">Save 80%!</p>
         </div>
         <div class="box-tocart">
              <div class="actions">
                <button 
                        type="submit" 
                        title="Add to Cart" 
                        class="addto-cart">
                  <span>Add to Cart</span>                  
                </button>
            </div>
          </div>
       </div>
       <div class="bundle-item">
         <div class="bundle-thumbnail">
           <img src="{{view url=images/thumb4.jpg}}" alt="thumbnail">
         </div>
         <h4 class="item-header">Esquire + Popular Mechanics</h4>
         <p class=\'item-description\'>1 year subscription</p>
         <div class="price-section">
           <p class="item-price">$20</p>
           <p class="price-description">Save 80%!</p>
         </div>
         <div class="box-tocart">
              <div class="actions">
                <button 
                        type="submit" 
                        title="Add to Cart" 
                        class="addto-cart">
                  <span>Add to Cart</span>                  
                </button>
            </div>
          </div>
       </div>
     </div>
  </div>
</div>
            ';
            $pageData = [
                'title' => 'Subscription',
                'identifier' => 'subscription-pdp',
                'is_active' => 1,
                'page_layout' => '1column',
                'stores' => [0],
                'content' => $content
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