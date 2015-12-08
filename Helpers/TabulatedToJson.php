<?php

namespace WikidataWorkBench\Helpers;

class TabulatedToJson {
    public static function getCamelCase ($expression, $firstCharacterInLowercase = true) {
        $word = ucwords($expression);
        if ($firstCharacterInLowercase) {
            $word[0] = strtolower($word);
        }
        $word =  str_replace(" ", "", $word);
        return $word;
    }
    
    public static function readTabulated ($filename) {
        $rows = file($filename);
        
        //Keys are read from the first line of the document
        $keys = explode("\t", trim($rows[0]));
        array_walk($keys, function (&$item) {
            $item = TabulatedToJson::getCamelCase($item);
        });
        
        //Expected format: field1\tfield2\tfield3
        $data = [];
        for ($i = 1 ; $i < count($rows) ; $i++) {
            $values = explode("\t", trim($rows[$i]));
            $data[] = array_combine($keys, $values);
        }
        
        return $data;
    }
    
    public static function tabulatedToJson ($filename) {
        $data = static::readTabulated($filename);
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
