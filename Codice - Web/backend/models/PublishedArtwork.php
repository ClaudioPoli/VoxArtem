<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "published_artwork".
 *
 * @property integer $published_artwork_id
 * @property string $name
 * @property string $description
 * @property string $audio
 * @property string $video
 * @property integer $artwork_id
 *
 * @property Artwork $artwork
 * @property QrCode $qrCode
 */
class PublishedArtwork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'published_artwork';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'artwork_id'], 'required'],
            [['artwork_id'], 'integer'],
            [['name', 'audio', 'video'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 511],
            [['name'], 'unique'],
            [['artwork_id'], 'unique'],
            [['artwork_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artwork::className(), 'targetAttribute' => ['artwork_id' => 'artwork_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'published_artwork_id' => 'ID',
            'name' => 'Nome',
            'description' => 'Descrizione',
            'audio' => 'Link Audio',
            'video' => 'Link Video',
            'artwork_id' => "Identificativo dell'opera",
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtwork()
    {
        return $this->hasOne(Artwork::className(), ['artwork_id' => 'artwork_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQrCode()
    {
        return $this->hasOne(QrCode::className(), ['published_artwork_id' => 'published_artwork_id']);
    }
}
