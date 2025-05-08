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
    public $generoNombre;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idvideojuego',], 'integer'],
            [['portada', 'nombre', 'fechalanzamiento', 'generoNombre'], 'safe'],
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
        $query = Videojuego::find()->joinWith('generoIdgeneros'); // asegúrate de que esta relación existe

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Si quieres que las columnas de genero se ordenen y filtren en GridView:
        $dataProvider->sort->attributes['generoNombre'] = [
            'asc' => ['genero.nombre' => SORT_ASC],
            'desc' => ['genero.nombre' => SORT_DESC],
        ];

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Filtros exactos
        $query->andFilterWhere([
            'idvideojuego' => $this->idvideojuego,
            'fechalanzamiento' => $this->fechalanzamiento,
            'director_iddirector' => $this->director_iddirector,
        ]);

        // Filtros con LIKE, con columnas completamente calificadas para evitar ambigüedad
        $query->andFilterWhere(['like', 'videojuego.portada', $this->portada])
            ->andFilterWhere(['like', 'videojuego.nombre', $this->nombre])
            ->andFilterWhere(['like', 'genero.nombre', $this->generoNombre]);

        return $dataProvider;
    }
}
