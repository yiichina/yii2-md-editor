<?php

namespace yiichina\mdeditor;
use yii\web\AssetBundle;

class LoadImageAsset extends AssetBundle
{
	// The files are not web directory accessible, therefore we need
	// to specify the sourcePath property. Notice the @vendor alias used.
	public $sourcePath = '@bower/blueimp-load-image/js';

    public $js = [
        'load-image.all.min.js',
    ];
}
