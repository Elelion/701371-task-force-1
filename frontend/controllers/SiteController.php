<?php

namespace frontend\controllers;

use common\models\LoginForm;
use TaskForce\components\AuthVKontakte;
use Yii;
use yii\authclient\clients\VKontakte;
use yii\authclient\AuthAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

use yii\base\Exception as BaseException;
use yii\db\Exception as DbException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'login'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'login'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'signup' => ['POST'],
                    'login' => ['POST'],
                    'logout' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],

            /**
             * @note
             * for login from VK.com
             * chapter 9.3 - socialization
             *
             * \Collection - look in the config/main - authClientCollection
             */
            'auth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return Response
     */
    public function actionIndex(): Response
    {
        return $this->redirect(['tasks/index']);
    }

    /**
     * Logs in a user.
     *
     * @return string|Response
     */
    public function actionLogin(): string
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @note
     * login from VK
     *
     * @param VKontakte $client
     * @return Response|null
     * @throws BaseException
     * @throws DbException
     */
    public function onAuthSuccess(VKontakte $client): ?Response
    {
        if (AuthVKontakte::onAuthSuccess($client)) {
            return $this->goHome();
        }

        return null;
    }
}
