<?php

namespace backend\controllers;

use Yii;
use backend\models\Artwork;
use backend\models\ArtworkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\db\IntegrityException;

/**
 * ArtworkController implements the CRUD actions for Artwork model.
 */
class ArtworkController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Artwork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArtworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Artwork model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Artwork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artwork();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->media = UploadedFile::getInstance($model, 'media');
            if ($model->media !== NULL && $model->media->extension == 'mp4') {
            	$name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $model->name));
                $model->video = 'http://voxartem.altervista.org/backend/web/video/' . $name . "." . $model->media->extension;
                $model->save();
                $model->media->saveAs(Yii::$app->basePath . '/web/video/' . $name . "." . $model->media->extension);
            } else if ($model->media !== NULL && $model->media->extension == 'mp3') {
            	$name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $model->name));
                $model->audio = 'http://voxartem.altervista.org/backend/web/audio/' .  $name . "." . $model->media->extension;
                $model->save();
                $model->media->saveAs(Yii::$app->basePath . '/web/audio/' .  $name . "." . $model->media->extension);
            }
            return $this->redirect(['view', 'id' => $model->artwork_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Artwork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           $model->media = UploadedFile::getInstance($model, 'media');
            if ($model->media !== NULL && $model->media->extension == 'mp4') {
            	$name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $model->name));
                $model->video = 'http://voxartem.altervista.org/backend/web/video/' . $name . "." . $model->media->extension;
                $model->save();
                $model->media->saveAs(Yii::$app->basePath . '/web/video/' . $name . "." . $model->media->extension);
            } else if ($model->media !== NULL && $model->media->extension == 'mp3') {
            	$name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $model->name));
                $model->audio = 'http://voxartem.altervista.org/backend/web/audio/' .  $name . "." . $model->media->extension;
                $model->save();
                $model->media->saveAs(Yii::$app->basePath . '/web/audio/' .  $name . "." . $model->media->extension);
            }
            return $this->redirect(['view', 'id' => $model->artwork_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Artwork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', "Impossibile eliminare l'opera d'arte selezionata: ad essa è associata un'opera d'arte pubblicata");
        }

        return $this->redirect(['index']);
    }
    
    /**
     * Return option values for short and long descriptions of the specified
     * artwork
     * @param type $name artwork name
     */
    public function actionList($name)
    {
        $artwork = ArrayHelper::toArray(Artwork::findOne(['name' => $name]));
        $shortDescription = array_values($artwork)[2];
        $longDescription = array_values($artwork)[3];
        
        if (strlen($shortDescription) > 100) {
            $shortDescription = mb_substr($shortDescription, 0, 100)."...";
        }
        
        if (strlen($longDescription) > 100) {
            $longDescription = mb_substr($longDescription, 0, 100)."...";
        }
        
        echo '<option value="'.array_values($artwork)[2].'">'.$shortDescription.'</options>';
        
        if (!empty(array_values($artwork)[3])) {
            echo '<option value="'.array_values($artwork)[3].'">'.$longDescription.'</options>';
        }
    }
    
    /**
     * Return option values for audio url of the specified
     * artwork
     * @param type $name artwork name
     */
    public function actionAudio($name)
    {
        $artwork = ArrayHelper::toArray(Artwork::findOne(['name' => $name]));
        $audio = array_values($artwork)[4];
        
        if (strlen($audio) > 100) {
            $audio = mb_substr($audio, 0, 100)."...";
        }
        if (!empty(array_values($artwork)[4])) {
            echo '<option value="'.array_values($artwork)[4].'">'.$audio.'</options>';
        }
    }
    
    /**
     * Return option values for video url of the specified
     * artwork
     * @param type $name artwork name
     */
    public function actionVideo($name)
    {
        $artwork = ArrayHelper::toArray(Artwork::findOne(['name' => $name]));
        $video = array_values($artwork)[5];
        
        if (strlen($video) > 100) {
            $video = mb_substr($audio, 0, 100)."...";
        }
        if (!empty(array_values($artwork)[5])) {
            echo '<option value="'.array_values($artwork)[5].'">'.$video.'</options>';
        }
    }
    
    /**
     * Return option values for id of the specified artwork
     * @param type $name artwork name
     */
    public function actionId($name)
    {
        $artwork = ArrayHelper::toArray(Artwork::findOne(['name' => $name]));
        $id = array_values($artwork)[0];
        echo '<option value="'.$id.'">'.$id.'</options>';
    }

    /**
     * Finds the Artwork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artwork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artwork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
