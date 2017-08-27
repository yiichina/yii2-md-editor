<?php

namespace yiichina\mdeditor;

use yii\Helpers\Html;
use yii\helpers\Json;

/**
 * This is just an example.
 */
class MdEditor extends \yii\widgets\InputWidget
{
    public $debug = false;
    public $codeMirror;
    public $buttons;
    public $disabledButtons;

    public function init()
    {
        parent::init();
        $view = $this->getView();
        MdEditorAsset::register($view);
        $optionsArray = [];
		if($this->debug) {
            $optionsArray['debug'] = true;
        }
        if(!empty($this->codeMirror)) {
            $optionsArray['codeMirror'] = $this->codeMirror;
        }
        if(!empty($this->buttons)) {
            $optionsArray['buttons'] = $this->buttons;
        }
        if(!empty($this->codeMirror)) {
            $optionsArray['disabledButtons'] = $this->disabledButtons;
        }
        $options = Json::encode($optionsArray);
        $view->registerJs("$(\"#{$this->options['id']}\").mdEditor($options)");
    }

    public function run()
    {
        if($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            return Html::textarea($this->name, $this->value, $this->options);
        }
    }
}
