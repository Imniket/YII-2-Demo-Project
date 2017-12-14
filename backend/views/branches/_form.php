<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\companies;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?=
    $form->field($model, 'branch_company_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(companies::find()->all(), 'company_id', 'company_name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Company ...'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => 'select status']) ?>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
<?php 
$script =<<< JS
$('form#{$model->formName()}').on('beforeSubmit',function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"), 
        \$form.serialize()
    )
    .done(function(result){
     if(result == 1)
       {
            $(\$form).trigger("reset");
            $.pjax.reload({container: #branchesGrid});
        }else{
            
           $("#message").html(result);
        }
    }).fail(function(){
        console.log("server error");
    });
    return false;
});

JS;
$this->registerJs($script);

?>