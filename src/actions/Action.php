<?php

namespace codexten\yii\omnipay\actions;

use codexten\yii\omnipay\components\Omnipay;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\web\Session;

abstract class Action extends \yii\base\Action
{
    /**
     * @var Omnipay|string
     */
    public $omnipay = 'omnipay';

    /**
     * @var Session|string
     */
    public $session = 'session';
    /**
     * @var string
     */
    public $sessionPrefix = 'omnipay';

    /**
     * @throws InvalidConfigException
     * @inheritDoc
     */
    public function init()
    {
        $this->omnipay = Instance::ensure($this->omnipay, Omnipay::class);
        $this->session = Instance::ensure($this->session, Session::class);
        parent::init();
    }

    /**
     * Adds a session variable.
     * If the specified name already exists, the old value will be overwritten.
     *
     * @param string $key session variable name
     * @param mixed $value session variable value
     */
    public function setSession($key, $value)
    {
        return $this->session->set("{$this->sessionPrefix}.{$key}", $value);
    }

    public function getSession($key, $defaultValue = null)
    {
        return $this->session->get("{$this->sessionPrefix}.{$key}", $defaultValue);
    }

}
