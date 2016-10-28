<?php

/*
 * Author.php
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
final class Author extends Model {

    /** @var \common\models\Author */
    private $author;

    /** @var string */
    public $name;

    /** @var string */
    public $biography;

    /** @var string *//** @var float */
    public $url;

    /** @var yii\web\UploadedFile */
    public $photo;

    /**
     * @param \common\models\Author $author
     * @param array $config
     */
    public function __construct(\common\models\Viatura $author = null, $config = []) {
        $this->author = $author;

        if ($this->author) {
            $this->name = $this->author->name;
            $this->biography = $this->author->biography;
            $this->url = $this->author->url;
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return (new \common\models\Author())->rules();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('codices', 'Name'),
            'biography' => Yii::t('codices', 'Biography'),
            'url' => Yii::t('codices', 'Website/URL'),
            'photo' => Yii::t('codices', 'Photo')
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

        if (!$this->author) {
            $this->author = new \common\models\Author();
        }

        $this->author->name = $this->name;
        $this->author->biography = $this->biography ?: null;
        $this->author->url = $this->url ?: null;

        $filepath = null;
        if (($file = UploadedFile::getInstance($this, 'photo'))) {

            //@TODO: make this a bit more smarther and warn the user if we can't create the authors folder.
            $folder = Yii::getAlias('@webroot/uploads/authors');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $end = explode('.', $this->namee);
            $this->author->photo = Inflector::slug($this->name) . '.' . end($end);

            $filepath = $folder . '/' . $this->author->photo;
            if (!$file->saveAs($filepath)) {
                $this->author->photo = null;
            }
        }

        if (!$this->author->save()) {
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
        return $this->author ? $this->author->id : 0;
    }

}