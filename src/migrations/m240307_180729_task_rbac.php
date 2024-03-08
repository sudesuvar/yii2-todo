<?php

use yii\db\Migration;

/**
 * Class m240307_180729_task_rbac
 */
class m240307_180729_task_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    /*public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    /*public function safeDown()
    {
        echo "m240307_180729_task_rbac cannot be reverted.\n";

        return false;
    }*/

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = \Yii::$app->authManager;

        $role = \Yii::$app->setting->getValue('site::admin_role');
        $admin = (isset($role) && $role != '') ? $auth->getRole($role) : $auth->getRole('admin');
        $user = $auth->getRole('user');


        $todoWebtaskIndex = $auth->createPermission('todoWebtaskIndex');
        $todoWebtaskIndex->description = 'todo Web taskIndex';
        $auth->add($todoWebtaskIndex);
        $auth->addChild($admin, $todoWebtaskIndex);

        $todoWebtaskView = $auth->createPermission('todoWebtaskView');
        $todoWebtaskView->description = 'todo Web taskView';
        $auth->add($todoWebtaskView);
        $auth->addChild($admin, $todoWebtaskView);

        $todoWebtaskCreate = $auth->createPermission('todoWebtaskCreate');
        $todoWebtaskCreate->description = 'todo Web taskCreate';
        $auth->add($todoWebtaskCreate);
        $auth->addChild($admin, $todoWebtaskCreate);

        $todoWebtaskUpdate = $auth->createPermission('todoWebtaskUpdate');
        $todoWebtaskUpdate->description = 'todo Web taskUpdate';
        $auth->add($todoWebtaskUpdate);
        $auth->addChild($admin, $todoWebtaskUpdate);

        $todoWebtaskDelete = $auth->createPermission('todoWebtaskDelete');
        $todoWebtaskDelete->description = 'todo Web taskDelete';
        $auth->add($todoWebtaskDelete);
        $auth->addChild($admin, $todoWebtaskDelete);

        // api permission

        $todoApitaskIndex = $auth->createPermission('todoApitaskIndex');
        $todoApitaskIndex->description = 'todo Api task Index';
        $auth->add($todoApitaskIndex);
        $auth->addChild($admin, $todoApitaskIndex);

        $todoApitaskPreview = $auth->createPermission('todoWebtaskPreview');
        $todoApitaskPreview->description = 'todo Web taskPreview';
        $auth->add($todoApitaskPreview);
        $auth->addChild($admin, $todoApitaskPreview);

        $todoApitaskView = $auth->createPermission('todoApitaskView');
        $todoApitaskView->description = 'todo Api task View';
        $auth->add($todoApitaskView);
        $auth->addChild($admin, $todoApitaskView);

        $todoApitaskCreate = $auth->createPermission('todoApitaskCreate');
        $todoApitaskCreate->description = 'todo Api task Create';
        $auth->add($todoApitaskCreate);
        $auth->addChild($admin, $todoApitaskCreate);

        $todoApitaskUpdate = $auth->createPermission('todoApitaskUpdate');
        $todoApitaskUpdate->description = 'todo Api task Update';
        $auth->add($todoApitaskUpdate);
        $auth->addChild($admin, $todoApitaskUpdate);

        $todoApitaskDelete = $auth->createPermission('todoApitaskDelete');
        $todoApitaskDelete->description = 'todo Api task Delete';
        $auth->add($todoApitaskDelete);
        $auth->addChild($admin, $todoApitaskDelete);

        //



    }

    public function down()
    {
        $auth = \Yii::$app->authManager;


        $auth->remove($auth->getPermission('todoWebtaskIndex'));
        $auth->remove($auth->getPermission('todoWebtaskView'));
        $auth->remove($auth->getPermission('todoWebtaskCreate'));
        $auth->remove($auth->getPermission('todoWebtaskUpdate'));
        $auth->remove($auth->getPermission('todoWebtaskDelete'));
    }
    
}
