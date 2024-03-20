<?php

namespace sudesuvar\todo\widgets;

use portalium\bootstrap5\Button;
use sudesuvar\todo\bundles\TaskAsset;
use sudesuvar\todo\models\TaskSearch;
use sudesuvar\todo\Module;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use portalium\todo\models\Task as todoTask;


class Task extends Widget
{
    public $tasks;

  //işlemleri başlatan fonksiyon
    public function init()
    {
        // text in ilk harfini büyük yapar upper case
        //$this->text = ucfirst($this->text);
        // yapıcı method
    }

    //işlemlerin sonucunu oluşturan fonksiyon
    //html ve css i birbirine harmanlıyo
    public function run()
    {
        parent::run();
        $tasks=TodoTask::widgets();

        // widgets altındaki viewse render eder
        return $this->render('task',[
            'tasks'=>$tasks

        ]);

        // TaskAsset'i sayfaya kaydediyoruz
        TaskAsset::register($this->getView());
        //return '<button> buton </button>';
        //return $this->render('sudesuvar/todo/widgets/views/task',[
        //]);
        //return $this->render('widgets/views/task');

        //$tasks=TodoTask::widgets();
        //return $this->render('task',[
        //  'tasks'=>$tasks]);
        //return $this->renderFile("@vendor/sudesuvar/yii2-todo/src/widgets/views/task.php",[]);
    }

}