<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qr_code".
 *
 * @property integer $qr_code_id
 * @property string $string_code
 * @property integer $published_artwork_id
 *
 * @property PublishedArtwork $publishedArtwork
 */
class QrCode extends \yii\db\ActiveRecord
{
    
    public $name;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qr_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'string_code', 'published_artwork_id'], 'required'],
            [['published_artwork_id'], 'integer'],
            [['string_code'], 'string', 'max' => 767],
            [['string_code'], 'unique'],
            [['published_artwork_id'], 'unique'],
            [['published_artwork_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublishedArtwork::className(), 'targetAttribute' => ['published_artwork_id' => 'published_artwork_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qr_code_id' => 'ID',
            'string_code' => 'Stringa Generata',
            'name' => "Nome dell'Opera",
            'published_artwork_id' => "Identificativo dell'Opera Pubblicata",
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublishedArtwork()
    {
        return $this->hasOne(PublishedArtwork::className(), ['published_artwork_id' => 'published_artwork_id']);
    }
}
