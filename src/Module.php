<?php

namespace sudesuvar\todo;

use portalium\base\Event;
use sudesuvar\todo\components\TriggerActions;

class Module extends \portalium\base\Module
{
    public static $tablePrefix = 'todo_';
    
    public static $name = 'todo';

    public static $description = 'todo Module';

    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'todo/default',
                'todo/task',
            ],
            'pluralize'=>false
        ],
    ];
    public function getMenuItems()
    {
        $menuItems = [
            [

                [
                    'menu' => 'web',
                    'type' => 'widget',
                    'label' => 'sudesuvar\todo\widgets\task',
                    'name' => 'task',
                ],
                
            ],
        ];
        return $menuItems;
    }


    
    public static function moduleInit()
    {
        self::registerTranslation('todo','@sudesuvar/todo/messages',[
            'todo' => 'todo.php',
        ]);
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('todo', $message, $params);
    }

    /* 
        public function registerEvents()
        {
            Event::on($this::className(), UserModule::EVENT_USER_DELETE_BEFORE, [new TriggerActions(), 'onUserDeleteBefore']);
        } 
    */
}