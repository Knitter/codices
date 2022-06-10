<?php

/*
 * ApplicationController.php
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

namespace codices\components;

use common\orm\Company;
use Exception;
use grupoerofio\forms\BaseForm;
use grupoerofio\widgets\components\Alert;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ApplicationController extends Controller {

    /**
     * @param string         $class
     * @param integer|string $id
     * @return \yii\db\ActiveRecord
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel(string $class, int|string $id): ActiveRecord {
        if (($model = $this->loadModel($class, $id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    /**
     * @param string         $class
     * @param integer|string $id
     * @return \yii\db\ActiveRecord|null
     */
    protected function loadModel(string $class, int|string $id): ?ActiveRecord {
        if (($model = $class::findOne($id)) !== null) {
            return $model;
        }

        return null;
    }
}