<?php

namespace backend\controllers;

use Yii;
use backend\models\PublishedArtwork;
use backend\models\PublishedArtworkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\IntegrityException;

/**
 * PublishedArtworkController implements the CRUD actions for PublishedArtwork model.
 */
class PublishedArtworkController extends Controller
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
     * Lists all PublishedArtwork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublishedArtworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PublishedArtwork model.
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
     * Creates a new PublishedArtwork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PublishedArtwork();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->published_artwork_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PublishedArtwork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->published_artwork_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PublishedArtwork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', "Impossibile eliminare l'opera d'arte pubblicata selezionata: ad essa è associato un QR Code");
        }

        return $this->redirect(['index']);
    }
    
    /**
     * Return option values for QR Code generation of the specified
     * artwork
     * @param type $name artwork name
     */
    public function actionList($name) {
        $artwork = ArrayHelper::toArray(PublishedArtwork::findOne(['name' => $name]));
        $title = array_values($artwork)[1];
        $description = array_values($artwork)[2];
        $audioURL = array_values($artwork)[3];
        $videoURL = array_values($artwork)[4];
        
        if (!empty($audioURL) && !empty($videoURL)) {
            $qrString = $title . '§' . $description . '§' . $audioURL . '§' . $videoURL;
        }
        
        else if (empty($audioURL) && !empty($videoURL)) {
            $qrString = $title . '§' . $description . '§' . $audioURL;
        }
        
        else if (!empty($audioURL) && empty($videoURL)) {
            $qrString = $title . '§' . $description . '§' . $videoURL;
        }
        
        else {
            $qrString = $title . '§' . $description;
        }
        
        echo '<option value="'.$qrString.'">'.$qrString.'</options>';
    }
    
    /**
     * Return option values for id of the specified artwork
     * @param type $name artwork name
     */
    public function actionId($name) {
        $artwork = ArrayHelper::toArray(PublishedArtwork::findOne(['name' => $name]));
        $id = array_values($artwork)[0];
        echo '<option value="'.$id.'">'.$id.'</options>';
    }

    /**
     * Finds the PublishedArtwork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PublishedArtwork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PublishedArtwork::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
