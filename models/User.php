<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    const ROLE_CUSTOMER = 'customer'; // Role default sebagai pelanggan

    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time', 'role'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => function() { return date('Y-m-d H:i:s'); },
            ],
        ];
    }

    /**
     * Before save event handler untuk meng-hash password sebelum disimpan
     */
    public function getQueues()
    {
        return $this->hasMany(Queue::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
    *
    * @param string $username
    * @return static|null
    */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
    */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
    */
    public function getAuthKey()
    {
        return $this->auth_token;
    }

    /**
     * @inheritdoc
    */
    public function validateAuthKey($authToken)
    {
        return $this->getAuthToken() === $authToken;
    }

    /**
     * Validates password
    *
    * @param string $password password to validate
    * @return bool if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
    *
    * @param string $password
    */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
    */
    public function generateAuthKey()
    {
        $this->auth_token = Yii::$app->security->generateRandomString();
    }

}
