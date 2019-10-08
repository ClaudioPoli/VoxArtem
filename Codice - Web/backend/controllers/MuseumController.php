<?php

namespace backend\controllers;

use Yii;
use backend\models\Museum;
use backend\models\MuseumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\db\IntegrityException;

/**
 * MuseumController implements the CRUD actions for Museum model.
 */
class MuseumController extends Controller
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
     * Lists all Museum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MuseumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Museum model.
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
     * Creates a new Museum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Museum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->videoFile = UploadedFile::getInstance($model, 'videoFile');
            if ($model->videoFile !== NULL) {
                $name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $model->name));
                $model->video = "http://voxartem.altervista.org/backend/web/video/" . $name . "." . $model->videoFile->extension;
                $model->save();
                $model->videoFile->saveAs(Yii::$app->basePath . '/web/video/' . $name . "." . $model->videoFile->extension);
            }
            
            return $this->redirect(['view', 'id' => $model->museum_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Museum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->videoFile = UploadedFile::getInstance($model, 'videoFile');
            if ($model->videoFile !== NULL) {
                $name = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $model->name));
                $model->video = "http://voxartem.altervista.org/backend/web/video/" . $name . "." . $model->videoFile->extension;
                $model->save();
                $model->videoFile->saveAs(Yii::$app->basePath . '/web/video/' . $name . "." . $model->videoFile->extension);
            }
            
            return $this->redirect(['view', 'id' => $model->museum_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Museum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', "Impossibile eliminare il museo selezionato: ad esso sono associate una o più opere d'arte");
        }

        return $this->redirect(['index']);
    }
    
    /**
     * Returns option values for museum foreign key
     * @param name museum name
     */
    public function actionList($name) {
        $museum = ArrayHelper::toArray(Museum::findOne(['name' => $name]));
        $museum_id = array_values($museum)[0];
        echo '<option value="'.$museum_id.'">'.$museum_id.'</options>';
    }

    /**
     * Finds the Museum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Museum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Museum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
