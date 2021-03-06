<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;


class YandexMapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        '//api-maps.yandex.ru/2.1/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&lang=ru_RU',
        'js/YandexMap.js',
        'js/YandexMapRender.js',
    ];

    public $depends = [
        'frontend\assets\AppAsset',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}
