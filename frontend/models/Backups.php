<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "backups".
 *
 * @property integer $backup_id
 * @property integer $devices_device_id
 * @property string $jobs_job_id
 * @property string $config_datetime
 * @property string $storage_datetime
 * @property string $storage
 *
 * @property Devices $devicesDevice
 * @property Joblog $jobsJob
 * @property Threadlog[] $threadlogs
 */
class Backups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'backups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['devices_device_id'], 'integer'],
            [['jobs_job_id', 'config_datetime', 'storage_datetime', 'storage'], 'required'],
            [['storage_datetime'], 'safe'],
            [['storage'], 'string'],
            [['jobs_job_id'], 'string', 'max' => 128],
            [['config_datetime'], 'string', 'max' => 100],
            [['devices_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['devices_device_id' => 'device_id']],
            [['jobs_job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Joblog::className(), 'targetAttribute' => ['jobs_job_id' => 'job_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'backup_id' => Yii::t('app', 'Backup ID'),
            'devices_device_id' => Yii::t('app', 'Device'),
            'jobs_job_id' => Yii::t('app', 'Backup job'),
            'config_datetime' => Yii::t('app', 'Config datetime'),
            'storage_datetime' => Yii::t('app', 'Storage datetime'),
            'storage' => Yii::t('app', 'Storage'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesDevice()
    {
        return $this->hasOne(Devices::className(), ['device_id' => 'devices_device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobsJob()
    {
        return $this->hasOne(Joblog::className(), ['job_id' => 'jobs_job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThreadlogs()
    {
        return $this->hasMany(Threadlog::className(), ['backups_backup_id' => 'backup_id']);
    }

    /**
     * @inheritdoc
     * @return BackupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BackupsQuery(get_called_class());
    }
}
