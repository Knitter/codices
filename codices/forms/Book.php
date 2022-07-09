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

namespace codices\forms;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Book extends Model {

    /** @var \common\models\Book */
    private $book;
    private int $ownerId;

    public ?string $title = null;
    public $ownedById;
    public ?string $digital = null;
    public $translated;
    public ?string $favorite = null;
    public ?string $read = null;
    public $copies;
    public ?string $subTitle = null;
    public ?string $origionalTitle = null;
    public ?string $plot = null;
    public ?string $isbn = null;
    public ?string $format = null;
    public $pageCount;
    public ?string $publishDate = null;
    public $publishYear;
    //public ?string $addedOn;
    public ?string $language = null;
    public ?string $translatedIn = null;
    public ?string $edition = null;
    public $publisherId;
    public $rating;
    public $ownRating;
    public ?string $url = null;
    public ?string $review = null;
    public ?string $cover = null;
    public ?string $filename = null;
    public $orderInSeries;
    public $seriesId;
    public $duplicatesBookdId;

    /**
     * @param int                      $ownerId
     * @param \common\models\Book|null $book
     * @param array                    $config
     */
    public function __construct(int $ownerId, \common\models\Book $book = null, array $config = []) {
        $this->ownerId = $ownerId;
        $this->book = new \common\models\Book();
        if ($book) {
            $this->book = $book;
            $this->addedOn = $book->addedOn;

            $this->title = $book->title;
            $this->digital = $book->digital ? 'yes' : 'no';
            $this->translated = $book->translated ? 'yes' : 'no';
            $this->favorite = $book->favorite ? 'yes' : 'no';
            $this->read = $book->read ? 'yes' : 'no';
            $this->copies = $book->copies;
            $this->subTitle = $book->subTitle;
            $this->origionalTitle = $book->origionalTitle;
            $this->plot = $book->plot;
            $this->isbn = $book->isbn;
            $this->format = $book->format;
            $this->pageCount = $book->pageCount;
            $this->publishDate = $book->publishDate;
            $this->publishYear = $book->publishYear;
            $this->language = $book->language;
            $this->translatedIn = $book->translatedIn;
            $this->edition = $book->edition;
            $this->publisherId = $book->publisherId;
            $this->rating = $book->rating;
            $this->ownRating = $book->ownRating;
            $this->url = $book->url;
            $this->review = $book->review;
            $this->cover = $book->cover;
            $this->filename = $book->filename;
            $this->orderInSeries = $book->orderInSeries;
            $this->seriesId = $book->seriesId;
            $this->duplicatesBookdId = $book->duplicatesBookdId;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['title'], 'required'],
            [['title', 'subTitle', 'origionalTitle', 'translatedIn', 'edition', 'url', 'filename'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 25],
            [['plot', 'review'], 'string'],
            [['pageCount', 'publisherId', 'seriesId', 'copies', 'orderInSeries', 'duplicatesBookdId', 'publishYear'], 'integer'],
            [['rating', 'ownRating'], 'number'],
            [['digital', 'translated', 'favorite', 'read'], 'in', 'range' => ['yes', 'no']],
            [['format'], 'in', 'range' => \common\models\Book::formatKeys()],
            [['cover'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['publishDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return $this->book->attributeLabels();
    }

    /**
     * Validates and saves the changes into the database.
     *
     * @return bool
     */
    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        if (!$this->book->isNewRecord) {
            $this->book->ownedById = $this->ownerId;
            $this->book->addedOn = date('Y-m-d H:i:s');
        }

        $this->book->title = $this->title;
        $this->book->digital = $this->digital == 'yes' ? 1 : 0;
        $this->book->translated = $this->translated == 'yes' ? 1 : 0;
        $this->book->favorite = $this->favorite == 'yes' ? 1 : 0;
        $this->book->read = $this->read == 'yes' ? 1 : 0;
        $this->book->copies = $this->copies;
        $this->book->subTitle = $this->subTitle;
        $this->book->origionalTitle = $this->origionalTitle;
        $this->book->plot = $this->plot;
        $this->book->isbn = $this->isbn;
        $this->book->format = $this->format ?: null;
        $this->book->pageCount = $this->pageCount ?: null;
        $this->book->publishDate = $this->publishDate ?: null;
        $this->book->publishYear = $this->publishYear ?: null;
        $this->book->language = $this->language ?: null;
        $this->book->translatedIn = $this->translatedIn ?: null;
        $this->book->edition = $this->edition ?: null;
        $this->book->publisherId = $this->publisherId ?: null;
        $this->book->rating = $this->rating ?: null;
        $this->book->ownRating = $this->ownRating ?: null;
        $this->book->url = $this->url ?: null;
        $this->book->review = $this->review ?: null;
        $this->book->cover = $this->cover ?: null;
        $this->book->filename = $this->filename ?: null;
        $this->book->orderInSeries = $this->orderInSeries ?: null;
        $this->book->seriesId = $this->seriesId ?: null;
        $this->book->duplicatesBookdId = $this->duplicatesBookdId ?: null;

        $filepath = null;
        if (($file = UploadedFile::getInstance($this, 'cover'))) {

//            //@TODO: make this a bit more smarther and warn the user if we can't create the covers folder.
            $folder = Yii::getAlias('@webroot/uploads/covers');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $end = explode('.', $file->name);
            $this->book->cover = $this->isbn . '.' . end($end);

            if (empty($this->isbn)) {
                $this->book->cover = Inflector::slug($this->title) . '.' . end($end);
            }

            $filepath = $folder . '/' . $this->book->cover;
            if (!$file->saveAs($filepath)) {
                $this->book->cover = null;
            }
        }

        if (!$this->book->save()) {
            if ($filepath && is_file($filepath)) {
                unlink($filepath);
            }

            return false;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->book->id;
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool {
        return $this->book->isNewRecord;
    }
}
