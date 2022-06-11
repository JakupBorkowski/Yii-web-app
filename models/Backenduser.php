<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "backenduser".
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string $username
 * @property string $password
 * @property string|null $authKey
 */
class Backenduser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backenduser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 20],
            [['username', 'password'], 'string', 'max' => 30],
            [['authKey'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }

    public function getAuthKey()
    {
        Yii::warning('getAuthKey');
        Yii::warning($this->authKey);
        return $this->authKey;
    }
    public function getId()
    {
        Yii::warning('getId');
        Yii::warning($this->id);
        return $this->id;
    }
    public function validateAuthKey($authKey)
    {
        Yii::warning('validateAuthKey');
        Yii::warning($this->getAuthKey() === $authKey);
        return $this->getAuthKey() === $authKey;
    }
    public static function findIdentity($id)
    {
        Yii::warning('findIdentity');
        Yii::warning(self::findOne($id));
        return self::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedExeption();
    }
    public static function findByUsername($username)
    {
        Yii::warning('findByUsername');
        Yii::warning(self::findOne(['username'=>$username]));
        return self::findOne(['username'=>$username]);
    }
    public function validatePassword($password)
    {
        return $this->password === $password;
    }



}
