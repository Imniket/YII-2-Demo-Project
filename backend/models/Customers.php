<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $costomer_id
 * @property string $customer_name
 * @property string $zipcode
 * @property string $city
 * @property string $province
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_name', 'zipcode', 'city', 'province'], 'required'],
            [['customer_name', 'zipcode'], 'string', 'max' => 20],
            [['city', 'province'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'costomer_id' => 'Costomer ID',
            'customer_name' => 'Customer Name',
            'zipcode' => 'Zipcode',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
}
