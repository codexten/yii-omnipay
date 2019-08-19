<?php

namespace codexten\yii\omnipay\actions;

use codexten\yii\omnipay\components\Omnipay;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\di\Instance;

class PurchaseAction extends Action
{
    /**
     * @var Omnipay
     */
    public $omnipay = 'omnipay';
    public $purchaseData;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!is_callable($this->purchaseData)) {
            throw new InvalidConfigException('Invalid purchase Data');
        }
        $this->omnipay = Instance::ensure($this->omnipay, Omnipay::class);
        parent::init();
    }

    public function run()
    {
        $purchaseData = call_user_func($this->purchaseData);

        $response = $this->omnipay->purchase($purchaseData)->send();
        if ($response->isRedirect()) {
            $response->redirect();
        } elseif ($response->isSuccessful()) {
            print_r($response);
        } else {
            echo $response->getMessage();
        }
    }

//    public function ru()
//    {
//        $model = new PurchaseForm();
//
//        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
//
//            echo '<pre>';
//            var_dump($model->getPurchaseData());
//            echo '</pre>';
//            exit;
//
//            $response = $this->omnipay->purchase($model->getPurchaseData())->send();
//
//            if ($response->isRedirect()) {
//                $response->redirect();
//            } elseif ($response->isSuccessful()) {
//                print_r($response);
//            } else {
//                echo $response->getMessage();
//            }
//        }
//    }

}
