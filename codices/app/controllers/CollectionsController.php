<?php

/*
 * CollectionsController.php
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
use common\models\Collection;
//-
use app\models\forms\Collection as Form;
use app\models\filters\Collections;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class CollectionsController extends Controller {

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
     * @return string
     */
    public function actionIndex() {
        return $this->render('index', ['filter' => new Collections()]);
    }

    /**
     * @param integer $id
     * @return string
     */
    public function actionView($id) {
        return $this->render('view', ['collection' => $this->findCollection($id)]);
    }

    /**
     * @return \yii\web\Response|string
     */
    public function actionCreate() {
        $form = new Form();
        
        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'New collection created.'));
                return $this->redirect(['update', 'id' => $form->id]);
            }
        }

        return $this->render('create', ['model' => $form]);
    }

    /**
     * @param integer $id
     * @return \yii\web\Response|string
     */
    public function actionUpdate($id) {
        $form = new Form($this->findCollection($id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'Collection details updated.'));
                return $this->redirect(['update', 'id' => $form->id]);
            }
        }

        return $this->render('update', ['model' => $form]);
    }

    /**
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id) {
        $collection = $this->findCollection($id);

        if ($collection->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('codices', 'Collection deleted.'));
        } else {
            Yii::$app->session->setFlash('failure', Yii::t('codices', 'Unable to delete selected collection.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * 
     * @return \common\models\Collection
     * @throws \yii\web\NotFoundHttpException
     */
    private function findCollection($id) {
        if (($collection = Collection::findOne((int) $id)) !== null) {
            return $collection;
        }

        throw new NotFoundHttpException(Yii::t('codices', 'Collection not found.'));
    }

}
