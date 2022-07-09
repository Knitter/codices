<?php

/*
 * SeriesController.php
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
use codices\filters\Series as Filter;
use codices\forms\Series as Form;
use common\models\Series;
use Yii;
use yii\web\Response;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class SeriesController extends ApplicationController {

    /**
     * @return string
     */
    public function actionIndex(): string {
        $filter = new Filter(Yii::$app->user->identity->id);
        $provider = $filter->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'filter' => $filter,
            'provider' => $provider
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionAdd(): Response|string {
        $form = new Form(Yii::$app->user->identity->id);
        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                //TODO: Yii::$app->session->setFlash('success', Yii::t('codices', 'New book series created.'));
                return $this->redirect(['edit', 'id' => $form->id]);
            }
        }

        return $this->render('add', [
            'model' => $form,
        ]);
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionEdit(int $id): Response|string {
        $form = new Form(Yii::$app->user->identity->id, $this->findModel(Series::class, $id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                //TODO: Yii::$app->session->setFlash('success', Yii::t('codices', 'Book series details updated.'));
                return $this->redirect(['edit', 'id' => $form->id]);
            }
        }

        return $this->render('edit', [
            'model' => $form,
        ]);
    }

    public function actionDetails(int $id) {
        throw new \Exception('Not implemented yet!');
    }

    public function actionDelete(int $id) {
        throw new \Exception('Not implemented yet!');
    }
}