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
class CodeMirrorAsset extends AssetBundle
{
    public $sourcePath = '@bower/codemirror';

    public $css = [
        'lib/codemirror.css',
    ];

    public $js = [
        'lib/codemirror.js',
        'mode/markdown/markdown.js',
        'mode/gfm/gfm.js',
        'mode/htmlmixed/htmlmixed.js',
        'mode/xml/xml.js',
        'mode/javascript/javascript.js',
        'mode/css/css.js',
        'mode/clike/clike.js',
        'mode/php/php.js',
        'addon/mode/overlay.js',
        'addon/edit/matchbrackets.js',
    ];

    public $depends = array(
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    );
}
