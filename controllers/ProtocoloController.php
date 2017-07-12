<?php

namespace app\controllers;

use app\models\Anexo;
use app\models\Departamento;
use app\models\Funcionario;
use app\models\MeusProtocolos;
use app\models\UploadForm;
use Yii;
use app\models\Protocolo;
use app\models\ProtocoloSearch;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProtocoloController implements the CRUD actions for Protocolo model.
 */
class ProtocoloController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', ],
                'rules' => [
                    [
                        'actions' => ['index','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post','get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Protocolo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProtocoloSearch();
        $id = Yii::$app->user->id;
        $usuario = Funcionario::findOne(["id_funcionario"=>$id]);
        $usuario->id_departamento;


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Protocolo model.
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
     * Creates a new Protocolo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     *
     * Array ( [_csrf] => 6m1EK19PocRCDJZ9AnmSqfi4Sgj9ceKTDfAa8JQh6WCtOj5bBj_thRNHuxxBP-fwm4ovRpdB0NBdmn_Jx3iONQ== [Protocolo] => Array ( [titulo] => Teste [descricao] =>
    Teste

    [responsavel] => Dion [tipo_pessoa] => f [cpf] => 024.097.870-61 [cnpj] => [email] => dionmaicon@outlook.com [telefone] => (054) 99555-6666 [prioridade] => Baixa [id_funcionario] => 3 ) )
     *
     */
    public function actionNew(){
        $model = new Protocolo();

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $model->id_funcionario = 1;
                $date = date("Y-m-d H:i:s", time());
                $model->data_ultima_atualizacao = $date;
                $model->data_abertura = $date;
                $model->data_fechamento = null;
                $model->status = "Novo";
                $codigo_unico = false;
                $codigo_busca = "";
                while(!$codigo_unico){
                    $codigo_busca = self::randomBusca();
                    $protocolo = Protocolo::findOne(['codigo_busca'=>$codigo_busca]);

                    if ($protocolo == null){
                        $codigo_unico = true;
                    }
                }
                $model->codigo_busca = $codigo_busca;

                $atribuicao = new MeusProtocolos();
                $atribuicao->id_departamento = 1;
                $atribuicao->data_atribuicao = $date;



                if($model->save(false)){
                    $atribuicao->id_protocolo = $model->id_protocolo;

                    $caminho = '../anexos/'.$codigo_busca;

                    FileHelper::createDirectory($caminho, 0775,true);

                    if($atribuicao->save(false)){

                        enviarEmail($model->email, $model->responsavel, $codigo_busca);

                    };
                }

                $transaction->commit();


                \Yii::$app->session->setFlash('success', 'Protocolo aberto com sucesso!');

                return $this->render('view', [
                    'model' => $model,

                ]);

            }catch (\Exception $e){
                $transaction->rollBack();

                \Yii::$app->session->setFlash('error', 'Ocorreu um erro ao tentar cadastrar.');

                return $this->render('create',[
                    'model'=> $model,
                ]);

            }

            //  return $this->redirect(['/site/error', 'id' => $model->id_protocolo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    public function actionCreate(){

        $model = new Protocolo();
        $modelUpload = new UploadForm();

        $id_funcionario = Yii::$app->user->id;
        $funcionario = Funcionario::findOne(['id_funcionario'=>$id_funcionario]);


        $codigo_busca = $this->gerarCodigoDeBusca();

        $caminho = '../anexos/'.$codigo_busca.'/';

        FileHelper::createDirectory($caminho, 0775,true);


        $model->codigo_busca = $codigo_busca;

        if ($model->load(Yii::$app->request->post())) {



            $transaction = \Yii::$app->db->beginTransaction();

            try {

                $modelUpload->inputFile = UploadedFile::getInstance($modelUpload, 'inputFile');
                $resposta = $modelUpload->upload($model->codigo_busca);

                $upload = true;

                if ( $resposta == 'erro') {
                      $upload = false;
                }

                $model->id_funcionario = $id_funcionario;
                $date = date("Y-m-d H:i:s", time());
                $model->data_ultima_atualizacao = $date;
                $model->data_abertura = $date;
                $model->data_fechamento = null;
                $model->status = "Novo";



                $atribuicao = new MeusProtocolos();
                $atribuicao->id_departamento = $funcionario->id_departamento;
                $atribuicao->data_atribuicao = $date;

                if($model->save(false)){

                    $atribuicao->id_protocolo = $model->id_protocolo;

                    if($upload){

                            $anexo = new Anexo();
                            $anexo->id_protocolo = $model->id_protocolo;
                            $anexo->caminho = $resposta;
                            $anexo->save();

                    }

                    if($atribuicao->save(false)){

                        $this->enviarEmail($model->email, $model->responsavel, $model->codigo_busca);

                    };
                }

                $transaction->commit();


                \Yii::$app->session->setFlash('success', 'Protocolo aberto com sucesso!');

                return $this->render('view', [
                    'model' => $model,

                ]);

            }catch (\Exception $e){
                $transaction->rollBack();

                \Yii::$app->session->setFlash('error', 'Ocorreu um erro ao tentar cadastrar.'.$e);

                return $this->render('create',[
                    'model'=> $model,
                    'modelUpload' => $modelUpload,
                ]);

            }

          //  return $this->redirect(['/site/error', 'id' => $model->id_protocolo]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelUpload'=>$modelUpload,
            ]);
        }
    }

    static function gerarCodigoDeBusca(){
        $codigo_unico = false;
        $codigo_busca = "";
        while(!$codigo_unico){
            $codigo_busca = self::randomBusca();
            $protocolo = Protocolo::findOne(['codigo_busca'=>$codigo_busca]);

            if ($protocolo == null){
                $codigo_unico = true;
            }
        }
        return $codigo_busca;

    }

    static function enviarEmail($email, $responsavel, $codigo){

        \Yii::$app->mailer->compose()
            ->setFrom('suporte@amcgpg.com')
            ->setTo($email)
            ->setSubject('Protocolo criado pelo Sistema de Protocolos AMCG-PG')
            ->setHtmlBody(
                'Olá, ' . $responsavel . '.<br><br>' .
                'Seu protocolo foi criado com sucesso! Você pode consulta-lo na nossa página de consultas.<br>'.
                '<a href:"http://amcgsistemas.com"> Associação dos Campos Gerais</a><br><br>'.
                'O Código para a consulta sobre o  andamento do pedido é:'. $codigo .' <br><br>'.
                'Atenciosamente: Associação dos Campos Gerais Ponta Grossa'
            )
            ->send();

    }

    /**
     * Updates an existing Protocolo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUpload =  new UploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_protocolo]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelUpload'=> $modelUpload,
            ]);
        }
    }

//    /**
//     * Deletes an existing Protocolo model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
////     */
////    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Protocolo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Protocolo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Protocolo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    static function randomBusca() {
        $alphabet = 'ABCDEFGHIJ1234567890KLMNOPQRSTUVWXYZ';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass); //turn the array into a string
    }

    public function actionBusca($codigo_busca)
    {

        $model = Protocolo::findOne(['codigo_busca'=>$codigo_busca]);
        if($model){
            return $this->renderPartial('busca', [
                'model' => $model,
            ]);

        }else{

            return $this->redirect('/?p=protocolo.php&q=erro');

        }

    }
}