<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detallepedido".
 *
 * @property int $id
 * @property int $cantidad
 * @property string $precio
 * @property int $pedidoid
 * @property int $productoid
 */
class Detallepedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detallepedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'cantidad', 'pedidoid', 'productoid'], 'default', 'value' => null],
            [['id', 'cantidad', 'pedidoid', 'productoid'], 'integer'],
            [['precio'], 'number'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'pedidoid' => 'Pedidoid',
            'productoid' => 'Productoid',
        ];
    }
}
