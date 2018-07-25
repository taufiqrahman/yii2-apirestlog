<?php

namespace rahmansoft\apirestlog;

/**
 * kontrak module definition class
 */
use yii;

class Module extends \yii\base\Module

{
    /**
     * @inheritdoc
     */
    public $defaultRoute = 'wslog';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('@wslog', $this->getBasePath());
    }

}

