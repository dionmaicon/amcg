<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $inputFile;

    public function rules()
    {
        return [
            [['inputFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf, docx'],
        ];
    }

    public function upload($codigo_busca)
    {
        if ($this->validate()) {
            if($this->inputFile == null){
                return 'erro';
            }
            $caminho = '../anexos/' .$codigo_busca .'/'. $this->inputFile->baseName . '.' . $this->inputFile->extension;
            echo $caminho;
            $this->inputFile->saveAs($caminho);
            return $caminho;
        } else {
            return 'erro';
        }
    }
}