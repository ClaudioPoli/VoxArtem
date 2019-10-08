<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Artwork;

/**
 * ArtworkSearch represents the model behind the search form about `backend\models\Artwork`.
 */
class ArtworkSearch extends Artwork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['artwork_id', 'museum_id'], 'integer'],
            [['name', 'short_description', 'long_description', 'audio', 'video'], 'safe'],
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
        $query = Artwork::find();

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
            'artwork_id' => $this->artwork_id,
            'museum_id' => $this->museum_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'long_description', $this->long_description])
            ->andFilterWhere(['like', 'audio', $this->audio])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
