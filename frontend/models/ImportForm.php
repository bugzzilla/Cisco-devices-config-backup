<?php 

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $importFile;

    public function rules()
    {
        return [
            [['importFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt, csv'],
        ];
    }
    
    public function attributeLabels()
    {
    	return [
    			'importFile' => 'CSV file',
    	];
    }
    
    
    public function upload()
    {
        if ($this->validate()) {
            $this->importFile->saveAs('uploads/' . $this->importFile->baseName . '.' . $this->importFile->extension);
            return true;
        } else {
            return false;
        }
    }
}