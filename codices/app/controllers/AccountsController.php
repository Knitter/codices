<?php

/*
 * AccountsController.php
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
use yii\web\NotFoundHttpException;
//-
use common\models\Account;
//-
use app\models\forms\Account as Form;
use app\models\forms\Profile;
use app\models\filters\Accounts;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class AccountsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        ['allow' => false, 'roles' => ['?']],
                        ['allow' => true, 'roles' => ['@']],
                        ['allow' => false]
                ]
            ]
        ];
    }

    /**
     * Lists all existing user accounts.
     * 
     * @return string
     */
    public function actionIndex() {
        return $this->render('index', ['filter' => new Accounts()]);
    }

    /**
     * Shows the details of a specific user's account.
     * 
     * @param integer $id The account's database ID.
     * @return string
     */
    public function actionView($id) {
        return $this->render('view', ['account' => $this->findAccount($id)]);
    }

    /**
     * Allows creating new user accounts.
     * 
     * @return \yii\web\Response|string
     */
    public function actionCreate() {
        $form = new Form();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'New account created.'));
                return $this->redirect(['update', 'id' => $form->id]);
            }
        }

        return $this->render('create', ['model' => $form]);
    }

    /**
     * Allows editing a user's account details.
     * 
     * @param integer $id The account's database ID.
     * 
     * @return \yii\web\Response|string
     */
    public function actionUpdate($id) {
        $form = new Form($this->findAccount($id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'Account details updated.'));
                return $this->redirect(['update', 'id' => $form->id]);
            }
        }

        return $this->render('update', ['model' => $form]);
    }

    /**
     * Removes a user from the system and redirects the caller to the account list action.
     * 
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id) {
        $account = $this->findAccount($id);

        if ($account->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('codices', 'Account deleted.'));
        } else {
            Yii::$app->session->setFlash('failure', Yii::t('codices', 'Unable to delete selected account.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * @return \yii\web\Response|string
     */
    public function actionMyAccount() {
        $form = new Profile($this->findAccount(Yii::$app->user->identity->id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'Profile detailes updated.'));
                return $this->redirect(['my-account']);
            }
        }

        return $this->render('my-account', ['model' => $form]);
    }

    /**
     * Locates an Account record based on the given record's ID.
     * 
     * @param integer $id
     * 
     * @return \common\models\Account
     * @throws \yii\web\NotFoundHttpException
     */
    private function findAccount($id) {
        if (($account = Account::findOne((int) $id)) !== null) {
            return $account;
        }

        throw new NotFoundHttpException(Yii::t('codices', 'Account not found.'));
    }

}
