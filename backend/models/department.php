<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $department_id
 * @property integer $department_branch_id
 * @property integer $department_company_id
 * @property string $department_name
 * @property string $department_address
 *
 * @property Branches $departmentBranch
 * @property Companies $departmentCompany
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_branch_id', 'department_company_id', 'department_name','department_status', 'department_address'], 'required'],
            [['department_branch_id', 'department_company_id'], 'safe'],
            [['department_name'], 'string', 'max' => 25],
            [['department_address'], 'string', 'max' => 255],
            [['department_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['department_branch_id' => 'branch_id']],
            [['department_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['department_company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_company_id' => 'Company Name',
            'department_branch_id' => ' Branch Name',
            'department_name' => 'Department Name',
            'department_address' => 'Department Address',
            'department_status' => 'Department Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getdepartmentbranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'department_branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getdepartmentcompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'department_company_id']);
    }
}
