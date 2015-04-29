<?php

namespace bupy7\pages\controllers;

use Yii;
use bupy7\pages\models\Page;
use bupy7\pages\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use bupy7\pages\Module;

/**
 * ManagerController implements the CRUD actions for Page model.
 */
class ManagerController extends Controller
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->actionUpdate(null);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer|null $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        if ($id === null) {
            $model = new Page;
        } else {
            $model = $this->findModel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } 
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Module::t('PAGE_NOT_FOUND'));
    }
    
}
