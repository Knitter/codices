<?php

/*
 * BooksController.php
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
use commo\models\Book;
//-
use app\models\forms\Book as Form;
use app\models\filters\Books;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class BooksController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        ['allow' => true, 'actions' => ['gallery']],
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
        return $this->render('index', ['filter' => new Books()]);
    }

    /**
     * @param integer $id
     * @return string
     */
    public function actionView($id) {
        return $this->render('view', ['book' => $this->findBook($id)]);
    }

    /**
     * @return \yii\web\Response|string
     */
    public function actionCreate() {
        $form = new Form();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'New book created.'));
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
        $form = new Form($this->findBook($id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'Book details updated.'));
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
        $book = $this->findBook($id);

        if ($book->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('codices', 'Book deleted.'));
        } else {
            Yii::$app->session->setFlash('failure', Yii::t('codices', 'Unable to delete selected book.'));
        }

        return $this->redirect(['index']);
    }

    public function actionGallery() {
        //@TODO: ...
        return $this->render('gallery');
    }

    public function actionExport() {
        //@TODO: ...
    }

    /**
     * @param integer $id
     * 
     * @return \common\models\Book
     * @throws \yii\web\NotFoundHttpException
     */
    private function findBook($id) {
        if (($book = Book::findOne((int) $id)) !== null) {
            return $book;
        }

        throw new NotFoundHttpException(Yii::t('codices', 'Book not found.'));
    }

}
