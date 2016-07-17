<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "joblog".
 *
 * @property string $job_id
 * @property integer $templates_template_id
 * @property string $job_started
 * @property string $job_stopped
 * @property integer $devices_to_backup
 * @property integer $devices_per_backup_thread
 * @property integer $backup_thread_count
 * @property string $job_log
 * @property string $job_status
 *
 * @property Backups[] $backups
 * @property Templates $templatesTemplate
 * @property Threadlog[] $threadlogs
 */
class Joblog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'joblog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id, job_id', 'job_started', 'job_stopped', 'devices_to_backup', 'devices_per_backup_thread', 'backup_thread_count', 'job_log'], 'required'],
            [['templates_template_id', 'devices_to_backup', 'devices_per_backup_thread', 'backup_thread_count'], 'integer'],
            [['job_started', 'job_stopped'], 'safe'],
            [['job_log', 'job_status'], 'string'],
            [['job_id'], 'string', 'max' => 128],
            [['templates_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Templates::className(), 'targetAttribute' => ['templates_template_id' => 'template_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        	'internal_id' => Yii::t('app', 'Internal ID'),        		
            'job_id' => Yii::t('app', 'Job ID'),
            'templates_template_id' => Yii::t('app', 'Backup template'),
            'job_started' => Yii::t('app', 'Job started'),
            'job_stopped' => Yii::t('app', 'Job stopped'),
            'devices_to_backup' => Yii::t('app', 'Devices to backup'),
            'devices_per_backup_thread' => Yii::t('app', 'Devices per backup thread'),
            'backup_thread_count' => Yii::t('app', 'Backup threads spawned'),
            'job_log' => Yii::t('app', 'Job log'),
            'job_status' => Yii::t('app', 'Job status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackups()
    {
        return $this->hasMany(Backups::className(), ['jobs_job_id' => 'job_id']);
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
        return $this->hasMany(Threadlog::className(), ['jobs_job_id' => 'job_id']);
    }

    /**
     * @inheritdoc
     * @return JoblogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JoblogQuery(get_called_class());
    }
}
