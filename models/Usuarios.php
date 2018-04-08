<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $rol
 * @property int $id
 * @property string $username
 * @property string $password
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rol', 'username', 'password'], 'required'],
            [['rol'], 'default', 'value' => null],
            [['rol'], 'integer'],
            [['username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rol' => 'Rol',
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
}
