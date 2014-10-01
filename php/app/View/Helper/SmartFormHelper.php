<?php /* (c)Bittion Admin Module | Created: 26/08/2014 | Developer:reyro | Helper: SmartFormHelper */ ?>
<?php

App::uses('AppHelper', 'View/Helper');

class SmartFormHelper extends AppHelper {

    public $helpers = array('Form'); // Including common helpers

//  Developer: reyro | Created: 26/08/2014 | Description: Input type text    

    public function input($name, $col, $attributes) {
        $label = '';
        $iconPrepend = '';
        $iconAppend = '';
        $disabled = '';
        $attributes['div'] = false;
        if (isset($attributes['type'])) {
            $attributes['type'] = $attributes['type'];
        } else {
            $attributes['type'] = 'text';
        }
        if (isset($attributes['label'])) {
            $label = '<label class="label">' . $attributes['label'] . '</label>';
        }
        if (isset($attributes['iconPrepend'])) {
            $iconPrepend = '<i class="icon-prepend fa ' . $attributes['iconPrepend'] . '"></i>';
            unset($attributes['iconPrepend']);
        }
        if (isset($attributes['iconAppend'])) {
            $iconAppend = '<i class="icon-append fa ' . $attributes['iconAppend'] . '"></i>';
            unset($attributes['iconAppend']);
        }
        if (isset($attributes['disabled'])) {
            $disabled = 'state-disabled';
        }
        $attributes['label'] = false;
        $html = $label . '<label class="input ' . $disabled . '">' . $iconPrepend . $this->Form->input($name, $attributes) . $iconAppend . '</label>';
        return $this->_fnWrapWithSectionTag($html, $col);
    }

    public function inputAutocomplete($name, $col, $list, $attributes) {
        $label = '';
        $iconPrepend = '';
        $iconAppend = '';
        $disabled = '';
        $attributes['div'] = false;
        $attributes['list'] = $list['id'];
        $attributes['autocomplete'] = 'off';
        $attributes['class'] = 'input-sm'; //due a smartadmin bug 
        if (isset($attributes['type'])) {
            $attributes['type'] = $attributes['type'];
        } else {
            $attributes['type'] = 'text';
        }
        if (isset($attributes['label'])) {
            $label = '<label class="label">' . $attributes['label'] . '</label>';
        }
        if (isset($attributes['iconPrepend'])) {
            $iconPrepend = '<i class="icon-prepend fa ' . $attributes['iconPrepend'] . '"></i>';
            unset($attributes['iconPrepend']);
        }
        if (isset($attributes['iconAppend'])) {
            $iconAppend = '<i class="icon-append fa ' . $attributes['iconAppend'] . '"></i>';
            unset($attributes['iconAppend']);
        }
        if (isset($attributes['disabled'])) {
            $disabled = 'state-disabled';
        }
        $attributes['label'] = false;
        $html = $label . '<label class="input ' . $disabled . '">' . $iconPrepend . $this->Form->input($name, $attributes) . $iconAppend;
        $html .= '<datalist id="' . $list['id'] . '">';
        foreach ($list['list'] as $value => $name) {
            $html .= '<option value="' . $value . '">' . $name . '</option>';
        }
        $html .= '</datalist>';
        $html .= '</label>';
        return $this->_fnWrapWithSectionTag($html, $col);
    }

    public function textarea($name, $col, $attributes) {
        $label = '';
        $disabled = '';
        $attributes['div'] = false;
        $attributes['type'] = 'text';
        if (isset($attributes['label'])) {
            $label = '<label class="label">' . $attributes['label'] . '</label>';
        }
        if (isset($attributes['disabled'])) {
            $disabled = 'state-disabled';
        }
        $attributes['label'] = false;
        $html = $label . '<label class="textarea ' . $disabled . '">' . $this->Form->input($name, $attributes) . '</label>';
        return $this->_fnWrapWithSectionTag($html, $col);
    }

    public function select($name, $col, $attributes = null) {
        $label = '';
        $disabled = '';
        $attributes['div'] = false;
        $attributes['type'] = 'select';
        $arrow = '<i></i>';
        if (isset($attributes['label'])) {
            $label = '<label class="label">' . $attributes['label'] . '</label>';
        }
        if (isset($attributes['disabled'])) {
            $disabled = 'state-disabled';
        }
        if (isset($attributes['select2'])) {
            $arrow = '';
        }
        $attributes['label'] = false;
        $html = $label . '<label class="select ' . $disabled . '">' . $this->Form->input($name, $attributes) . $arrow.'</label>';
        return $this->_fnWrapWithSectionTag($html, $col);
    }

    public function radio($name, $col, $type, $attributes = null) {
        $label = '';
        $disabled = '';
        $attributes['div'] = false;
        $attributes['legend'] = false;
        $attributes['type'] = 'select';
        if (isset($attributes['label'])) {
            $label = '<label class="label">' . $attributes['label'] . '</label>';
        }
        if (isset($attributes['disabled'])) {
            $disabled = 'state-disabled';
        }
        $attributes['label'] = false;

        $options = array();
        foreach ($attributes['options'] as $key => $value) { //key=>'name'
            $options[$value] = array($key => '');
        }
        unset($attributes['options']);
        //Generating smartadmin radiobutton one by one
        $html = $label;
        $html .= '<div class="' . $type . '">';
        foreach ($options as $key => $value) {//name = array(key=>'')
            //*********************************Important to work properly multiple radiobuttons 
            if ($attributes['value'] == '') {
                $attributes['value'] = false;
            }
            //*********************************
            $html .= '<label class="radio ' . $disabled . '">';
            $html .= $this->Form->radio($name, $value, $attributes);
            $html .= '<i></i>' . $key . '</label>';
        }
        $html .= '</div>';
        return $this->_fnWrapWithSectionTag($html, $col);
    }

    //Must do another function class input-group in a near future :: check: bootstrap-forms.html


    private function _fnWrapWithSectionTag($htmlControl, $col) {
        $class = ''; //if empty fills the entire space
        if ($col != '') {
            $class = 'class="col ' . $col . '"';
        }
        $html = '<section ' . $class . '>';
        $html .= $htmlControl;
        $html .= '</section>';
        return $html;
    }

    public function create($model, $attributes = null) {
        if ($attributes == null) {
            $attributes['class'] = 'smart-form';
            $attributes['inputDefaults']['wrapInput'] = false;
        }
        return $this->Form->create($model, $attributes);
    }

    public function end() {
        return $this->Form->end();
    }

    public function hidden($value, $attributes = array()) {
        return $this->Form->hidden($value, $attributes);
    }

    public function button($value, $attributes = array()) {
        return $this->Form->button($value, $attributes);
    }

//END CLASS    
}
