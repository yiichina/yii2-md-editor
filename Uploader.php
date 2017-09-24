<?php

namespace yiichina\mdeditor;
use yii\base\Widget;

/**
 * This is just an example.
 */
class Uploader extends Widget
{
    public $debug = false;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('uploader');
    }
}
