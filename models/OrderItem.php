<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order_items".
 *
 * @property int    $id
 * @property int    $order_id
 * @property int    $product_id
 * @property string $product_name
 * @property int    $quantity
 * @property double $price
 */
class OrderItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_name', 'quantity', 'price'], 'required'],
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'order_id'     => 'Order ID',
            'product_id'   => 'Product ID',
            'product_name' => 'Product Name',
            'quantity'     => 'Quantity',
            'price'        => 'Price',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class(), ['id' => 'order_id']);
    }
}
