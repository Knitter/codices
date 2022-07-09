<?php

/*
 * SiteController.php
 *
 * Small book management software.
 * Copyright (C) 2016 - 2022 Sérgio Lopes (knitter.is@gmail.com)
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
 * (c) 2016 - 2022 Sérgio Lopes
 */

namespace codices\controllers;

use codices\components\ApplicationController;
use codices\forms\Authentication;
use Yii;
use yii\web\Response;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class SiteController extends ApplicationController {

    /**
     * Implements a small dashboard, that may be expanded to include more info, but that at this point serves only as
     * a placeholder view after login or as default controller/action when a user doesn't specify any.
     *
     * @return string
     */
    public function actionDashboard(): string {
        return $this->render('dashboard', [
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin(): Response|string {
        $app = Yii::$app;
        if (!$app->user->isGuest) {
            return $this->redirect(['dashboard']);
        }

        $this->layout = 'auth';
        $form = new Authentication();
        //TODO: Handle authentication errors
        if ($form->load($app->request->post()) && $form->authenticate()) {
            return $this->redirect(['dashboard']);
        }

        return $this->render('login');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout(): Response {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }


}