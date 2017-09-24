<?php

namespace yiichina\mdeditor;
use yii\web\AssetBundle;

class FileUploadAsset extends AssetBundle
{
	// The files are not web directory accessible, therefore we need
	// to specify the sourcePath property. Notice the @vendor alias used.
	public $sourcePath = '@bower/blueimp-file-upload';
	public $css = [
        'css/jquery.fileupload.css',
        'css/jquery.fileupload-ui.css',
    ];
    public $js = [
    	'js/vendor/jquery.ui.widget.js',
    	'js/jquery.iframe-transport.js',
        'js/jquery.fileupload.js',
        'js/jquery.fileupload-process.js',
        'js/jquery.fileupload-image.js',
        'js/jquery.fileupload-validate.js',
        'js/jquery.fileupload-ui.js',
    ];
    public $depends = [
		'yiichina\mdeditor\TmplAsset',
		'yiichina\mdeditor\LoadImageAsset',
		'yiichina\mdeditor\GalleryAsset',
        'yiichina\mdeditor\UploaderAsset',
    ];
}
