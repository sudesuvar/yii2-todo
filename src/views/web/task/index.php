<?php

use portalium\todo\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use portalium\theme\widgets\Panel;
use portalium\content\Module;
use portalium\theme\widgets\ActionColumn as WidgetsActionColumn;
use sudesuvar\todo\widget\TaskWidget;
use sudesuvar\todo\bundles\TaskAsset;

/** @var yii\web\View $this */
/** @var portalium\todo\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="widgetButton">                                         
  <div class="dropdown">
    <button type="button" class="btn btn-outline-primary border-0 dropdown-toggle" data-bs-toggle="dropdown">
      Task Button
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Link 1</a></li>
      <li><a class="dropdown-item" href="#">Link 2</a></li>
      <li><a class="dropdown-item" href="#">Link 3</a></li>
    </ul>
  </div>
</div>



<div class="task-index">


    <?php Panel::begin([
        // başlık --> Task
        // buton --> + 
        'title' => Module::t('Task'),
        'actions' => [
            Html::a('', ['create'], ['class' => 'fa fa-plus btn btn-success'])
        ]
    ]) ?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_task',
            'title',
            'description',
            //'status',
            //'id_user',
            //'id_workspace',
            //'date_create',
            //'date_update',
            [
                'class' => WidgetsActionColumn::class,
            ],
        ],
    ]);
    ?>