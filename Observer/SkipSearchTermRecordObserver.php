<?php
// File: app/code/Hgati/SkipSearchTerm/Observer/SkipSearchTermRecordObserver.php
namespace Hgati\SkipSearchTerm\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\CatalogSearch\Model\Query;

class SkipSearchTermRecordObserver implements ObserverInterface
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        $isAjax = $this->request->isAjax();
        $queryText = $this->request->getParam('q');

        if ($isAjax && $queryText) {
            $query = $observer->getEvent()->getDataObject();
            if ($query instanceof Query) {
                $query->setIsProcessed(true);
            }
        }
    }
}
