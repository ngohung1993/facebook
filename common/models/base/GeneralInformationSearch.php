<?php

namespace common\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GeneralInformation;

/**
 * GeneralInformationSearch represents the model behind the search form of `common\models\GeneralInformation`.
 */
class GeneralInformationSearch extends GeneralInformation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['site_name', 'home_page_header', 'home_page_description', 'email_notify', 'google_analytics', 'facebook_pixel'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = GeneralInformation::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'site_name', $this->site_name])
            ->andFilterWhere(['like', 'home_page_header', $this->home_page_header])
            ->andFilterWhere(['like', 'home_page_description', $this->home_page_description])
            ->andFilterWhere(['like', 'email_notify', $this->email_notify])
            ->andFilterWhere(['like', 'google_analytics', $this->google_analytics])
            ->andFilterWhere(['like', 'facebook_pixel', $this->facebook_pixel]);

        return $dataProvider;
    }
}
