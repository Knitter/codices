<?php

/*
 * Publisher.php
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
final class Publisher extends Model {

    /** @var \common\models\Publisher|null */
    private ?\common\models\Publisher $publisher;

    public ?string $name = null;
    public ?string $summary = null;
    public ?string $website = null;
    public ?string $logo = null;

    /** @var \yii\web\UploadedFile */
    public $file;

    /**
     * @param \common\models\Publisher|null $publisher
     * @param array                         $config
     */
    public function __construct(\common\models\Publisher $publisher = null, array $config = []) {
        $this->publisher = new \common\models\Publisher();
        if ($publisher) {
            $this->publisher = $publisher;

            $this->name = $this->publisher->name;
            $this->summary = $this->publisher->summary;
            $this->website = $this->publisher->website;
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules(): array {
        return [
            [['name'], 'required'],
            [['name', 'summary', 'website'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array {
        return $this->publisher->attributeLabels();
    }

    /**
     * @return bool
     */
    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        if ($this->publisher->isNewRecord) {
            //TODO: Fix after login process is ready
            $this->publisher->ownedById = 1;
        }

        $this->publisher->name = $this->name;
        $this->publisher->summary = $this->summary ?: null;
        $this->publisher->website = $this->website ?: null;

        $filepath = null;
        if (($file = UploadedFile::getInstance($this, 'photo'))) {
            //@TODO: make this a bit more smarther and warn the user if we can't create the authors folder.
            $folder = Yii::getAlias('@webroot/uploads/publishers');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $end = explode('.', $file->name);
            $this->publisher->logo = Inflector::slug($this->name) . '.' . end($end);

            $filepath = $folder . '/' . $this->publisher->logo;
            if (!$file->saveAs($filepath)) {
                $this->publisher->logo = null;
            }
        }

        if (!$this->publisher->save()) {
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
        return $this->publisher->id;
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool {
        return $this->publisher->isNewRecord;
    }

    /**
     * @return array
     */
    public function getBooks(): array {
        return $this->publisher ? $this->publisher->books : [];
    }

}
