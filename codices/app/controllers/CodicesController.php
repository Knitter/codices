<?php

/*
 * CodicesController.php
 * 
 * Small book management software.
 * Copyright (C) 2016 Sérgio Lopes (knitter.is@gmail.com)
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 * (c) 2016 Sérgio Lopes
 */

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
//-
use app\models\forms\Login;

/**
 * Default controller that holds system wide actions like login, logout and error actions. Also offers a small 
 * dashboard action to show some system stats (not implemented yet).
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class CodicesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        ['allow' => true, 'actions' => ['index', 'error']],
                        ['allow' => true, 'roles' => ['?'], 'actions' => ['login', 'error']],
                        ['allow' => true, 'roles' => ['@'], 'actions' => ['logout', 'dashboard']],
                        ['allow' => false]
                ]
            ]
        ];
    }

    /**
     * Implements a small dashboard, that may be expanded to include more info, but that at this point serves only as 
     * a placeholder view after login or as default controller/action when a user doesn't specify any.
     * 
     * @return string
     */
    public function actionDashboard() {
        return $this->render('dashboard');
    }

    /**
     * Default action that just redirects the user to the dashboard (if an authenticated user) or to the public gallery 
     * if the user is a guest.
     * 
     * @return \yii\web\Response
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['books/gallery']);
        }

        return $this->redirect(['dashboard']);
    }

    /**
     * Login action allows users to authenticate. Shows the login form and delegates the login/authentication 
     * process to the Login form model.
     * 
     * @return string|\yii\web\Response
     */
    public function actionLogin() {
        $this->layout = 'login';

        $app = Yii::$app;
        if (!$app->user->isGuest) {
            return $this->redirect(['dashboard']);
        }

        $login = new Login();
        if ($login->load($app->request->post()) && $login->login()) {
            return $this->redirect(['dashboard']);
        }

        return $this->render('login', ['login' => $login]);
    }

    /**
     * Logs the user out of the system and redirects to the login action.
     * 
     * @return \yii\web\Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }

    /**
     * Reimplementing Yii's error handling action to control the used layout and the changes needed for Codices. The 
     * standard ErrorAction (defined in the actions() method), given how we've implemented our controllers and 
     * backend/frontend code, will expose some of the private options to visiting users.
     * 
     * @return string
     */
    public function actionError() {
        $this->layout = 'public';

        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        $code = $exception->getCode();
        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        }

        $name = Yii::t('yii', 'Error');
        if ($exception instanceof Exception) {
            $exception->getName();
        }

        if ($code) {
            $name .= " (#$code)";
        }

        $message = Yii::t('yii', 'An internal server error occurred.');
        if ($exception instanceof UserException) {
            $exception->getMessage();
        }

        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        }

        return $this->render('error', ['name' => $name, 'message' => $message, 'exception' => $exception]);
    }

}
