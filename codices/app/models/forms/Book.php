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

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Book extends Model {

    /** @var \common\models\Book */
    private $book;

    /** @var string */
    public $title;

    /** @var string */
    public $plot;

    /** @var string */
    public $isbn;

    /** @var string */
    public $format;

    /** @var integer */
    public $pageCount;

    /** @var string */
    public $publicationDate;

    /** @var string */
    public $language;

    /** @var string */
    public $edition;

    /** @var string */
    public $publisher;

    /** @var float */
    public $rating;

    /** @var integer */
    public $read;

    /** @var string */
    public $url;

    /** @var integer */
    public $order;

    /** @var integer */
    public $seriesId;

    /** @var yii\web\UploadedFile */
    public $cover;

    /**
     * @param \common\models\Book $book
     * @param array $config
     */
    public function __construct(\common\models\DireitoImovel $book = null, $config = []) {
        $this->book = $book;

        if ($this->book) {
            $this->title = $this->book->title;
            $this->plot = $this->book->plot;
            $this->isbn = $this->book->isbn;
            $this->format = $this->book->format;
            $this->pageCount = $this->book->pageCount;
            $this->publicationDate = $this->book->publicationDate;
            $this->language = $this->book->language;
            $this->edition = $this->book->edition;
            $this->publisher = $this->book->publisher;
            $this->rating = $this->book->rating;
            $this->read = $this->book->read;
            $this->url = $this->book->url;
            $this->order = $this->book->order;
            $this->seriesId = $this->book->seriesId;
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return (new \common\models\Book())->rules();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'title' => Yii::t('codices', 'Title'),
            'plot' => Yii::t('codices', 'Plot'),
            'isbn' => Yii::t('codices', 'ISBN'),
            'format' => Yii::t('codices', 'Format'),
            'pageCount' => Yii::t('codices', 'Page Count'),
            'publicationDate' => Yii::t('codices', 'Published at'),
            'language' => Yii::t('codices', 'Language'),
            'edition' => Yii::t('codices', 'Edition'),
            'publisher' => Yii::t('codices', 'Publisher'),
            'rating' => Yii::t('codices', 'Rating'),
            'read' => Yii::t('codices', 'Read'),
            'url' => Yii::t('codices', 'Website/URL'),
            'cover' => Yii::t('codices', 'Cover'),
            'order' => Yii::t('codices', 'Order'),
            'seriesId' => Yii::t('codices', 'Series')
        ];
    }

    /**
     * Validates and saves the changes into the database.
     * 
     * @return boolean
     */
    public function save() {
        if (!$this->validate()) {
            return false;
        }

        if (!$this->book) {
            $this->book = new \common\models\Book();
            $this->book->accountId = Yii::$app->user->id;
            $this->book->addedOn = date('Y-m-d H:i:s');
        }

        $this->book->title = $this->title;
        $this->book->plot = $this->plot ?: null;
        $this->book->isbn = $this->isbn ?: null;
        $this->book->format = $this->format;
        $this->book->pageCount = $this->pageCount ?: null;
        $this->book->publicationDate = $this->publicationDate ?: null;
        $this->book->language = $this->language ?: null;
        $this->book->edition = $this->edition ?: null;
        $this->book->publisher = $this->publisher ?: null;
        $this->book->rating = $this->rating ?: null;
        $this->book->read = $this->read ? 1 : 0;
        $this->book->url = $this->url ?: null;
        $this->book->order = $this->order ?: null;
        $this->book->seriesId = $this->seriesId ?: null;

        $filepath = null;
        if (($file = UploadedFile::getInstance($this, 'cover'))) {

            //@TODO: make this a bit more smarther and warn the user if we can't create the covers folder.
            $folder = Yii::getAlias('@webroot/uploads/covers');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $end = explode('.', $this->title);
            $this->book->cover = Inflector::slug($this->title) . '.' . end($end);

            $filepath = $folder . '/' . $this->book->title;
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

        return true;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->book ? $this->book->id : 0;
    }

}