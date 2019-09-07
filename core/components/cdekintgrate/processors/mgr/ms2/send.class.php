<?php

class sendCdekProcessor extends modProcessor
{
    /** @var cdekIntgrate $cdekClass */
    public $cdekClass;
    /** @var miniShop2 $ms2 */
    public $ms2;
    public $order_id;
    /** @var msOrder $msOrder */
    public $msOrder;

    public function initialize()
    {
        $this->cdekClass = $this->modx->getService('cdekIntgrate', 'cdekIntgrate', MODX_CORE_PATH . 'components/cdekintgrate/model/', []);
        $this->ms2 = $this->modx->getService('miniShop2');
        return parent::initialize();
    }

    public function process()
    {
        if (!$this->order_id = $this->getProperty('order_id')) {
            return $this->failure('Не передан id заказа');
        }
        if (!$this->msOrder = $this->modx->getObject('msOrder', $this->order_id)) {
            return $this->failure('Не получен заказ');
        }

        $cdekOrder = $this->cdekClass->createCdekOrder($this->msOrder);
        return $this->success('Заказ успешно создан в личном кабинете сдэк', $cdekOrder);
    }

}

return 'sendCdekProcessor';