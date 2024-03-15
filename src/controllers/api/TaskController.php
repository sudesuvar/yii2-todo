<?php

namespace sudesuvar\todo\controllers\api;

use sudesuvar\todo\models\TaskSearch;
use Yii;
use sudesuvar\todo\models\Task;
use sudesuvar\todo\Module;
use portalium\rest\ActiveController as RestActiveController;
use portalium\todo\models\TaskSearch as ModelsTaskSearch;

class TaskController extends RestActiveController
{
    public $modelClass = 'sudesuvar\todo\models\Task';

    public function actions()
    {
        //data filtreleme işlemleri
        $actions = parent::actions();
        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        //before index data filter

        //Bu fonksiyon, "index" eylemi için veri sağlamak üzere yapılandırılmıştır.
        // ModelsTaskSearch sınıfından yeni bir arama modeli oluşturulur ve bu model kullanılarak veri sağlayıcısı (dataProvider)
        // hazırlanır. Ayrıca, eğer kullanıcı "todoApitaskIndex" yetkisine sahip değilse,
        // sorguya ek bir kısıtlama eklenir. Bu sayede, sadece belirli kullanıcıların verilerine erişim sağlanabilir.

        $actions['index']['prepareDataProvider'] = function ($action) {
            //$searchModel = new ModelsTaskSearch(); burada TaskSearch yazmak gerekmez miydi ?? (kabul etmedi)
            $searchModel = new ModelsTaskSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if(!Yii::$app->user->can('todoApitaskIndex')){
                $dataProvider->query->andWhere(['id_user'=>Yii::$app->user->id]);
            }
            return $dataProvider;
        };

        return $actions;
    }

    public function beforeAction($action)
    {

        // beforeAction Metodu:
        // Bu metodun işlevi, bir eylem gerçekleşmeden önce belirli kontrolleri yapmaktır.
        // Eğer bu kontrollerden biri başarısız olursa, false değeri döndürülür ve eylem çalıştırılmaz.
        
        if (!parent::beforeAction($action)) {
            return false;
        }
        switch ($action->id) {
            case 'view':
                if (!Yii::$app->user->can('todoApitaskView'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to view this todo.'));
                break;
            case 'create':
                if (!Yii::$app->user->can('todoApitaskCreate'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to create this todo.'));
                break;
            case 'update':
                if (!Yii::$app->user->can('todoApitaskUpdate'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to update this todo.'));
                break;
            case 'delete':
                if (!Yii::$app->user->can('todoApitaskDelete'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to delete this todo.'));
                break;
            case 'index':
                if (!Yii::$app->user->can('todoApitaskIndex') && !Yii::$app->user->can('todoApitaskIndexOwn'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to view this todo.'));
                break;
        }

        return true;
    }
}
