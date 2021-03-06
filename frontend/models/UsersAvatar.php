<?php

namespace frontend\models;

use yii\db\{ActiveRecord, ActiveQuery};


/**
 * This is the model class for table "users_avatar".
 *
 * @property int $id
 * @property string $image_path
 * @property int|null $account_id
 *
 * @property Users[] $users
 */
class UsersAvatar extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'users_avatar';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['image_path'], 'required'],
            [['image_path'], 'string', 'max' => 45],
            [['account_id'], 'integer'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'image_path' => 'account ID',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers(): ActiveQuery
    {
        return $this->hasOne(Users::class, ['account_id' => 'id']);
    }
}
