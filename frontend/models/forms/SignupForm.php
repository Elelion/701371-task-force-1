<?php

namespace frontend\models\forms;

use Yii;
use yii\base\{Exception, Model};
use frontend\models\Users;


class SignupForm extends Model
{
    public string $email = '';
    public string $name = '';
    public int $city = 0;
    public string $password = '';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email', 'name', 'city', 'password'], 'required'],
            [['email', 'name', 'city', 'password'], 'safe'],

            [['email'], 'email'],

            [['city'], 'integer'],

            [['email', 'name', 'password'], 'string', 'max' => 64],

            [['name'], 'string', 'min' => 2],
            [['name'], 'trim'],
            [['email'], 'string', 'min' => 3],
            [['password'], 'string', 'min' => 8]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'email' => 'Почта',
            'name' => 'Имя',
            'city' => 'Город проживания',
            'password' => 'Пароль',
        ];
    }

    /**
     * @note
     * for registry a new user
     *
     * @return Users|null
     * @throws Exception
     */
    public function createUser(): ?Users
    {
        $user = new Users();
        $user->name = $this->name;
        $user->email =$this->email;
        $user->password =
            Yii::$app
                ->security
                ->generatePasswordHash($this->password);

        if (!$user->save()) {
            if ($user->hasErrors('email')) {
                $this->addError('email', 'email занят');
            }
            return null;
        }

        return $user;
    }
}
