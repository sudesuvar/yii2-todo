<?php

use sudesuvar\todo\rbac\OwnRule;
use yii\db\Migration;

/**
 * Class m240307_193840_task_rule_rbac
 */
class m240307_193840_task_rule_rbac extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = \Yii::$app->authManager;

        $rule = new OwnRule();
        $auth->add($rule);
        $role = \Yii::$app->setting->getValue('site::admin_role');
        $admin = (isset($role) && $role != '') ? $auth->getRole($role) : $auth->getRole('admin');
        $user = $auth->getRole('user'); //user değişkenine user rolü atıyor




        $todoWebtaskIndexOwn = $auth->createPermission('todoWebtaskIndexOwn');//"todoWebtaskIndexOwn" adında bir izin nesnesi oluşturur
        $todoWebtaskIndexOwn->description = 'todo Web taskIndexOwn';
        $auth->add($todoWebtaskIndexOwn);//Oluşturulan izin nesnesini yetkilendirme sistemi içinde kaydeder
        $auth->addChild($admin, $todoWebtaskIndexOwn);//"admin" adında bir rol ile "todoWebtaskIndexOwn" iznini ilişkilendirir. Yani, "admin" rolü bu izne sahip olur.
        $auth->addChild($user, $todoWebtaskIndexOwn); //"user" adında bir rol ile "todoWebtaskIndexOwn" iznini ilişkilendirir. Yani, "admin" rolü bu izne sahip olur.

        $todoWebtaskViewOwn = $auth->createPermission('todoWebtaskViewOwn');
        $todoWebtaskViewOwn->description = 'todo Web taskViewOwn';
        $todoWebtaskViewOwn->ruleName = $rule->name;
        $auth->add($todoWebtaskViewOwn);
        $auth->addChild($admin, $todoWebtaskViewOwn);
        $auth->addChild($user, $todoWebtaskViewOwn);

        $todoWebtaskView = $auth->getPermission('todoWebtaskView');
        $auth->addChild($todoWebtaskViewOwn, $todoWebtaskView);

        $todoWebtaskCreateOwn = $auth->createPermission('todoWebtaskCreateOwn');
        $todoWebtaskCreateOwn->description = 'todoWeb taskCreateOwn';

        $auth->add($todoWebtaskCreateOwn);
        $auth->addChild($admin, $todoWebtaskCreateOwn);
        $auth->addChild($user, $todoWebtaskCreateOwn);

        $todoWebtaskCreate = $auth->getPermission('todoWebtaskCreate');
        $auth->addChild($todoWebtaskCreateOwn, $todoWebtaskCreate);

        $todoWebtaskUpdateOwn = $auth->createPermission('todoWebtaskUpdateOwn');
        $todoWebtaskUpdateOwn->description = 'todo Web taskUpdateOwn';
        $todoWebtaskUpdateOwn->ruleName = $rule->name;
        $auth->add($todoWebtaskUpdateOwn);
        $auth->addChild($admin, $todoWebtaskUpdateOwn);
        $auth->addChild($user, $todoWebtaskUpdateOwn);

        $todoWebtaskUpdate = $auth->getPermission('todoWebtaskUpdate');
        $auth->addChild($todoWebtaskUpdateOwn, $todoWebtaskUpdate);

        $todoWebtaskDeleteOwn = $auth->createPermission('todoWebtaskDeleteOwn');
        $todoWebtaskDeleteOwn->description = 'todo Web taskDeleteOwn';
        $todoWebtaskDeleteOwn->ruleName = $rule->name;
        $auth->add($todoWebtaskDeleteOwn);
        $auth->addChild($admin, $todoWebtaskDeleteOwn);
        $auth->addChild($user, $todoWebtaskDeleteOwn);

        $todoWebtaskDelete = $auth->getPermission('todoWebtaskDelete');
        $auth->addChild($todoWebtaskDeleteOwn, $todoWebtaskDelete);



        /*$todoApitaskViewOwn = $auth->createPermission('todoApitaskViewOwn');
        $todoApitaskViewOwn->description = 'todo Api task View Own';
        $todoApitaskViewOwn->ruleName = $rule->name;
        $auth->add($todoApitaskViewOwn);
        $auth->addChild($admin, $todoApitaskViewOwn);
        $auth->addChild($user, $todoApitaskViewOwn);

        $todoApitaskView = $auth->getPermission('todoApitaskView');
        $auth->addChild($todoApitaskViewOwn, $todoApitaskView);*/

        $todoApitaskCreateOwn = $auth->createPermission('todoApitaskCreateOwn');
        $todoApitaskCreateOwn->description = 'todo Api task Create Own';
        $todoApitaskCreateOwn->ruleName = $rule->name;
        $auth->add($todoApitaskCreateOwn);
        $auth->addChild($admin, $todoApitaskCreateOwn);
        $auth->addChild($user, $todoApitaskCreateOwn);

        $todoApitaskCreate = $auth->getPermission('todoApitaskCreate');
        $auth->addChild($todoApitaskCreateOwn, $todoApitaskCreate);

        $todoApitaskUpdateOwn = $auth->createPermission('todoApitaskUpdateOwn');
        $todoApitaskUpdateOwn->description = 'todo Api task Update Own';
        $todoApitaskUpdateOwn->ruleName = $rule->name;
        $auth->add($todoApitaskUpdateOwn);
        $auth->addChild($admin, $todoApitaskUpdateOwn);
        $auth->addChild($user, $todoApitaskUpdateOwn);

        $todoApitaskUpdate = $auth->getPermission('todoApitaskUpdate');
        $auth->addChild($todoApitaskUpdateOwn, $todoApitaskUpdate);

        $todoApitaskDeleteOwn = $auth->createPermission('todoApitaskDeleteOwn');
        $todoApitaskDeleteOwn->description = 'todo Api task Delete Own';
        $todoApitaskDeleteOwn->ruleName = $rule->name;
        $auth->add($todoApitaskDeleteOwn);
        $auth->addChild($admin, $todoApitaskDeleteOwn);
        $auth->addChild($user, $todoApitaskDeleteOwn);

        $todoApitaskDelete = $auth->getPermission('todoApitaskDelete');
        $auth->addChild($todoApitaskDeleteOwn, $todoApitaskDelete);

        $todoApitaskIndexOwn = $auth->createPermission('todoApitaskIndexOwn');
        $todoApitaskIndexOwn->description = 'todo Api task Index Own';
        $auth->add($todoApitaskIndexOwn);
        $auth->addChild($admin, $todoApitaskIndexOwn);
        $auth->addChild($user, $todoApitaskIndexOwn);

    }

    public function down()
    {
        echo "m240307_193840_task_rule_rbac cannot be reverted.\n";

        return false;
    }
    
}
