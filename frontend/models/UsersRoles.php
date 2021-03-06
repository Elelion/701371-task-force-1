<?php

namespace frontend\models;

use Yii;
use yii\db\{ActiveRecord, ActiveQuery};


/**
 * @note
 * this is the model class for table "users_roles".
 *
 * @property int $id
 * @property string $title
 * @property string $key_code
 *
 * @property Users[] $users
 */
class UsersRoles extends ActiveRecord
{
    const CUSTOMER_KEY_CODE = 'customer';

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'users_roles';
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title', 'key_code'], 'required'],
            [['title'], 'string', 'max' => 32],
            [['key_code'], 'string', 'max' => 64],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'key_code' => 'Key Code',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(Users::class, ['role_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->key_code == self::CUSTOMER_KEY_CODE;
    }
}
