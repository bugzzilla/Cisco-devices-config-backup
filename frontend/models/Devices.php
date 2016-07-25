<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property integer $device_id
 * @property string $device_hostname
 * @property string $device_address
 * @property integer $templates_template_id
 * @property string $backup_status
 *
 * @property Backups[] $backups
 * @property Templates $templatesTemplate
 * @property Threadlog[] $threadlogs
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_address', 'templates_template_id', 'backup_status'], 'required'],
            [['templates_template_id'], 'integer'],
            [['device_hostname'], 'string', 'max' => 100],
            [['device_address'], 'string', 'max' => 15],
            [['backup_status'], 'string'],
            [['templates_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Templates::className(), 'targetAttribute' => ['templates_template_id' => 'template_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'device_hostname' => Yii::t('app', 'Device Hostname'),
            'device_address' => Yii::t('app', 'Device Address'),
            'templates_template_id' => Yii::t('app', 'Backup template'),
            'backup_status' => Yii::t('app', 'Backup status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackups()
    {
        return $this->hasMany(Backups::className(), ['devices_device_id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplatesTemplate()
    {
        return $this->hasOne(Templates::className(), ['template_id' => 'templates_template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThreadlogs()
    {
        return $this->hasMany(Threadlog::className(), ['devices_device_id' => 'device_id']);
    }

    /**
     * @inheritdoc
     * @return DevicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DevicesQuery(get_called_class());
    }
    
    public function getDeviceFullName() 
    {
    	if ($this->device_hostname)
    			return $this->device_hostname . ' (' . trim($this->device_address) . ')';
    		else
    			return  $this->device_address;
    }
}
