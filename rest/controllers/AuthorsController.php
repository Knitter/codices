<?php

/*
 * AuthorsController.php
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
//-
use app\models\forms\Author as Form;
use app\models\filters\Authors;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class AuthorsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors(): array {
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
    public function actionIndex(): string {
        return $this->render('index', ['filter' => new Authors()]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionView(int $id) {
        return $this->render('view', ['author' => $this->findAuthor($id)]);
    }

    /**
     * @return \yii\web\Response|string
     */
    public function actionCreate() {
        $form = new Form();

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'New author created.'));
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
        $form = new Form($this->findAuthor($id));

        if ($form->load(Yii::$app->request->post())) {
            if ($form->save()) {
                Yii::$app->session->setFlash('success', Yii::t('codices', 'Author details updated.'));
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
        $author = $this->findAuthor($id);

        if ($author->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('codices', 'Author deleted.'));
        } else {
            Yii::$app->session->setFlash('failure', Yii::t('codices', 'Unable to delete selected author.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * @return \stdClass
     */
    public function actionAjaxCreate() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (($name = Yii::$app->request->post('name')) && ($surname = Yii::$app->request->post('surname'))) {
            $newAuthor = new Author();
            $newAuthor->name = $name;
            $newAuthor->surname = $surname;

            if ($newAuthor->save(false)) {
                $authors = Author::find()->orderBy(['(CONCAT(name, " ", surname))' => SORT_ASC])
                        ->asArray()
                        ->all();

                $html = ('<option value="0">' . Yii::t('codices', '- none -') . '</option>');
                foreach ($authors as $author) {
                    $html .= '<option value="' . $author['id'] . '"' . ($author['id'] == $newAuthor->id ? ' selected ' : '')
                            . '>' . $author['name'] . ($author['surname'] ? (' ' . $author['surname']) : '')
                            . '</option>';
                }

                return (object) ['ok' => true, 'html' => $html];
            }
        }

        return (object) ['ok' => false];
    }

    /**
     * @param int $id
     * 
     * @return \common\models\Author
     * @throws \yii\web\NotFoundHttpException
     */
    private function findAuthor(int $id) {
        if (($author = Author::findOne($id)) !== null) {
            return $author;
        }

        throw new NotFoundHttpException(Yii::t('codices', 'Author not found.'));
    }

}
