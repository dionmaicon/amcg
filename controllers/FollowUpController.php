<?php

namespace app\controllers;

use app\models\Funcionario;
use app\models\FollowUp;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * FollowUpController implements the CRUD actions for FollowUp model.
 */
class FollowUpController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index','view', 'create','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all FollowUp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->id;
        $usuario = Funcionario::findOne(["id_funcionario"=>$id]);


        $dataProvider = new ActiveDataProvider([
            'query' => FollowUp::find()->where(['id_funcionario'=> $usuario->id_funcionario]),
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single FollowUp model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id_funcionario = Yii::$app->user->id;


        $model = FollowUp::findOne(['id_funcionario'=> $id_funcionario,'id_follow_up'=>$id]);

        if ($model){

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }

        return $this->render('/site/error', [
            'name' => 'Erro de Permissão',
            'message'=> 'Você não tem permissão para acessar este follow up!'
        ]);


    }
    /**
     * Creates a new FollowUp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_protocolo
     * @return mixed
     */
    public function actionCreate( $id_protocolo)
    {
        $model = new FollowUp();
        $id = Yii::$app->user->id;
        $usuario = Funcionario::findOne(['id_funcionario' => $id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->data_ultima_atualizacao = date("Y-m-d H:i:s", time());
            $model->id_funcionario = $usuario->id_funcionario;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id_follow_up]);
        } else {
            $model->id_protocolo = $id_protocolo;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing FollowUp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_follow_up]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
//    /**
//     * Deletes an existing FollowUp model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//        return $this->redirect(['index']);
//    }
    /**
     * Finds the FollowUp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FollowUp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FollowUp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
