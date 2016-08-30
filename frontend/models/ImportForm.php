<?php 

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use frontend\models\Devices;
use frontend\models\Templates;

class ImportForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $importFile;
    public $defaultTemplate = 0;
    public $backupStatus = false;
    public $importedDevices = 0;    
    public $defaultTemplateName = '';    

    public function rules()
    {
        return [
        	[['defaultTemplate', 'backupStatus'], 'required'],        		
            [['importFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
       ];
    }
    
    public function attributeLabels()
    {
    	return [
    			'importFile' => 'File',
    			'defaultTemplate' => 'Assign template',    			
    			'backupStatus' => 'Backup status',    			
    			'importedDevices' => 'Imported devices count',    			
    	];
    }
    
    
    public function import()
    {
        if ($this->validate()) {
            $this->importFile->saveAs('uploads/' . $this->importFile->baseName . '.' . $this->importFile->extension);
            $items = explode(PHP_EOL, file_get_contents('uploads/' . $this->importFile->name));

			$this->defaultTemplateName = Templates::findOne($this->defaultTemplate)->template_name;
			
			foreach ($items as $item) {
				if ($item) {
					$device = new Devices();
					$device->device_address = trim($item,"\r\n");
					$device->device_hostname = '';					
					$device->templates_template_id = $this->defaultTemplate;
					$device->backup_status = $this->backupStatus;
					if ($device->save()) ++$this->importedDevices;
				}
			}            
            return $this;
        } else {
            return false;
        }
    }
    
}