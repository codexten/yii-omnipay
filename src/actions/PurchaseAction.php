<?php

namespace codexten\yii\omnipay\actions;

use codexten\yii\omnipay\forms\PurchaseForm;
use yii\base\Action;

class PurchaseAction extends Action
{
    public function ru()
    {
        $model = new PurchaseForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

        }
    }
}
