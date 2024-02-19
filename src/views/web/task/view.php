<?php

use yii\helpers\Html;
use portalium\theme\widgets\DetailView;
use portalium\todo\models\Task;
use portalium\content\Module;
use portalium\theme\widgets\Panel;

/** @var yii\web\View $this */
/** @var portalium\todo\models\Task $model */

// breadcrumb-> kullanıcılara web uyg.'larında gezinti yaparken bulundukları konumu gösteren bir navigasyon öğesidir.
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//  \yii\web\YiiAsset::register($this) --> Yii'nin sağladığı temel javascript ve css dosyalarını sayfaya ekler.
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_task' => $model->id_task], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_task' => $model->id_task], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_task',
            'title',
            'description',
            'status',
            'id_user',
            'id_workspace',
            'date_create',
            'date_update',
        ],
    ]) ?>

</div>
