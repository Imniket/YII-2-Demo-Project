<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => '']) ?>
    <?=
    $form->field($model, 'company_started_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Select Date'],
        'pluginOptions' => [
           // 'startDate' => $modelUser->packageStartDate,
            //'endDate' => $modelUser->packageEndDate,
            'orientation' => 'bottom top',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => false,
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
