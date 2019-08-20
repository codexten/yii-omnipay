<?php

namespace codexten\yii\omnipay\actions;

use Omnipay\Cashfree\Message\CompletePurchaseResponse;
use Yii;
use yii\base\InvalidConfigException;

/**
 *
 * @property mixed $sessionData
 */
class CompletePurchaseAction extends Action
{
    public $onCompleted;
    public $onFailed;

    public function init()
    {
        Yii::$app->controller->enableCsrfValidation = false;

        if (!is_callable($this->onCompleted)) {
            throw new InvalidConfigException('Invalid purchase');
        }

        if (!is_callable($this->onCompleted)) {
            throw new InvalidConfigException('Invalid purchase');
        }

        parent::init();
    }

    public function run()
    {
        $purchaseData = $this->getSession('purchaseData');

        /* @var $response CompletePurchaseResponse */
        $response = $this->omnipay->completePurchase($purchaseData)->send();

        if ($response->getTransactionStatus() == CompletePurchaseResponse::STATUS_COMPLETED) {
            return call_user_func($this->onCompleted);
        }

        return call_user_func($this->onFailed);
    }

    public function getSessionData()
    {
        return $this->getSession('sessionData');
    }
}
