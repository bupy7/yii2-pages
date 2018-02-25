<?php

namespace bupy7\pages\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PageSearch represents the model behind the search form about `bupy7\pages\models\Page`.
 *
 * @author Belosludcev Vasilij <bupy765@gmail.com>
 * @since 1.0.0
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     * @since 1.3.0
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['sluggable']);
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published'], 'integer'],
            [['title', 'alias'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Page::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        return $dataProvider;
    }
}
