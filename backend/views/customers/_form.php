<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Location;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>


    <?=
    $form->field($model, 'zipcode')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Location::find()->all(), 'location_id', 'zipcode'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a zipcode', 'id' => 'zipcode'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ]);
    ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
        $('#zipcode').change(function(){
          var zipId = $(this).val();          
          $.get('../location/get-city-province',{ zipId : zipId},function(data){          
          var data = $.parseJSON(data);
         // alert(data.city);
          $('#customers-city').attr('value' , data.city);
          $('#customers-province').attr('value', data.province);
 });       
        
        });
        

JS;
$this->registerJs($script);
?>