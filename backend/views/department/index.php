<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\departmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <?= Html::button('New Department', ['value'=>  yii\helpers\Url::to('../department/create'),'class' => 'btn btn-success', 'id' => 'modalButton' ]) ?>
  
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
          if ($model->department_status == 'inactive') {

            return ['class' => 'danger'];
          } elseif ($model->department_status == 'active') {
            return['class' => 'success'];
          }
        },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'department_company_id',
                        'value' => 'departmentcompany.company_name'
                    ],
                    [
                        'attribute' => 'department_branch_id',
                        'value' => 'departmentbranch.branch_name'
                    ],
                    //'department_id',
                    'department_name',
                    'department_address',
                    //'department_status',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
</div>
