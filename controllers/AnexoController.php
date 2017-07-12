<?php
namespace app\controllers;

use app\models\Anexo;
use app\models\MeusProtocolos;
use app\models\Protocolo;
use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;

class AnexoController extends Controller
{
    public function actionUpload($id_protocolo)
    {

        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $protocolo =  Protocolo::findOne(['id_protocolo'=> $id_protocolo]);

            $model->inputFile = UploadedFile::getInstance($model, 'inputFile');
            $retorno = $model->upload($protocolo->codigo_busca);

            if ( $retorno == 'erro') {

                return "Não foi possivel fazer o Upload do arquivo";
            }else{

                $anexo = new Anexo();
                $anexo->id_protocolo = $protocolo->id_protocolo;
                $anexo->caminho = $retorno;
                $anexo->save();

            }
            $atribuicao = MeusProtocolos::findOne(['id_protocolo'=>$id_protocolo]);
            return  $this->render('/meus-protocolos/view', ['model' => $atribuicao]);
        }

        return $this->render('upload', ['model' => $model]);
    }

}