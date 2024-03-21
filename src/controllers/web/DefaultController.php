<?php

namespace sudesuvar\todo\controllers\web;

use portalium\web\Controller as WebController;
use Yii;;

class DefaultController extends WebController
{
    public function actionIndex()
    {
        Yii::$app->Yii::$app->Task->welcome();
        return $this->render('index');
    }
}