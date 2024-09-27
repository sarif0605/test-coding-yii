<?php

namespace app\controllers;

use app\models\Queue;
use app\models\QueueSearch;
use app\models\Service;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * QueueController implements the CRUD actions for Queue model.
 */
class QueueController extends Controller
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
     * Lists all Queue models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new QueueSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Queue model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Memastikan bahwa antrian yang ditampilkan adalah milik pengguna yang sedang login
        if ($model->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('You are not allowed to view this queue.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Queue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($service_id)
    {
        $model = new Queue();
        $service = Service::findOne($service_id);

        if (!$service) {
            throw new NotFoundHttpException('The requested service does not exist.');
        }

        // Mengatur nomor antrian
        $lastQueue = Queue::find()
            ->where(['merchant_id' => $service->merchant_id])
            ->orderBy(['queue_number' => SORT_DESC])
            ->one();
        $model->queue_number = $lastQueue ? $lastQueue->queue_number + 1 : 1;
        $model->merchant_id = $service->merchant_id;
        $model->service_id = $service->id;
        $model->queue_status = 'waiting';
        $model->user_id = Yii::$app->user->id;
        $model->created_at = date('Y-m-d H:i:s');

        // if ($this->request->isPost) {
        //     var_dump($this->request->post());
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         Yii::$app->session->setFlash('success', 'Nomor antrian Anda adalah: ' . $model->queue_number);
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     } else {
        //         // Tampilkan kesalahan spesifik
        //         Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat menyimpan antrian Anda:<br>' . print_r($model->getErrors(), true));
        //     }
        // }      
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Nomor antrian Anda adalah: ' . $model->queue_number);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat menyimpan antrian Anda:<br>' . print_r($model->getErrors(), true));
        }            

        return $this->render('create', [
            'model' => $model,
            'service' => $service,
        ]);
    }

    /**
     * Updates an existing Queue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Queue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Queue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Queue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Queue::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
