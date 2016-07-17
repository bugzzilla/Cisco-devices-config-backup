<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "templates".
 *
 * @property integer $template_id
 * @property string $template_name
 * @property string $cisco_secret
 * @property string $ssh_username
 * @property string $ssh_password
 * @property integer $ssh_port
 * @property string $device_config
 * @property string $storage
 *
 * @property Devices[] $devices
 * @property Joblog[] $joblogs
 */
class Templates extends \yii\db\ActiveRecord
{
	
	public  $confirm_cisco_secret;
	public  $confirm_ssh_password;	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name', 'cisco_secret', 'ssh_username', 'ssh_password', 'ssh_port', 'device_config', 'storage'], 'required'],
            [['ssh_port'], 'integer'],
            [['template_name', 'cisco_secret', 'ssh_username', 'ssh_password'], 'string', 'max' => 100],
            [['device_config'], 'string', 'max' => 255],
            [['storage'], 'string', 'max' => 1024],
        		
        	['confirm_cisco_secret', 'required'],
        	['confirm_cisco_secret', 'compare', 'compareAttribute' => 'cisco_secret', 'message' => "Secret don not match"],
        		
        	['confirm_ssh_password', 'required'],
        	['confirm_ssh_password', 'compare', 'compareAttribute' => 'ssh_password', 'message' => "SSH password don not match"],
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'template_id' => Yii::t('app', 'Template ID'),
            'template_name' => Yii::t('app', 'Template Name'),
            'cisco_secret' => Yii::t('app', 'Secret'),
            'ssh_username' => Yii::t('app', 'SSH username'),
            'ssh_password' => Yii::t('app', 'SSH Password'),
            'ssh_port' => Yii::t('app', 'SSH port'),
            'device_config' => Yii::t('app', 'Device config'),
            'storage' => Yii::t('app', 'Config upload path'),
        	'confirm_ssh_password' => Yii::t('app', 'Confirm SSH password'),			        		
        	'confirm_cisco_secret' => Yii::t('app', 'Confirm secret'),        		
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasMany(Devices::className(), ['templates_template_id' => 'template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJoblogs()
    {
        return $this->hasMany(Joblog::className(), ['templates_template_id' => 'template_id']);
    }

    /**
     * @inheritdoc
     * @return TemplatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TemplatesQuery(get_called_class());
    }
}
