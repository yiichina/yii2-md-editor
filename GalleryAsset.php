<?php

namespace yiichina\mdeditor;
use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle
{
	// The files are not web directory accessible, therefore we need
	// to specify the sourcePath property. Notice the @vendor alias used.
	public $sourcePath = '@bower/blueimp-gallery';

	public $css = [
        'css/blueimp-gallery.min.css',
    ];

    public $js = [
    	'js/jquery.blueimp-gallery.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
