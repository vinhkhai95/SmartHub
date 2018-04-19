<?php

class HtmlForms{
    public static function fill_object(&$object){
        foreach ($object as $key => $value) {
            if (isset($_POST[$key])){
                $setter = '$object->set' . $key;
            }
        }
    }
}