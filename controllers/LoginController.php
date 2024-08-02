<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\{LoginForm, Usuario, ContactForm};
use yii\db\Expression;

class LoginController extends Controller
{
     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
     /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            #Asignar variables de sesión - start
            $session = Yii::$app->session;
            if (!$session->isActive){
                $session->open();
            }

            //error_log(print_r($model->getUser(), true));
            $session->set('idUsuario', $model->getUser()->usuario_id);
            $session->set('nombre', $model->getUser()->usuario_nombre);
            $session->set('apellidos', $model->getUser()->usuario_apellido);
            $session->set('correo_electronico', $model->getUser()->usuario_email);
            $session->set('usuario', $model->getUser()->usuario_usuario);
            $session->set('foto', $model->getUser()->usuario_foto);
            $session->set('caja_asignada', $model->getUser()->caja_id);
            $session->set('estatus', $model->getUser()->usuario_estatus);
            $usuario = Usuario::findOne(Yii::$app->user->getId());
            $usuario->usuario_ultimo_acceso=Date('Y-m-d H:i:s');
            if ($usuario->save()) {
                return $this->redirect(['/site/index']);
            } else {
                error_log(print_r($usuario, true));
            }
            
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
