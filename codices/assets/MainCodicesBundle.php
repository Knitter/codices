<?php

/*
 * MainCodicesAsset.php
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

namespace codices\assets;

use yii\web\AssetBundle;

/**
 * @license       http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016 - 2022, Sérgio Lopes (knitter.is@gmail.com)
 */
final class MainCodicesBundle extends AssetBundle {

    public $sourcePath = "@bundle";

    //TODO: Add production version of assets, loaded by default
    public $css = [
        'css/tabler.min.css',
        'css/tabler-vendors.min.css',
        //'css/fonts.css',
        'css/codices.css'
    ];

    //TODO: Add production version of assets, loaded by default
    public $js = [
        'js/tabler.min.js',
        //'js/scripts.js'
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];

    public function __construct(array $config = []) {
        if (YII_DEBUG) {
            $this->css = [
                'css/tabler.min.css',
                'css/tabler-vendors.min.css',
                //'css/fonts.css',
                'css/codices.css'
            ];

            $this->js = [
                'js/tabler.min.js',
                //'js/scripts.js'
            ];
        }
        parent::__construct($config);
    }
}
