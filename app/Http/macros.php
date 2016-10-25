<?php
/*
 * Created at 6/30/2015
 * Author: Salikh Gurgenidze
 * Nickname: Vati Child
 * Company: IT-Solutions
 * Website: www.it-solutions.ge
 */



/**
 * @param $name
 * @param array $list
 * @param null $selected
 * @param array $options
 * @return Select Categories List Macro for FormBuilder
 */

use Collective\Html\FormBuilder;
use Illuminate\Support\Str;

FormBuilder::macro('selectCat',
    function($name, $list = array(), $selected = 0, $options = array()){

        // When building a select box the "value" attribute is really the selected one
        // so we will use that when checking the model or session for a value which
        // should provide a convenient method of re-populating the forms on post.
        $selected = $this->getValueAttribute($name, $selected);

        $options['id'] = $this->getIdAttribute($name, $options);

        if ( ! isset($options['name'])) $options['name'] = $name;

        // We will simply loop through the options and build an HTML value for each of
        // them until we have an array of HTML declarations. Then we will join them
        // all together into one single HTML element that can be put on the form.
        $html = array();

        $html[] = $this->OptionCat($list,$selected,(isset($options['data-root']) ? $options['data-root'] : 0) ,$i=0);

        // Once we have all of this HTML, we can join this into a single element after
        // formatting the attributes into an HTML "attributes" string, then we will
        // build out a final select statement, which will contain all the values.
        $options = $this->html->attributes($options);

        $list = implode('', $html);

        return "<select{$options}><option value=0>---</option>{$list}</select>";

    });


/**
 * @param $tree
 * @param $selected
 * @param $root
 * @param $i
 * @return Get List of Categories as Parent -- Children
 */

FormBuilder::macro('OptionCat',
    function($tree, $selected,  $root, $i){
        $output = '';
        $line = ($i == 0) ? '' : '-';
        for($a=0;$a<$i;$a++){
            $line .= $line;
        }
        $i++;

        if(!is_null($tree) && count($tree) > 0) {
            foreach($tree as $child => $parent) {
                if($parent->parent == $root) {
                    unset($tree[$child]);
                    $sel = $this->getSelectedValue($parent->id, $selected);
                    $options = array('value' => e($parent->id), 'selected' => $sel);
                    $output .= '<option '.$this->html->attributes($options).'>'.$line.' '.trans($parent->name).'</option>';
                    $output .= $this->OptionCat($tree, $selected, $parent->id,$i);
                }
            }
        }

        return $output;
    });

Str::macro('slug_utf8', function($title, $separator = '-')
{
    //$title = static::ascii($title); //comment it out to suport farsi

    // Convert all dashes/underscores into separator
    $flip = $separator == '-' ? '_' : '-';

    $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

    return trim($title, $separator);

});