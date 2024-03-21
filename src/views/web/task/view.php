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

   
<?php Panel::begin([
        'title' => $this->title,
        'actions' => [
            Html::a(Module::t(''), ['update', 'id' => $model->id_task], ['class' => 'btn btn-primary fa fa-pencil']),
            Html::a(Module::t(''), ['delete', 'id' => $model->id_task], [
                'class' => 'btn btn-danger fa fa-trash',
                'data' => [
                    'confirm' => Module::t('Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
        ]
    ]) ?>
    <?= DetailView::widget([

        'model' => $model,
        'attributes' => [
            'id_task',
            'title',
         //   'description',
            [
                'attribute' => 'status',
                'value' => Task::getStatusList()['STATUS'][$model->status],
            ],
           // 'id_workspace',
            'date_create',
            'date_update',
        ],
    ]); Panel::end() ?>
</div>
