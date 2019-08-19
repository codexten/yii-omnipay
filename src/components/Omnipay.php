<?php

namespace codexten\yii\omnipay\components;

use Omnipay\Common\GatewayInterface;
use Omnipay\Common\Message\RequestInterface;
use yii\base\Component;
use Omnipay\Omnipay as OP;

class Omnipay extends Component
{
    public $defaultGateway = '';

    public $name;
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
        echo '<pre>';
        var_dump($this->name);
        echo '</pre>';
        exit;
        $this->_gateway = OP::create($this->name);
        if ($this->testMode) {
            $this->parameters['testMode'] = $this->testMode;
        }
        if ($this->currency) {
            $this->parameters['currency'] = $this->currency;
        }
        $this->_gateway->initialize($this->parameters);
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
