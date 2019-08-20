<?php

namespace codexten\yii\omnipay\actions;

use yii\base\InvalidConfigException;

class PurchaseAction extends Action
{
    public $purchaseData;
    public $sessionData;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!is_callable($this->purchaseData)) {
            throw new InvalidConfigException('Invalid purchase Data');
        }
        parent::init();
    }

    public function run()
    {
        $purchaseData = call_user_func($this->purchaseData);
        $this->setSession('purchaseData', $purchaseData);

        if (!empty($this->sessionData) && is_callable($this->sessionData)) {
            $sessionData = call_user_func($this->sessionData);

            $this->setSession('sessionData', $sessionData);
        }

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
