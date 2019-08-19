<?php

namespace codexten\yii\omnipay\actions;

use codexten\yii\omnipay\components\Omnipay;
use codexten\yii\omnipay\forms\PurchaseForm;
use yii\base\Action;
use yii\di\Instance;

class PurchaseAction extends Action
{
    /**
     * @var Omnipay
     */
    public $omnipay = 'omnipay';

    public function init()
    {
        $this->omnipay = Instance::ensure($this->omnipay, Omnipay::class);
        parent::init();
    }

    public function ru()
    {
        $model = new PurchaseForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $response = $this->omnipay->purchase($model->getPurchaseData())->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } elseif ($response->isSuccessful()) {
                print_r($response);
            } else {
                echo $response->getMessage();
            }
        }
    }
}
