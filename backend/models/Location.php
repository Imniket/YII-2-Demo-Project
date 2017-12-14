<?php

namespace backend\models;

use Yii;
use backend\models\Customers;

/**
 * This is the model class for table "location".
 *
 * @property integer $location_id
 * @property string $zipcode
 * @property string $city
 * @property string $province
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zipcode', 'city', 'province'], 'required'],
            [['zipcode'], 'string', 'max' => 20],
            [['city', 'province'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'zipcode' => 'Zipcode',
            'city' => 'City',
            'province' => 'Province',
        ];
    }
    
   
}
