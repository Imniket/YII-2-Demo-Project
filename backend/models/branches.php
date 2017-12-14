<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property integer $branch_id
 * @property integer $branch_company_id
 * @property string $branch_name
 * @property string $branch_address
 * @property string $branch_status
 *
 * @property Companies $branchCompany
 * @property Department[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_company_id', 'branch_name', 'branch_address'], 'required'],
            [['branch_company_id'], 'integer'],
            [['branch_status'], 'string'],
            [['branch_name', 'branch_address'], 'string', 'max' => 25],
            [['branch_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['branch_company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'branch_company_id' => 'Company Name',
            'branch_name' => 'Branch Name',
            'branch_address' => 'Branch Address',
            'branch_status' => 'Branch Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getbranchcompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'branch_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['branch_id' => 'branch_id']);
    }
}
