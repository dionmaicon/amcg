<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/font-awesome.min.css',
        'css/prettyPhoto.css',
        'css/price-range.css',
        'css/animate.css',
        'css/responsive.css',
        'css/adminlte/css/font-awesome.css',
        'css/adminlte/css/ionicons.css',
        'css/adminlte/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
    ];
    public $js = [
        'js/price-range.js',
        'js/jquery.prettyPhoto.js',
        'js/login.js',
        'js/anexos.js'
        //'js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
