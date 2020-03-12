<?php

namespace BoolXY\Trendyol\Builders;

use BoolXY\Trendyol\Abstracts\AbstractRequestBuilder;
use BoolXY\Trendyol\Interfaces\IRequestBuilder;
use BoolXY\Trendyol\RequestManager;
use BoolXY\Trendyol\Requests\OrderService\SplitShipmentPackageByQuantity;

class SplitShipmentPackageByQuantityRequestBuilder extends AbstractRequestBuilder implements IRequestBuilder
{
    /**
     * SplitShipmentPackagesRequestBuilder constructor.
     *
     * @param RequestManager $requestManager
     */
    public function __construct(RequestManager $requestManager)
    {
        parent::__construct($requestManager);

        $this->setRequest(SplitShipmentPackageByQuantity::create([
            'supplierId' => $this->requestManager->getClient()->getSupplierId(),
        ]));
    }

    /**
     * @param int $shipmentPackageId
     *
     * @return $this
     */
    public function setShipmentPackageId(int $shipmentPackageId): self
    {
        $this->request->addQueryParam('shipmentPackageId', $shipmentPackageId);

        return $this;
    }

    /**
     * @param int   $orderLineId
     * @param array $quantities
     *
     * @return $this
     */
    public function addQuantitySplit(int $orderLineId, array $quantities): self
    {
        $this->request->addData('quantitySplit', [
            'orderLineId' => $orderLineId,
            'quantities'  => $quantities,
        ], true);

        return $this;
    }

    /**
     * @return mixed
     */
    public function split()
    {
        return $this->process();
    }
}
