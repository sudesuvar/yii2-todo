<?php

namespace sudesuvar\todo\controllers\web;

use Yii;
use portalium\todo\models\Task;
use portalium\todo\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use portalium\content\Module;
use portalium\web\Controller as WebController;



/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends WebController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [ // yalnızca oturum açmış kullanıcılar, HTTP POST isteğiyle "delete" işlemini gerçekleştirebilirler.
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'], //'delete' eyleminin yalnızca POST istekleriyle erişilebilmesi sağlanır.
                    ],
                ],
                'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true, //belirli bir rol veya izin kontrolü yapılmaksızın, erişime izin verilip verilmediğini belirtir.
                            'roles' => ['@'], //yalnızca oturum açmış (authenticated) kullanıcıların erişimine izin verilir.
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */

     // actionIndex --> tüm görec modellerini listeleyen bir sayfa oluşturur.
     // kullanıcının belirli yetkilere sahip olup olmadığını kontrol eder.
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('contentWebCategoryIndex') && !\Yii::$app->user->can('contentWebCategoryIndexOwn'))
            //Kullanıcıya "contentWebCategoryIndex" veya "contentWebCategoryIndexOwn" yetkilerinden herhangi biri verilmemişse,hata fırlatılır.
        {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if(!\Yii::$app->user->can('contentWebDefaultIndex'))
            $dataProvider->query->andWhere(['id_user'=>\Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id_task Id Task
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

     // actionView --> Belirli bir görevin detaylarını görüntüler.
     // kullanıcının bu sayfaya erişim yetkisini kontrol eder.
    public function actionView($id_task)
    {
        $model = $this->findModel($id_task);

        if ($model &&!\Yii::$app->user->can('contentWebCategoryView', ['model'=>$this->findModel($id_task)])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        return $this->render('view', [
            'model' => $this->findModel($id_task),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

     // actionCreate --> yeni bir görev oluşturma sayfasını oluşturur.
     // form post edildiğinde verileri alır, modeli kaydeder ve gerekli yetkilere sahip olup olmadığını kontrol 
     // eder.
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('contentWebCategoryCreate')) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        $model = new Task();

        if ($this->request->isPost) {
            $model ->id_user=Yii::$app->user->id; //id_user field dolduran kişinin id_user'ı olmasını sağlar
            $model ->id_workspace=Yii::$app->workspace->id;//id_workspace field dolduran kişinin id_workspaces'ı olmasını sağlar

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_task' => $model->id_task]);
            }
            var_dump($model->errors);
            exit(); // hata yazdırma fonksiyonu
        } else {

            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_task Id Task
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

     // actionUpdate --> var olan bir görevi güncelleme sayfası oluşturur.
     // kullanıcının güncelleme yetkisini kontrol eder.
     // form post edildiğinde verileri alır ve günceller.
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('contentWebCategoryUpdate', ['model'=>$this->findModel($id)])) {
        throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
    }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_task' => $model->id_task]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_task Id Task
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

     // actionDelete --> var olan bi görevi siler. 
     // kullanıcının silme yetkisini kontrol eder.
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('contentWebCategoryDelete', ['model'=>$this->findModel($id)])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }

        if($this->findModel($id)->delete()){
            Yii::$app->session->addFlash('info', Module::t('Task has been deleted'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_task Id Task
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_task)
    {
        if (($model = Task::findOne(['id_task' => $id_task])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}