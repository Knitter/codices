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

namespace codices\forms;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class Author extends Model {

    /** @var \common\models\Author|null */
    private ?\common\models\Author $author;

    public ?string $name = null;
    public ?string $surname = null;
    public ?string $biography = null;
    public ?string $website = null;
    public ?string $photo = null;

    /** @var \yii\web\UploadedFile */
    public $file;

    /**
     * @param \common\models\Author|null $author
     * @param array                      $config
     */
    public function __construct(\common\models\Author $author = null, array $config = []) {
        $this->author = new \common\models\Author();
        if ($author) {
            $this->author = $author;

            $this->name = $this->author->name;
            $this->surname = $this->author->surname;
            $this->biography = $this->author->biography;
            $this->website = $this->author->website;
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['name', 'surname'], 'required'],
            [['name', 'surname', 'website'], 'string', 'max' => 255],
            [['biography'], 'string'],
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return $this->author->attributeLabels();
    }

    /**
     * @return bool
     */
    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        if ($this->author->isNewRecord) {
            //TODO: Fix after login process is ready
            $this->author->ownedById = 1;
        }

        $this->author->name = $this->name;
        $this->author->surname = $this->surname;
        $this->author->biography = $this->biography ?: null;
        $this->author->website = $this->website ?: null;

        $filepath = null;
        if (($file = UploadedFile::getInstance($this, 'photo'))) {
            //@TODO: make this a bit more smarther and warn the user if we can't create the authors folder.
            $folder = Yii::getAlias('@webroot/uploads/authors');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $end = explode('.', $file->name);
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
     * @return int
     */
    public function getId(): int {
        return $this->author->id;
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool {
        return $this->author->isNewRecord;
    }

    /**
     * @return array
     */
    public function getBooks(): array {
        return $this->author ? $this->author->books : [];
    }

}
