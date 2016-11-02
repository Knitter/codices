<?php

/*
 * Books.php
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
use common\models\Book;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Books extends Model {

    /** @var string */
    public $title;

    /** @var string */
    public $isbn;

    /** @var string */
    public $seriesName;

    /** @var string */
    public $authorName;

    /** @var float */
    public $rating;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['title', 'isbn', 'seriesName', 'authorName'], 'string', 'max' => 255],
                [['rating'], 'number']
        ];
    }

    /**
     * @param array $params
     * 
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params) {
        $query = Book::find()->orderBy('title')
                ->joinWith(['series'])
                ->joinWith(['author']);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 35],
            'sort' => false
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $provider;
        }

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'isbn', $this->isbn])
                ->andFilterWhere(['like', 'series.name', $this->seriesName])
                ->andFilterWhere(['like', 'author.name', $this->authorName])
                ->andFilterWhere(['>=', 'rating', $this->rating]);

        return $provider;
    }

}
