<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "artwork".
 *
 * @property integer $artwork_id
 * @property string $name
 * @property string $short_description
 * @property string $long_description
 * @property string $audio
 * @property string $video
 * @property integer $museum_id
 *
 * @property Museum $museum
 * @property PublishedArtwork $publishedArtwork
 */
class Artwork extends \yii\db\ActiveRecord
{
    public $museum_name;
    public $media;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artwork';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_description', 'long_description', 'museum_id'], 'required'],
            [['museum_id'], 'integer'],
            [['name', 'short_description', 'audio', 'video', 'museum_name'], 'string', 'max' => 255],
            [['long_description'], 'string', 'max' => 511],
            [['name'], 'unique'],
            [['media'], 'file', 'skipOnEmpty' => 'true', 'extensions' => 'mp3, mp4'],
            [['museum_id'], 'exist', 'skipOnError' => true, 'targetClass' => Museum::className(), 'targetAttribute' => ['museum_id' => 'museum_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'artwork_id' => 'ID',
            'name' => 'Nome',
            'short_description' => 'Descrizione Breve',
            'long_description' => 'Descrizione Estesa',
            'audio' => 'Link Audio',
            'video' => 'Link Video',
            'museum_name' => 'Museo di Appartenenza',
            'media' => 'Upload Audio / Video',
            'museum_id' => 'Identificativo del Museo di Appartenenza',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMuseum()
    {
        return $this->hasOne(Museum::className(), ['museum_id' => 'museum_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishedArtwork()
    {
        return $this->hasOne(PublishedArtwork::className(), ['artwork_id' => 'artwork_id']);
    }
}
