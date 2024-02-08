<?php

use yii\db\Schema;
use yii\db\Migration;
use portalium\user\Module as UserModule;
use portalium\workspace\Module as WorkspaceModule;

class m211115_010203_todo extends Migration
{
     
        public function safeUp()
        {
            $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%' . Module::$tablePrefix . 'task}}',
            [
                'id_task'=> $this->primaryKey(),
                'title'=> $this->string(255),
                'description'=>$this->string(),
                'status'=> $this->smallInteger(6)->notNull(),
                'id_user'=>$this->integer()->notNull(),
                'id_workspace'=>$this->integer(11)->notNull(),
                'date_create'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'date_update'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );


        // creates index for column id_user



        // add foreign key for table {{%user}}
        $this->addForeignKey(
            '{{%fk-' . Module::$tablePrefix . 'task-id_user}}',
            '{{%' . Module::$tablePrefix . 'task}}',
            'id_user',
            '{{%' . UserModule::$tablePrefix . 'user}}',
            'id_user',
            'RESTRICT'
        );



        $this->addForeignKey(
            '{{%fk-' . Module::$tablePrefix . 'task-id_workspace}}',
            '{{%' . Module::$tablePrefix . 'task}}',
            'id_workspace',
            '{{%' . WorkspaceModule::$tablePrefix . 'workspace}}',
            'id_workspace',
            'RESTRICT'
        );
        }

        public function safeDown()
        {
            $this->dropTable('{{%' . Module::$tablePrefix . 'task}}');
        }
    
}
