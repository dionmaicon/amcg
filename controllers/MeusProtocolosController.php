<?php

namespace app\controllers;

use app\models\Anexo;
use app\models\Atribuicao;
use app\models\Funcionario;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Yii;
use app\models\MeusProtocolos;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MeusProtocolosController implements the CRUD actions for MeusProtocolos model.
 */
class MeusProtocolosController extends Controller
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
                        'actions' => ['index','view', 'create'],
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
     * Lists all MeusProtocolos models.
     * @return mixed
     */
    public function actionIndex()
    {

        $id = Yii::$app->user->id;
        $usuario = Funcionario::findOne(["id_funcionario"=>$id]);


        $dataProvider = new ActiveDataProvider([
            'query' => MeusProtocolos::find()->where(['id_departamento'=> $usuario->id_departamento]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MeusProtocolos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id_funcionario = Yii::$app->user->id;
        $funcionario = Funcionario::findOne(['id_funcionario'=>$id_funcionario]);

        $model = MeusProtocolos::findOne(['id_departamento'=>$funcionario->id_departamento,'id_atribuicao'=>$id]);

        if ($model){

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }

        return $this->render('/site/error', [
            'name' => 'Acesso Negado',
            'message' => 'Você não tem permissão para visualizar '
        ]);

    }

    /**
     * Creates a new MeusProtocolos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @param  integer $id_protocolo
     */
    public function actionCreate($id_protocolo)
    {
        $model = new MeusProtocolos();
        $usuario = Funcionario::findOne(['id_funcionario'=>Yii::$app->user->id]);


        if ($model->load(Yii::$app->request->post())) {

            $consulta = MeusProtocolos::findOne(['id_protocolo'=>$model->id_protocolo, 'id_departamento'=>$model->id_departamento]);
            if ($consulta){

                \Yii::$app->session->setFlash('error', 'Não foi possivel atribuir. Departamento já consta como responsável!');
                $model->id_protocolo = $id_protocolo;
                $model->id_departamento = $usuario->id_departamento;

                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->data_atribuicao = date("Y-m-d H:i:s", time());

            $model->save();


            return $this->redirect(['/meus-protocolos/view', 'id' => $model->id_protocolo]);
        } else {

            $model->id_protocolo = $id_protocolo;
            $model->id_departamento = $usuario->id_departamento;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionDownload($caminho){
        if(file_exists($caminho)){
            Yii::$app->response->sendFile($caminho);
            return;
        }else{
            $this->render('download404');
        }
    }

    public function actionRemove($caminho, $id_atr){

        if(file_exists($caminho)){

            FileHelper::removeDirectory($caminho);

            $file = Anexo::findOne(['caminho'=> $caminho]);
             if($file != null){
                 $file->delete();
             }
            $model = MeusProtocolos::findOne(['id_atribuicao'=>$id_atr]);
            return $this->render('view', ['model' => $model]);

        }else{
            $this->render('download404');
        }
    }

//    /**
//     * Updates an existing MeusProtocolos model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id_atribuicao]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

//    /**
//     * Deletes an existing MeusProtocolos model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the MeusProtocolos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeusProtocolos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeusProtocolos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
