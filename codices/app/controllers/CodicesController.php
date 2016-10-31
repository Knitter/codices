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
use yii\filters\AccessControl;
use yii\web\Controller;
//-
use app\models\forms\Login;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class CodicesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [];
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        ['allow' => true, 'roles' => ['?'], 'actions' => ['login']],
                        ['allow' => false, 'roles' => ['?']],
                        ['allow' => true, 'roles' => ['@'], 'actions' => ['logout', 'index']]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionDashboard() {
        return $this->render('dashboard');
    }

    /**
     * @return string
     */
    public function actionIndex() {
        return $this->redirect(['dashboard']);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin() {
        $this->layout = 'login';

        $app = Yii::$app;
        if (!$app->user->isGuest) {
            return $this->redirect(['dashboard/index']);
        }

        $login = new Login();
        if ($app->request->post('Login') && $login->login($app->request->post())) {
            return $this->redirect(['dashboard/index']);
        }

        return $this->render('login', ['login' => $login]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['index']);
    }

}
