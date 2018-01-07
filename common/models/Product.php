<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $quantity
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'quantity'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 30],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
	
	public function getProductImagePath()
	{
	    return Yii::getAlias('@frontend/web/images/' . md5($this->id . $this->title) . '.png');	
	}
	
	public static function getProductImageUrl($id, $title)
	{
		return Yii::getAlias('@frontendWebroot/images/' . md5($id . $title) . '.png');
	}
	
	public function afterDelete()
	{
		unlink($this->getProductImagePath());
		parent::afterDelete();
	}
}
