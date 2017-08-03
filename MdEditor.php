<?php

namespace yiichina\mdeditor;

use yii\Helpers\Html;

/**
 * This is just an example.
 */
class MdEditor extends \yii\widgets\InputWidget
{
    public function init()
    {
        parent::init();
        $view = $this->getView();
        MdEditorAsset::register($view);
		$view->registerJs("$(\"#{$this->options['id']}\").mdEditor()");
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
