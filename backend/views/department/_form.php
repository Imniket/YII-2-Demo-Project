<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Branches;
use backend\models\companies;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

<?php $form = ActiveForm::begin(); ?>



    <?=
    $form->field($model, 'department_company_id')->dropDownList(
            ArrayHelper::map(companies::find()->all(), 'company_id', 'company_name'), ['prompt' => 'Select Company',
        'onchange' => '
                $.post("../branches/branch?id="+$(this).val(), function( data ) {
                  $( "select#department-department_branch_id" ).html( data );
                });'
    ]);
    ?>

    <?=
    $form->field($model, 'department_branch_id')->dropDownList(
            ArrayHelper::map(branches::find()->all(), 'branch_id', 'branch_name'), ['prompt' => 'Select Baranch',
    ]);
    ?>       


    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'department_address')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'department_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ]) ?>


    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
