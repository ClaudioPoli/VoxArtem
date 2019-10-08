<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PublishedArtwork;

/**
 * PublishedArtworkSearch represents the model behind the search form about `backend\models\PublishedArtwork`.
 */
class PublishedArtworkSearch extends PublishedArtwork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['published_artwork_id', 'artwork_id'], 'integer'],
            [['name', 'description', 'audio', 'video'], 'safe'],
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
        $query = PublishedArtwork::find();

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
            'published_artwork_id' => $this->published_artwork_id,
            'artwork_id' => $this->artwork_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'audio', $this->audio])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
