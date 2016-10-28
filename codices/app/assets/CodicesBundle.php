<?php

/*
 * CodicesBundle.php
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

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @license http://www.gnu.org/licenses/agpl-3.0.txt AGPL
 * @copyright (c) 2016, Sérgio Lopes (knitter.is@gmail.com)
 */
final class CodicesBundle extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/bootstrap.min.css',
        'css/flat-admin.css',
        //'css/theme/blue-sky.css',
        //'css/theme/blue.css',
        //'css/theme/red.css',
        //'css/theme/yellow.css'
    ];
    public $js = [
        'js/jquery-3.1.1.min.js',
        'js/bootstrap.min.js',
    ];
    public $depends = [
//'yii\web\YiiAsset',
//'yii\web\JqueryAsset',
//'yii\bootstrap\BootstrapAsset',
//'yii\bootstrap\BootstrapPluginAsset'
    ];

}
