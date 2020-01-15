<?php

namespace common\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Classifieds;

/**
 * ClassifiedsSearch represents the model behind the search form of `common\models\Classifieds`.
 */
class ClassifiedsSearch extends Classifieds
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'seo_tool_id', 'category_id', 'views', 'province_id', 'district_id', 'status', 'user_id'], 'integer'],
            [['title', 'avatar', 'slug', 'describe', 'content', 'price', 'start_date', 'expiration_date', 'email', 'phone', 'mobile', 'address', 'contacts', 'contact_name', 'images'], 'safe'],
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
        $query = Classifieds::find();

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
            'seo_tool_id' => $this->seo_tool_id,
            'category_id' => $this->category_id,
            'views' => $this->views,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'start_date' => $this->start_date,
            'expiration_date' => $this->expiration_date,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
