<?php

namespace portalium\todo\models;

use portalium\content\Module;
use Yii;
use portalium\user\models\User;
use yii\behaviors\AttributeBehavior;

use portalium\workspace\models\Workspace;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%todo_task}}".
 *
 * @property int $id_task
 * @property string|null $title
 * @property string|null $description
 * @property int|null $status
 * @property int $id_user
 * @property int $id_workspace
 * @property string $date_create
 * @property string $date_update
 * @property User $user
 * @property Workspace $workspace
 */
class Task extends \yii\db\ActiveRecord
{
    const STATUS = [
        'not_completed' => 0,
        'completed' => 1,
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%todo_task}}';
    }

    /*public function behaviors()
    {
        return [
            [
                //kim tarafından yapıldı
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'id_user',
                'updatedByAttribute' => 'id_user',
            ],

            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    // bir kayıt oluşturulmadan veya güncellenmeden önce  id-workspace'e değer atamak için kullanılır
                    ActiveRecord::EVENT_BEFORE_INSERT => 'id_workspace',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'id_workspace',
                    ],
                'value' => function ($event) {
                    return Yii::$app->workspace->id;
                },
            ]

        ];
    }*/
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'id_user', 'id_workspace'], 'integer'],
            [['id_user', 'id_workspace'], 'required'],
            [['date_create', 'date_update','id_user', 'id_workspace'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_workspace'], 'exist', 'skipOnError' => true, 'targetClass' => Workspace::class, 'targetAttribute' => ['id_workspace' => 'id_workspace']],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_task' => Module::t('Id Task'),
            'title' => Module::t('Title'),
            'description' => Module::t('Description'),
            'status' => Module::t('Status'),
            'id_user' =>  Module::t('Id User'),
            'id_workspace' => Module::t('Id Workspace'),
            'date_create' =>  Module::t('Date Create'),
            'date_update' => Module::t('Date Update'),
        ];
    }
    public static function getStatusList()
    {
        //return value and label
        return [
            'STATUS' => [
                self::STATUS['not_completed'] => Module::t('Not Completed'),
                self::STATUS['completed'] => Module::t('Completed'),

            ],
        ];
    }
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id_user' => 'id_user']);
    }
    /**
     * Gets query for [[Workspace]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkspace()
    {
        return $this->hasOne(Workspace::class, ['id_workspace' => 'id_workspace']);
    }
}
