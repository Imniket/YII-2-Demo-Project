<?php

namespace backend\modules\setting\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property integer $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_status
 * @property string $company_started_date
 *
 * @property Branches[] $branches
 * @property Department[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['company_name', 'company_email', 'company_address', 'company_status', 'company_started_date'], 'required'],
            //['company_started_date','chackDate'],
            ['company_email','unique'],
            ['company_email','email'],
            [['company_address', 'company_status'], 'string'],
            [['company_started_date'], 'safe'],
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
            'company_started_date' => 'Company Started Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['branch_company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['department_company_id' => 'company_id']);
    }
}
