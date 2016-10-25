<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace qdzsoft\widgets;
use yii\base\InvalidConfigException;
/**
 * Description of DetailView
 *
 * @author Chance
 */
class DetailView extends \yii\widgets\DetailView
{
    public $attributesPerRow = 1;
    public $thColor = "#F5F5F5";
    
    public function init() {
        parent::init();
        
        if (!is_numeric($this->attributesPerRow)) {
            throw new InvalidConfigException("attributePerRow must be a integer.");
        }
        if ($this->attributesPerRow > 1) {
            if (isset($this->options["class"])) {
                $this->options["class"] = str_replace("table-striped", "", $this->options["class"]);
            }
            
            $this->template = function ($attribute, $index, $dv) {
                            $row = '';
                            $row .= ($index % $this->attributesPerRow == 0 ?  "<tr>" : "" );
                            $row .= "<th style='background-color:#F5F5F5'>" . $attribute['label'] . "</th><td>" . $dv->formatter->format($attribute['value'], $attribute['format']) ."</td>";
                            $row .= ($index % 3 == ($this->attributesPerRow - 1) ? "</tr>" : '');
                            return $row;
                        };
        }
    }
}
