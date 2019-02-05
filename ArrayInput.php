<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace trntv\arrayinput;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class ArrayInput extends InputWidget{
    protected $inputOptions;

    public function init(){
        parent::init();
        $this->inputOptions = ArrayHelper::merge([
                'type'=>'text',
                'class'=>'form-control'
            ],
            $this->options
        );
        unset($this->inputOptions['id']);
        ArrayInputAsset::register($this->getView());
        if($this->hasModel()){
            $this->name = Html::getInputName($this->model, $this->attribute);
            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }
        //$this->name = $this->name.'[]'; // todo: Проверка не массив ли это уже
        $this->value = is_array($this->value) ? $this->value : [$this->value];
    }

    public function run(){
        $content = Html::beginTag('div', ['id'=>$this->options['id']]);
        foreach($this->value as $k => $v){
            $content .= Html::beginTag('div', ['class' => 'wrap-input']);
            $content .= Html::beginTag('div', ['class' => 'title-el']);
            $content .= $k;
            $content .= Html::endTag('div');
            $content .= Html::beginTag('div', ['class'=>'input-group']);
            $content .= Html::input($this->inputOptions['type'], $this->name."[$k]", $v, $this->inputOptions);
            $content .= Html::tag('a', Html::tag('i', '', ['class'=>'glyphicon glyphicon-remove']), ['class'=>'input-group-addon array-input-remove', 'href'=>'#']);
            $content .= Html::endTag('div');
            $content .= Html::endTag('div');
        }
        $content .= Html::beginTag('div', ['class' => 'wrap-input']);
        $content .= Html::beginTag('div', ['class' => 'title-el']);
        $content .= 'Новый элемент';
        $content .= Html::endTag('div');
        $content .= Html::beginTag('div', ['class'=>'input-group']);
        $content .= Html::input($this->inputOptions['type'], 'title', null, ArrayHelper::merge($this->inputOptions, ['data-name'=>$this->name]));
        $content .= Html::tag('a', Html::tag('i', '', ['class'=>'glyphicon glyphicon-plus']), ['class'=>'input-group-addon array-input-plus', 'href'=>'#']);
        $content .= Html::endTag('div');
        $content .= Html::endTag('div');
        $content .= Html::endTag('div');
        return $content;
    }
} 