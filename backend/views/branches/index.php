<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\branchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::button('Create Branches', ['value' => yii\helpers\Url::to('../branches/create'), 'class' => 'btn btn-success modalButton', 'id' => 'modalButton']) ?>
    </p>

    <?php
    Modal::begin([
        'header' => '<h4>Branches</h4>',
        'id' => 'modal',
        
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
    <?php Pjax::begin(['id' => 'branchesGrid']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
          if ($model->branch_status == 'inactive') {

            return ['class' => 'danger'];
          } elseif ($model->branch_status == 'active') {

            return ['class' => 'success'];
          }
        },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'branch_company_id',
                        'value' => 'branchcompany.company_name'
                    ],
                    //'branch_id',
                    'branch_name',
                    'branch_address',
                    'branch_status',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{download} {view} {update} {delete}',
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end(); ?>
</div>
