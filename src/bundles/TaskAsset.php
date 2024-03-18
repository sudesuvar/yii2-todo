<?php

namespace sudesuvar\todo\bundles;

use yii\web\AssetBundle;

class TaskAsset extends AssetBundle
{
    //TaskAsset sınıfının js ve css  dosyalarının bulunduğu dizini belirtiyoruz
    public $sourcePath= '@vendor/sudesuvar/yii2-todo/src/assets/';

    //task.css dosyasının kullanılacağını belirtiyoruz
    public $css = [
        'css/task.css'
    ];

    //koddaki değişikliğin ön yüzde güncel olmasını sağlar
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];


    //constructor sınıfın başlatılmasını sağlar
    public function init()
    {
        parent::init();
    }


}