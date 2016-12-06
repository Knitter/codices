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
use yii\web\Response;
//-
use common\models\Author;
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
     * @return \stdClass
     */
    public function actionAjaxCreate() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($name = Yii::$app->request->post('name'))) {
            $newSeries = new Series();
            $newSeries->name = $name;
            $newSeries->accountId = Yii::$app->user->identity->id;

            if (($authorId = (int) Yii::$app->request->post('author'))) {
                if (($author = Author::findOne($authorId))) {
                    $newSeries->authorId = $author->id;
                }
            }

            if ($newSeries->save(false)) {

                $html = ('<option value="0">' . Yii::t('codices', '- none -') . '</option>');
                if ($author) {
                    foreach ($author->getSeries()->asArray()->all() as $series) {
                        $html .= '<option value="' . $series['id'] . '"' . ($series['id'] == $newSeries->id ? ' selected ' : '')
                                . '>' . $series['name'] . '</option>';
                    }
                } else {
                    $html .= '<option value="' . $newSeries->id . '">' . $newSeries->name . '</option>';
                }

                return (object) ['ok' => true, 'html' => $html];
            }
        }

        return (object) ['ok' => false];
    }

    /**
     * @return \stdClass
     */
    public function actionAjaxList($id) {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (($author = Author::findOne((int) $id))) {
            $html = ('<option value="0">' . Yii::t('codices', '- none -') . '</option>');
            if ($author) {
                foreach ($author->getSeries()->asArray()->all() as $series) {
                    $html .= '<option value="' . $series['id'] . '">' . $series['name'] . '</option>';
                }
            }

            return (object) ['ok' => true, 'html' => $html];
        }

        return (object) ['ok' => false];
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
