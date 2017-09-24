<?php

namespace yiichina\mdeditor;
use yii\web\AssetBundle;

class TmplAsset extends AssetBundle
{
	// The files are not web directory accessible, therefore we need
	// to specify the sourcePath property. Notice the @vendor alias used.
	public $sourcePath = '@bower/blueimp-tmpl';
    public $js = [
    	'js/tmpl.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
