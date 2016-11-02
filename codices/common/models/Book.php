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

use Yii;
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
 * @property string $publisher
 * @property float $rating
 * @property integer $read
 * @property string $url
 * @property string $review
 * @property string $cover
 * @property integer $order
 * @property integer $seriesId
 * @property integer $authorId
 * @property integer $copies
 * 
 * @property Series $series
 * @property Author $author
 * 
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Book extends ActiveRecord {

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
                [['title'], 'required'],
                [['title', 'language', 'edition', 'publisher', 'url', 'cover'], 'string', 'max' => 255],
                [['plot', 'publicationDate', 'addedOn', 'review'], 'string'],
                [['isbn'], 'string', 'max' => 25],
                [['format'], 'string', 'max' => 5],
                [['pageCount', 'order', 'read', 'seriesId', 'accountId', 'authorId', 'copies'], 'integer'],
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
    public function getAuthor() {
        return $this->hasOne(Author::className(), ['id' => 'authorId']);
    }

    /**
     * Returns the label used by users to refer to the various book formats.
     * 
     * @return string
     */
    public function getFormatLabel() {
        $formats = self::formatList();
        return $this->format ? $formats[$this->format] : '';
    }

    /**
     * List of possible formats to be used by lists, dropdowns and other UI elements.
     * 
     * @return array
     */
    public static function formatList() {
        return [
            self::FORMAT_HARDCOVER => Yii::t('codices', 'Hard Cover'),
            self::FORMAT_PAPERBACK => Yii::t('codices', 'Paper Back')
        ];
    }

    /**
     * Returns the full URL to the book's cover.
     * 
     * @return string
     */
    public function getPhotoURL() {
        return ($this->cover ? \yii\helpers\Url::base() . '/uploads/covers/' . $this->cover : '');
    }

}
