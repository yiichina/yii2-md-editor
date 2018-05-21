<?php

namespace yiichina\mdeditor;
use yii\web\AssetBundle;

class UploaderAsset extends AssetBundle
{
	// The files are not web directory accessible, therefore we need
	// to specify the sourcePath property. Notice the @vendor alias used.
	public $sourcePath = '@vendor/yiichina/yii2-md-editor/assets';
	public $css = [
	    'css/uploader.css',
    ];
    public $js = [
    	'js/uploader.js',
    ];
}
