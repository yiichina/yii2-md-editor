<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yiichina\mdeditor;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files for client validation.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MdEditorAsset extends AssetBundle
{
    public $sourcePath = '@bower/cmd-editor/src';

    public $css = [
        'css/md-editor.css',
    ];

    public $js = [
        'js/md-editor.js',
    ];

    public $depends = array(
        'yii\web\JqueryAsset',
        'yiichina\icons\IconAsset',
        'yiichina\mdeditor\CodeMirrorAsset',
        'yiichina\mdeditor\MarkedAsset',
    );
}
