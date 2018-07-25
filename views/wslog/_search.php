<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ApiLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="api-log-search">

    <div class="row">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <div class="col-md-6">
            <?= $form->field($model, 'ipclient') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'app_name') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ws_type') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'request') ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'response') ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'createdon') ?>
        </div>


        <?php // echo $form->field($model, 'createdby') ?>


    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
