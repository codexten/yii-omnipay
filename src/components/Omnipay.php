<?php

namespace codexten\yii\omnipay\components;

use codexten\yii\helpers\ArrayHelper;
use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Message\RequestInterface;
use yii\base\Component;
use Omnipay\Omnipay as OP;

class Omnipay extends Component
{
    public $defaultGateway = '';
    public $gateways = [];

    public $testMode = null;
    public $currency = null;
    public $parameters = [];
    private $_gateway;

    public function init()
    {
        $this->prepareGateway();
    }

    public function prepareGateway()
    {
        $gateway = $this->gateways[$this->defaultGateway];

        $this->_gateway = OP::create($gateway['driverName']);
        $parameters = [
            'testMode' => $this->testMode,
            'currency' => $this->currency,
        ];
        $parameters = ArrayHelper::merge($parameters, ArrayHelper::getValue($gateway, 'parameters', []));

//        if ($this->testMode) {
//            $this->parameters['testMode'] = $this->testMode;
//        }
//        if ($this->currency) {
//            $this->parameters['currency'] = $this->currency;
//        }

        $this->_gateway->initialize($parameters);
    }

    /**
     * @return GatewayInterface
     */
    public function getGateway()
    {
        return $this->_gateway;
    }

    /**
     * @param $data
     *
     * @return RequestInterface
     */
    public function purchase($data)
    {
        return $this->getGateway()->purchase($data);
    }

    /**
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->getGateway(), $method], $parameters);
    }

}
