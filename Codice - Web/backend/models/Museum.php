<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "museum".
 *
 * @property integer $museum_id
 * @property string $name
 * @property string $address
 * @property string $opening
 * @property string $closing
 * @property string $description
 * @property string $video
 *
 * @property Artwork[] $artworks
 */
class Museum extends \yii\db\ActiveRecord
{
    public $videoFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'museum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'opening', 'closing'], 'required'],
            [['opening', 'closing'], 'safe'],
            [['name', 'address', 'description', 'video'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['address'], 'unique'],
            [['videoFile'], 'file', 'skipOnEmpty' => 'true', 'extensions' => 'mp4'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'museum_id' => 'ID',
            'name' => 'Nome',
            'address' => 'Indirizzo',
            'opening' => 'Apertura',
            'closing' => 'Chiusura',
            'description' => 'Descrizione',
            'video' => 'Video',
            'videoFile' => 'Upload Video',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtworks()
    {
        return $this->hasMany(Artwork::className(), ['museum_id' => 'museum_id']);
    }
}
