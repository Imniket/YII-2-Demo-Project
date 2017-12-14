<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?= Html::button('Create Company', ['value'=>  yii\helpers\Url::to('../companies/create'),'class' => 'btn btn-success', 'id' => 'modalButton' ]) ?>
    </p>
    <?php
    Modal::begin([
        'header' => '<h4>Companies</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
            if($model->company_status == 'inactive'){
              return['class' => 'danger'];
            }elseif ($model->company_status == 'active') {
              return['class' => 'success'];
          }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'company_id',
            'company_name',
            'company_email:email',
            'company_address:ntext',
            //'company_logo',
            //'company_status',
            //'company_started_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
