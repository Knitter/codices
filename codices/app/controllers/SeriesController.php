<?php

/*
 * SeriesController.php
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
use common\models\Series;
//-
use app\models\forms\Series as Form;
use app\models\filters\Series as Filter;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class SeriesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [];
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        ['allow' => false, 'roles' => ['?']],
                        ['allow' => true, 'roles' => ['@']]
                ]
            ]
        ];
    }

    /**
     * Lists all existing book series.
     * 
     * @return string
     */
    public function actionIndex() {
        return $this->render('index', ['filter' => new Filter()]);
    }

    /**
     * Shows the details of a specific books series.
     * 
     * @param integer $id The series' database ID.
     * @return string
     */
    public function actionView($id) {
        return $this->render('view', ['series' => $this->findSeries($id)]);
    }

    /**
     * Allows creating new book series.
     * 
     * @return \yii\web\Response|string
     */
    public function actionCreate() {
        $form = new Form();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'New book series created.'));
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
        $form = new Form($this->findSeries($id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'Book series details updated.'));
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
        $series = $this->findSeries($id);

        if ($series->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('codices', 'Book series deleted.'));
        } else {
            Yii::$app->session->setFlash('failure', Yii::t('codices', 'Unable to delete selected book series.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * 
     * @return \common\models\Series
     * @throws \yii\web\NotFoundHttpException
     */
    private function findSeries($id) {
        if (($series = Series::findOne((int) $id)) !== null) {
            return $series;
        }

        throw new NotFoundHttpException(Yii::t('codices', 'Book series not found.'));
    }

}
