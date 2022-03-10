<?php

declare(strict_types=1);

namespace Elogic\WeatherInfo\Controller\Adminhtml\Archive;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Weather Info'), __('Weather Archive'));
        $resultPage->getConfig()->getTitle()->prepend(__('Weather Archive'));

        return $resultPage;
    }

    /**
     * Check permission via ACL resource
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Elogic_WeatherInfo::weatherarchive');
    }
}
