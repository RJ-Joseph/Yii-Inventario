<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Videojuego;

/**
 * VideojuegoSearch represents the model behind the search form of `app\models\Videojuego`.
 */
class VideojuegoSearch extends Videojuego
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idvideojuego', 'director_iddirector'], 'integer'],
            [['portada', 'nombre', 'fechalanzamiento'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Videojuego::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idvideojuego' => $this->idvideojuego,
            'fechalanzamiento' => $this->fechalanzamiento,
            'director_iddirector' => $this->director_iddirector,
        ]);

        $query->andFilterWhere(['like', 'portada', $this->portada])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
