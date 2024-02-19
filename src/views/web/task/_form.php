<?php

use yii\helpers\Html;
use portalium\theme\widgets\ActiveForm;
use portalium\todo\models\Task;
use portalium\theme\widgets\Panel;
use portalium\content\Module;
/** @var yii\web\View $this */
/** @var portalium\todo\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php Panel::begin([
        'title' => Html::encode($this->title),
        'actions' => [
            'header' => [
            ],
            'footer' => [
                Html::submitButton(Module::t( 'Save'), ['class' => 'btn btn-success']),
            ]
        ],
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Task::getStatusList()['STATUS']) ?>



    <?php Panel::end() ?>

    <?php ActiveForm::end(); ?>

</div>