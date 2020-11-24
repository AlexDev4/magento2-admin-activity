<?php
/**
 * Catgento
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 *
 * @category   Catgento
 * @package    Catgento_AdminActivity
 * @copyright  Copyright (C) 2018 Kiwi Commerce Ltd (https://kiwicommerce.co.uk/)
 * @license    https://kiwicommerce.co.uk/magento2-extension-license/
 */
namespace Catgento\AdminActivity\Model;

use \Catgento\AdminActivity\Helper\TrackField as Helper;
use \Magento\Framework\App\Request\Http;
use \Magento\Framework\UrlInterface;

/**
 * Class Handler
 * @package Catgento\AdminActivity\Model
 */
class Handler
{
    /**
     * @var Helper
     */
    public $helper;

    /**
     * @var \Magento\Framework\HTTP\Header
     */
    public $header;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    public $request;

    /**
     * @var UrlInterface
     */
    public $urlInterface;

    /**
     * @var ActivityLogFactory
     */
    public $activityLogFactory;

    /**
     * Handler constructor.
     * @param Helper $helper
     * @param \Magento\Framework\HTTP\Header $header
     * @param Http $request
     * @param UrlInterface $urlInterface
     * @param ActivityLogFactory $activityLogFactory
     */
    public function __construct(
        Helper $helper,
        \Magento\Framework\HTTP\Header $header,
        Http $request,
        UrlInterface $urlInterface,
        \Catgento\AdminActivity\Model\ActivityLogFactory $activityLogFactory
    ) {
        $this->helper = $helper;
        $this->header = $header;
        $this->request = $request;
        $this->urlInterface = $urlInterface;
        $this->activityLogFactory = $activityLogFactory;
    }

    /**
     * Set log data
     * @param $logs
     * @return mixed
     */
    public function __initLog($logs)
    {
        if (!empty($logs)) {
            foreach ($logs as $field => $value) {
                $log = $this->activityLogFactory->create()->setData($value);
                $log->setFieldName($field);
                $logs[$field] = $log;
            }
        }
        return $logs;
    }

    /**
     * Get add activity log data
     * @param $model
     * @param $method
     * @return mixed
     */
    public function modelAdd($model, $method)
    {
        return $this->__initLog(
            $this->helper->getAddData($model, $method)
        );
    }

    /**
     * Get edit activity log data
     * @param $model
     * @param $method
     * @return mixed
     */
    public function modelEdit($model, $method)
    {
        return $this->__initLog(
            $this->helper->getEditData($model, $method)
        );
    }

    /**
     * Get delete activity log data
     * @param $model
     * @param $method
     * @return mixed
     */
    public function modelDelete($model, $method)
    {
        return $this->__initLog(
            $this->helper->getDeleteData($model, $method)
        );
    }
}
