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
use common\models\Book;
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
    public function behaviors(): array {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['gallery', 'details']],
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
    public function actionIndex(): string {
        return $this->render('index', ['filter' => new Books()]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionView(int $id): string {
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
     * @param int $id
     * @return \yii\web\Response|string
     */
    public function actionUpdate(int $id) {
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
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete(int $id) {
        $book = $this->findBook($id);

        if ($book->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('codices', 'Book deleted.'));
        } else {
            Yii::$app->session->setFlash('failure', Yii::t('codices', 'Unable to delete selected book.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Shows a book gallery with only the book's cover and its title.
     * 
     * @return string
     */
    public function actionGallery(string $mode = 'all'): string {
        $this->layout = 'public';
        $books = Book::find()->orderBy('title')->all();

        if ($mode != 'all' && $mode != 'ordered') {
            $mode = 'ordered';
        }

        return $this->render('gallery', ['books' => $books, 'type' => $mode]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionDetails(int $id): string {
        $title = Yii::t('codices', 'Unable to find requested book.');

        if (($book = Book::findOne($id))) {
            $title = $book->title;
        }

        $details = '';

        $author = '';
        if ($book->authorId) {
            $author = Yii::t('codices', 'Written by <strong>{author}</strong>', ['author' => $book->author->fullName]);
        }

        $series = '';
        if ($book->seriesId) {
            if ($book->order) {
                $series = Yii::t('codices', '#{order} of the <strong>{series}</strong> series', [
                            'order' => $book->order,
                            'series' => $book->series->name
                ]);
            } else {
                $series = Yii::t('codices', 'belonging to the {series} series', ['series' => $book->series->name]);
            }
        }

        $isbn = $book->isbn;
        $plot = $book->plot;

        $coverUrl = '#';
        if ($book->isCoverFileAvailable) {
            $coverUrl = $book->coverURL;
        }

        $details .= $author;
        if (!empty($series)) {
            $details .= (', ' . $series);
        }

        if (!empty($isbn)) {
            $details .= ((!empty($details) ? ' - ' : '') . 'ISBN13: ' . $isbn);
        }

        if (empty($author)) {
            $details = ucfirst($details);
        }

        $dialog = <<<HTML
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="model-title">{$title}</h4>
                        </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row"><div class="col-xs-12"><img class="img-rounded img-responsive" src="{$coverUrl}"></div></div>
                            <div class="row"><div class="col-xs-12">{$details}</div></div>
                            <div class="row"><div class="col-xs-12">{$plot}</div></div>
                        </div>
                    </div>
                </div>
HTML;

        return $dialog;
    }

    /**
     * 
     * @param string $ft
     */
    public function actionExport(string $ft = 'html') {
        //@TODO: ...
    }

    /**
     * @param int $id
     * 
     * @return \common\models\Book
     * @throws \yii\web\NotFoundHttpException
     */
    private function findBook(int $id) {
        if (($book = Book::findOne($id)) !== null) {
            return $book;
        }

        throw new NotFoundHttpException(Yii::t('codices', 'Book not found.'));
    }

}
