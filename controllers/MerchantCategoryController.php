<?php

namespace app\controllers;

use app\models\MerchantCategoriy;
use app\models\MerchantCategoriySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MerchantCategoryController implements the CRUD actions for MerchantCategoriy model.
 */
class MerchantCategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MerchantCategoriy models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MerchantCategoriySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MerchantCategoriy model.
     * @param int $merchant_id Merchant ID
     * @param int $category_id Category ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($merchant_id, $category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($merchant_id, $category_id),
        ]);
    }

    /**
     * Creates a new MerchantCategoriy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MerchantCategoriy();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'merchant_id' => $model->merchant_id, 'category_id' => $model->category_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MerchantCategoriy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $merchant_id Merchant ID
     * @param int $category_id Category ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($merchant_id, $category_id)
    {
        $model = $this->findModel($merchant_id, $category_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'merchant_id' => $model->merchant_id, 'category_id' => $model->category_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MerchantCategoriy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $merchant_id Merchant ID
     * @param int $category_id Category ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($merchant_id, $category_id)
    {
        $this->findModel($merchant_id, $category_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MerchantCategoriy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $merchant_id Merchant ID
     * @param int $category_id Category ID
     * @return MerchantCategoriy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($merchant_id, $category_id)
    {
        if (($model = MerchantCategoriy::findOne(['merchant_id' => $merchant_id, 'category_id' => $category_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
