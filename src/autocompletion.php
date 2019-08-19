<?php

use yii\BaseYii;
use codexten\yii\omnipay\components\Omnipay;

/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 * Note: To avoid "Multiple Implementations" PHPStorm warning and make autocomplete faster
 * exclude or "Mark as Plain Text" vendor/yiisoft/yii2/Yii.php file
 */
class Yii extends BaseYii
{
    /**
     * @var BaseApplication
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property Omnipay $omnipay
 */
abstract class BaseApplication extends yii\base\Application
{
}
