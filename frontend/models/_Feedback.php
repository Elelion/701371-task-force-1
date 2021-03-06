<?php

namespace frontend\models;

use yii\db\{ActiveRecord, ActiveQuery};


/**
 * @note
 * this is the model class for table "feedback".
 *
 * @property int $id
 * @property int|null $rating_id
 * @property int|null $account_id
 * @property int|null $task_id
 * @property int|null $status_id
 *
 * @property Task $task
 * @property Users $account
 * @property FeedbackStatus $status
 */
class Feedback extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'feedback';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['rating_id', 'account_id', 'task_id', 'status_id'], 'integer'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['account_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => FeedbackStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'rating_id' => 'Rating ID',
            'account_id' => 'Account ID',
            'task_id' => 'Task ID',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTask(): ActiveQuery
    {
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAccount(): ActiveQuery
    {
        return $this->hasOne(Users::class, ['id' => 'account_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getStatus(): ActiveQuery
    {
        return $this->hasOne(FeedbackStatus::class, ['id' => 'status_id']);
    }
}
