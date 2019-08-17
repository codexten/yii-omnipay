<?php

namespace codexten\yii\omnipay\components;

use yii\base\Component;

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
        $this->_gateway = \Omnipay\Omnipay::create($this->name);
        if ($this->testMode) {
            $this->parameters['testMode'] = $this->testMode;
        }
        if ($this->currency) {
            $this->parameters['currency'] = $this->currency;
        }
        $this->_gateway->initialize($this->parameters);
    }

    public function getGateway()
    {
        return $this->_gateway;
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
