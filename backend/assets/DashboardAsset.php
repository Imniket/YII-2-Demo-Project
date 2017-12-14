<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
   public $baseUrl = '@web/';
   //public $sourcePath = '@bower/';
    public $css = [
        'css/adminlte/css/site.css',
        'css/adminlte/css/AdminLTE.min.css',
    ];
     public $publishOptions = [
        'only' => [
            'js/',
                ],
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $js = [
        //'js/adminlte.js',
    ];
}
