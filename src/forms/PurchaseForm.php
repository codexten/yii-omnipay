<?php

namespace codexten\yii\omnipay\forms;

use yii\base\Model;

/**
 * Class PurchaseForm
 *
 * @package codexten\yii\omnipay\forms
 *
 * @property array $purchaseData
 *
 * @property float $amount
 * @property string $order_id
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_email
 * @property string $return_url
 * @property string $notify_url
 *
 */
class PurchaseForm extends Model
{
    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [
                [
                    'amount',
                    'order_id',
                    'customer_name',
                    'customer_phone',
                    'customer_email',
                    'return_url',
                    'notify_url',
                ],
                'required',
            ],
        ];
    }

    public function getPurchaseData()
    {
        return [
            'amount' => $this->amount,
            'orderId' => $this->order_id,
            'customerName' => $this->customer_name,
            'customerPhone' => $this->customer_phone,
            'customerEmail' => $this->customer_email,
            'returnUrl' => $this->return_url,
            'notifyUrl' => $this->notify_url,
        ];
    }

}
