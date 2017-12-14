<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\department;

/**
 * departmentSearch represents the model behind the search form about `backend\models\department`.
 */
class departmentSearch extends department
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id'], 'integer'],
            [['department_name', 'department_branch_id', 'department_company_id', 'department_address'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = department::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('departmentbranch');
        $query->joinWith('departmentcompany');
        // grid filtering conditions
        $query->andFilterWhere([
            'department_id' => $this->department_id,
        ]);

        $query->andFilterWhere(['like', 'department_name', $this->department_name])
            ->andFilterWhere(['like', 'department_address', $this->department_address])
            ->andFilterWhere(['like', 'companies.company_name', $this->department_company_id])
            ->andFilterWhere(['like', 'branches.branch_name', $this->department_branch_id]);

        return $dataProvider;
    }
}
