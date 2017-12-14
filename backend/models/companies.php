<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property integer $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_status
 *
 * @property Branches[] $branches
 * @property Department[] $departments
 */
class companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'company_email', 'company_address', 'company_status'], 'required'],
            ['company_email' , 'email'],
            [['file'],'file'],
            ['company_email' , 'unique'],
            [['company_address','company_logo', 'company_status'], 'string'],
            [['company_name', 'company_email'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_status' => 'Company Status',
            'company_logo' => 'Company logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getbranches()
    {
        return $this->hasMany(Branches::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getdepartments()
    {
        return $this->hasMany(Department::className(), ['company_id' => 'company_id']);
    }
}
