<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace frontend\assets;
use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://fonts.googleapis.com/css?family=Fauna+One|Roboto|Pacifico',
        '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css',
        'css/site.css',
        'css/widget-css.css',
        'css/main.css'
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

