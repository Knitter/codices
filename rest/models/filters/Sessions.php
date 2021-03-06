<?php

/*
 * Sessions.php
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

namespace app\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//-
use common\models\Session;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Sessions extends Model {

    /** @var string */
    public $creationDate;

    /** @var int */
    public $valid;

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
                [['creationDate'], 'string', 'max' => 255],
                [['valid'], 'integer']
        ];
    }

    /**
     * @param array $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search(array $params) {
        $query = Session::find()->orderBy('creationDate DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 35],
            'sort' => false
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $provider;
        }

        $query->andFilterWhere(['like', 'creationDate', trim($this->creationDate)])
                ->andFilterWhere(['valid' => $this->valid]);

        return $provider;
    }

}
