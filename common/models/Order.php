<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $customer_type
 * @property string $first_name
 * @property string $last_name
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $address
 * @property string $zip_code
 * @property string $phone
 * @property string $email
 * @property string $notes
 * @property string $status
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['address', 'notes'], 'string'],
            [['customer_type'], 'string', 'max' => 6],
            [['first_name', 'last_name', 'country', 'region', 'city', 'zip_code', 'phone', 'email', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'customer_type' => 'Customer Type',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'country' => 'Country',
            'region' => 'Region',
            'city' => 'City',
            'address' => 'Address',
            'zip_code' => 'Zip Code',
            'phone' => 'Phone',
            'email' => 'Email',
            'notes' => 'Notes',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem1::className(), ['order_id' => 'id']);
    }
}
