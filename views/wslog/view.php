<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Rahmansoft\Apirestlog\models\ApiLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Api Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-log-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ipclient',
            'app_name',
            'ws_type',
            'request:ntext',
            'response:ntext',
            'createdon',
            'createdby',
        ],
    ]) ?>

</div>
