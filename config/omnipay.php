<?php

use codexten\yii\omnipay\components\Omnipay;

/* @var $params array */
return [
    'components' => [
        'omnipay' => [
            'class' => Omnipay::class,
            'defaultGateway' => $params['omnipay.defaultGateway'],
            'currency' => $params['omnipay.currency'],
            'testMode' => $params['omnipay.testMode'],
        ],
    ],
];
