<?php

/*
 * Book.php
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

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int                         $id                PK, record ID, auto-increment
 * @property string                      $title             Book title
 * @property int                         $ownedById         FK, user account the record belongs to
 * @property int                         $translated        Flag, identifies this book as being a translation
 * @property int                         $favorite          Flag, marks this as one of the user's favorite book
 * @property int                         $read              Flag, marks the book as read by the user
 * @property int                         $copies            Number of owned copies
 * @property string|null                 $subTitle          Optional sub-title
 * @property string|null                 $originalTitle    If the book is translated, this will allow the user to
 *           specify the original title
 * @property string|null                 $plot
 * @property string|null                 $isbn
 * @property string|null                 $format
 * @property int|null                    $pageCount
 * @property string|null                 $publishDate
 * @property int|null                    $publishYear
 * @property string|null                 $addedOn
 * @property string|null                 $language
 * @property string|null                 $translatedIn
 * @property string|null                 $edition
 * @property int|null                    $publisherId
 * @property float|null                  $rating
 * @property float|null                  $ownRating
 * @property string|null                 $url
 * @property string|null                 $review
 * @property string|null                 $cover
 * @property string|null                 $filename          eBook file name, a partial path that needs to be merged
 *           with
 *           system settings
 * @property int|null                    $orderInSeries
 * @property int|null                    $seriesId
 * @property int|null                    $duplicatesBookdId FK, identifies the book that this record duplicates
 *
 * @property \common\models\Account      $owner
 * @property \common\models\Collection[] $collections
 * @property \common\models\Genre[]      $genres
 * @property \common\models\Series       $series
 * @property \common\models\Publisher    $publisher
 *
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Book extends ActiveRecord {

    //TODO: Make into enums and add ebook formats
    public const FORMAT_HARDCOVER = 'HC';
    public const FORMAT_PAPERBACK = 'PB';
    public const FORMAT_EPUB = 'EPUB';
    public const FORMAT_PDF = 'PDF';
    public const FORMAT_AUDIOBOOK = 'AUDIO';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{Book}}';
    }

    /**
     * @return array
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('codices', '#'),
            'title' => Yii::t('codices', 'Title'),
            'ownedById' => Yii::t('codices', 'Owner'),
            'translated' => Yii::t('codices', 'Translated'),
            'favorite' => Yii::t('codices', 'Favorite'),
            'read' => Yii::t('codices', 'Read'),
            'copies' => Yii::t('codices', 'No. Copies'),
            'subTitle' => Yii::t('codices', 'Subtitle'),
            'originalTitle' => Yii::t('codices', 'Original Title'),
            'plot' => Yii::t('codices', 'Plot'),
            'isbn' => Yii::t('codices', 'ISBN'),
            'format' => Yii::t('codices', 'Format'),
            'pageCount' => Yii::t('codices', 'Page Count'),
            'publishDate' => Yii::t('codices', 'Publish Date'),
            'publishYear' => Yii::t('codices', 'Publish Year'),
            'addedOn' => Yii::t('codices', 'Added On'),
            'language' => Yii::t('codices', 'Language'),
            'translatedIn' => Yii::t('codices', 'Translated Language'),
            'edition' => Yii::t('codices', 'Edition'),
            'publisherId' => Yii::t('codices', 'Publisher'),
            'rating' => Yii::t('codices', 'Global Rating'),
            'ownRating' => Yii::t('codices', 'My Rating'),
            'url' => Yii::t('codices', 'URL'),
            'review' => Yii::t('codices', 'Review'),
            'cover' => Yii::t('codices', 'Cover'),
            'filename' => Yii::t('codices', 'File Path/Name'),
            'orderInSeries' => Yii::t('codices', 'Order in Series'),
            'seriesId' => Yii::t('codices', 'Series'),
            'duplicatesBookdId' => Yii::t('codices', 'Duplicates'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeries(): ActiveQuery {
        return $this->hasOne(Series::class, ['id' => 'seriesId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner(): ActiveQuery {
        return $this->hasOne(Account::class, ['id' => 'ownedById']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getCollections(): ActiveQuery {
        return $this->hasMany(Collection::class, ['id' => 'collectonId'])
            ->viaTable('{{BookCollection}}', ['bookId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getGenres(): ActiveQuery {
        return $this->hasMany(Genre::class, ['id' => 'genreId'])
            ->viaTable('{{BookGenre}}', ['bookId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher(): ActiveQuery {
        return $this->hasOne(Publisher::class, ['id' => 'publisherId']);
    }

    /**
     * @return string[]
     */
    public static function formatList(bool $sort = true): array {
        $formats = [
            self::FORMAT_HARDCOVER => Yii::t('codices', 'Hardcover'),
            self::FORMAT_PAPERBACK => Yii::t('codices', 'Paperback'),
            self::FORMAT_EPUB => Yii::t('codices', 'EPUB'),
            self::FORMAT_PDF => Yii::t('codices', 'PDF'),
            self::FORMAT_AUDIOBOOK => Yii::t('codices', 'Audiobook')
        ];

        if ($sort) {
            asort($formats);
            return $formats;
        }

        return $formats;
    }

    /**
     * @return string[]
     */
    public static function formatKeys(): array {
        return [
            self::FORMAT_HARDCOVER,
            self::FORMAT_PAPERBACK,
            self::FORMAT_EPUB,
            self::FORMAT_PDF,
            self::FORMAT_AUDIOBOOK
        ];
    }

}