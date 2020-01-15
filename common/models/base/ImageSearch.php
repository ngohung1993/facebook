<?php

namespace common\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Image;

/**
 * ImageSearch represents the model behind the search form of `common\models\Image`.
 */
class ImageSearch extends Image
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'photo_location_id', 'serial', 'featured', 'post_id', 'category_id', 'setting_id', 'status'], 'integer'],
            [['title', 'avatar', 'sub_photo', 'link', 'describe', 'content'], 'safe'],
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
        $query = Image::find();

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
            'photo_location_id' => $this->photo_location_id,
            'serial' => $this->serial,
            'featured' => $this->featured,
            'post_id' => $this->post_id,
            'category_id' => $this->category_id,
            'setting_id' => $this->setting_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'sub_photo', $this->sub_photo])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
