<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\models\GeneroHasVideojuegos;

use Yii;

/**
 * This is the model class for table "videojuego".
 *
 * @property int $idvideojuego
 * @property string|null $portada
 * @property string|null $nombre
 * @property string|null $fechalanzamiento
 * @property int $director_iddirector
 *
 * @property Desarrolladora[] $desarrolladoras
 * @property Director $directorIddirector
 * @property Distribuidora[] $distribuidoras
 * @property GeneroHasVideojuego[] $generoHasVideojuegos
 * @property Genero[] $generoIdgeneros
 */
class Videojuego extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $distributor = [];
    public $genders = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videojuego';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fechalanzamiento'], 'default', 'value' => null],
            [['fechalanzamiento'], 'safe'],
            [['director_iddirector', 'desarrolladora_iddesarrolladora', 'distribuidora_iddistribuidora'], 'required'],
            [['director_iddirector', 'desarrolladora_iddesarrolladora', 'distribuidora_iddistribuidora'], 'integer'],
            [['portada', 'nombre'], 'string', 'max' => 50],
            [['distributor', 'genders'], 'each', 'rule' => ['integer']],
            [['director_iddirector'], 'exist', 'skipOnError' => true, 'targetClass' => Director::class, 'targetAttribute' => ['director_iddirector' => 'iddirector']],
            [['desarrolladora_iddesarrolladora'], 'exist', 'skipOnError' => true, 'targetClass' => Desarrolladora::class, 'targetAttribute' => ['desarrolladora_iddesarrolladora' => 'iddesarrolladora']],
            [['distribuidora_iddistribuidora'], 'exist', 'skipOnError' => true, 'targetClass' => Distribuidora::class, 'targetAttribute' => ['distribuidora_iddistribuidora' => 'iddistribuidora']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],    
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idvideojuego' => Yii::t('app', 'Videojuego'),
            'portada' => Yii::t('app', 'Portada'),
            'nombre' => Yii::t('app', 'Nombre'),
            'fechalanzamiento' => Yii::t('app', 'Fecha lanzamiento'),
            'director_iddirector' => Yii::t('app', 'Director'),
            'distribuidora_iddistribuidora' => Yii::t('app', 'Distribuidora'),
            'desarrolladora_iddesarrolladora' => Yii::t('app', 'Desarrolladora'),

        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            if ($this->isNewRecord) {
                if (!$this->save(false)) {
                    return false;
                }
            }

            if ($this->imageFile instanceof UploadedFile) {
                // Sanitiza el nombre base y agrega un prefijo único
                $sanitizedBaseName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->imageFile->baseName);
                $filename = uniqid() . '_' . $sanitizedBaseName . '.' . $this->imageFile->extension;
                $path = Yii::getAlias('@webroot/portadas/') . $filename;

                if ($this->imageFile->saveAs($path)) {
                    if ($this->portada && $this->portada !== $filename) {
                        $this->deletePortada();
                    }

                    $this->portada = $filename;
                }
            }

            return $this->save(false);
        }

        return false;
    }


    public function deletePortada()
    {
        $path = Yii::getAlias('@webroot/portadas/') . $this->portada;
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        GeneroHasVideojuego::deleteAll(['videojuego_idvideojuego' => $this->idvideojuego]);

        if (is_array($this->genders)) {
            foreach ($this->genders as $generoId) {
                $relacion = new GeneroHasVideojuego();
                $relacion->genero_idgenero = $generoId;
                $relacion->videojuego_idvideojuego = $this->idvideojuego;
                $relacion->save();
            }
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->genders = GeneroHasVideojuego::find()
            ->select('genero_idgenero')
            ->where(['videojuego_idvideojuego' => $this->idvideojuego])
            ->column();
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        GeneroHasVideojuego::deleteAll(['videojuego_idvideojuego' => $this->idvideojuego]);
        return true;
    }

    /**
     * Gets query for [[Desarrolladoras]].
     *
     * @return \yii\db\ActiveQuery|DesarrolladoraQuery
     */
    public function getDesarrolladoras()
    {
        return $this->hasOne(Desarrolladora::class, ['desarrolladora_iddesarrolladora' => 'iddesarrolladora']);
    }

    /**
     * Gets query for [[DirectorIddirector]].
     *
     * @return \yii\db\ActiveQuery|DirectorQuery
     */
    public function getDirectorIddirector()
    {
        return $this->hasOne(Director::class, ['iddirector' => 'director_iddirector']);
    }

    /**
     * Gets query for [[Distribuidoras]].
     *
     * @return \yii\db\ActiveQuery|DistribuidoraQuery
     */
    public function getDistribuidoras()
    {
        return $this->hasOne(Distribuidora::class, ['distribuidora_iddistribuidora' => 'iddistribuidora']);
    }

    /**
     * Gets query for [[GeneroHasVideojuegos]].
     *
     * @return \yii\db\ActiveQuery|GeneroHasVideojuegoQuery
     */
    public function getGeneroHasVideojuegos()
    {
        return $this->hasMany(GeneroHasVideojuego::class, ['videojuego_idvideojuego' => 'idvideojuego']);
    }

    /**
     * Gets query for [[GeneroIdgeneros]].
     *
     * @return \yii\db\ActiveQuery|GeneroQuery
     */
    public function getGeneroIdgeneros()
    {
        return $this->hasMany(Genero::class, ['idgenero' => 'genero_idgenero'])->viaTable('genero_has_videojuego', ['videojuego_idvideojuego' => 'idvideojuego']);
    }

    /**
     * {@inheritdoc}
     * @return VideojuegoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideojuegoQuery(get_called_class());
    }
}
