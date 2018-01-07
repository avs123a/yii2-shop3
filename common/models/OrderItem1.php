<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $title
 * @property string $price
 * @property integer $quantity
 *
 * @property Order $order
 */
class OrderItem1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
		    [['order_id'], 'required'],
            [['order_id', 'quantity'], 'integer'],
            [['title', 'price'], 'string', 'max' => 25],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'title' => 'Title',
            'price' => 'Price',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
