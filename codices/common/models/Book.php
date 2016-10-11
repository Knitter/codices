<?php

/*
 * Book.php
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

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $title
 * @property string $plot
 * @property string $isbn
 * @property string $format
 * @property integer $pageCount
 * @property string $publicationDate
 * @property string $addedOn
 * @property string $language
 * @property integer $edition
 * @property float $rating
 * @property integer $read
 * @property string $url
 * @property string $review
 * @property string $cover
 * @property integer $order
 * @property integer $seriesId
 * @property integer $publisherId
 *
 * @property Series $series
 * @property Author[] $authors
 * @property Tag[] $tags
 * @property Publisher $publisher
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
class Book extends ActiveRecord {

    const FORMAT_HARDCOVER = 'HC',
            FORMAT_PAPERBACK = 'PB';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Book';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['title', 'accountId'], 'required'],
                [['title', 'language', 'edition', 'publisher', 'url', 'cover'], 'string', 'max' => 255],
                [['plot', 'publicationDate', 'addedOn', 'review'], 'string'],
                [['isbn'], 'string', 'max' => 25],
                [['format'], 'string', 'max' => 5],
                [['pageCount', 'order', 'read', 'seriesId', 'accountId'], 'integer'],
                [['rating'], 'numerical']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollection() {
        return $this->hasOne(Collection::className(), ['id' => 'collectionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeries() {
        return $this->hasOne(Series::className(), ['id' => 'seriesId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors() {
        return $this->hasMany(Author::className(), ['id' => 'authorId'])->viaTable('BookAuthor', ['bookId' => 'id']);
    }

}
