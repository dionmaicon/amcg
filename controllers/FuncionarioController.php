<?php

namespace app\controllers;

use app\models\PasswdForm;
use app\models\Protocolo;
use Yii;
use app\models\Funcionario;
use app\models\FuncionarioSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuncionarioController implements the CRUD actions for Funcionario model.
 */
class FuncionarioController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index','update', 'view', 'delete', 'passwd'],
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
     * Lists all Funcionario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuncionarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Funcionario model.
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
     * Creates a new Funcionario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Funcionario();

        $id = Yii::$app->user->id;
        $funcionario = Funcionario::findOne(['id_funcionario' => $id]);

       if($funcionario->acesso == 0){

           if ($model->load(Yii::$app->request->post())) {

               $transaction = \Yii::$app->db->beginTransaction();

               try {

                   $pass = self::randomPassword();

                   $model->password = md5($pass);
                   $model->auth_key = null;
                   $model->token = null;
                   $model->ativo = true;


                   if ($model->save()) {

                       \Yii::$app->mailer->compose()
                           ->setFrom('suporte@amcgpg.com')
                           ->setTo($model->email)
                           ->setSubject('Cadastro realizado pelo Sistema de Protocolos AMCG-PG')
                           ->setHtmlBody(
                               'Olá, ' . $model->nome . '.<br><br>' .
                               'Seja bem vindo! <br><br>' .
                               'Seu cadastro foi realizado com sucesso! Mantenha seus dados seguros.<br><br>' .
                               'Seu usuario é: ' . $model->username . '<br>' .
                               'A senha de acesso é: ' . $pass . '<br><br>' .
                               'Atenciosamente: Associação dos Campos Gerais Ponta Grossa'
                           )
                           ->send();

                   }

                   $transaction->commit();


                   \Yii::$app->session->setFlash('success', 'Cadastro realizado com sucesso!');

                   return $this->render('create', [
                       'model' => new Funcionario(),

                   ]);

               }catch (\Exception $e){
                   $transaction->rollBack();


                   \Yii::$app->session->setFlash('error', 'Ocorreu um erro ao tentar cadastrar.');

                   return $this->render('/site/error',[
                       'message'=> $e,
                       'classe'=> "/funcionario",
                       'name'=> $e,
                   ]);

               }

           } else {
               return $this->render('create', [
                   'model' => $model,
               ]);
           }

       }

       return $this->render('/site/error', [
           'name' => "Acesso Negado",
           'classe'=>"/funcionario",
           'message' => "Você não tem os privilégios necessários para adicionar novos usuários.",
       ]);

    }

    /**
     * Updates an existing Funcionario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $id_ctrl = Yii::$app->user->id;
        $controle_acesso = Funcionario::findOne(['id_funcionario' => $id_ctrl]);
        $model = $this->findModel($id);
        if($controle_acesso->acesso > 0){

            return $this->render('/site/error', [
                'name' => "Acesso Negado",
                'classe'=>"/funcionario",
                'message' => "Você não tem os privilégios necessários para atualizar usuários.",
            ]);

        }else{

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_funcionario]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

//    /**
//     * Deletes an existing Funcionario model.
//     * If deletion is successful, the browser will be redirected to the 'index' page.
//     * @param integer $id
//     * @return mixed
//     */
//    public function actionDelete($id)
//    {
//        //$this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Funcionario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Funcionario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Funcionario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPasswd(){

        $model = new PasswdForm();

        $id = Yii::$app->user->id;
        $usuario = Funcionario::findOne(['id_funcionario'=>$id]);

        if(isset($_POST['PasswdForm'])){

            $old_password = $_POST['PasswdForm']['old_password'];
            $new_password = $_POST['PasswdForm']['new_password'];
            $repeat_password = $_POST['PasswdForm']['repeat_password'];


            $valid = false;
            if($usuario->password == md5($old_password)){

                $valid = true ;
            }


            if($valid){

                $usuario->password = md5($new_password);

                if($usuario->save(false)){

                    \Yii::$app->mailer->compose()
                        ->setFrom('suporte@amcgpg.com')
                        ->setTo($usuario->email)
                        ->setSubject('Alteração de senha AMCG')
                        ->setHtmlBody(
                            'Olá, '. $usuario->nome .'.<br><br>'.
                            'Sua senha foi alterada! <br><br>'.
                            'Sua nova senha é: '. $new_password .'<br>'.
                            'Se você não solicitou a troca, entre em contato com o suporte.<br>
                                <br><br>Atenciosamente: Suporte Associação dos Campos Gerais - Ponta Grossa'
                        )
                        ->send();


                    \Yii::$app->session->setFlash('success', 'A senha foi alterada. A sua nova senha está sendo enviada por email');
                    return $this->refresh();
                }else{
                    \Yii::$app->session->setFlash('error', 'Não foi possível alterar a senha.');
                    return $this->render('passwd',[
                        'model' => $model
                    ]);
                }
            }else{

                \Yii::$app->session->setFlash('error', 'Desculpe, mas a sua senha não está correta.');
                return $this->render('passwd',[
                    'model' => $model
                ]);

            }

        }
        
        return $this->render('passwd',[
            'model'=>$model
        ]);
        
    }

    static function randomPassword() {
        $alphabet = 'abcdefgh12345ijklmnop!@#$%*()qrstuvwxyzABCDEFGHIJK67890LMNOPQRSTUVWXYZ';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}