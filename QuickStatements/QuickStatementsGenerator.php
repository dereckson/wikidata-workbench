<?php

namespace WikidataWorkBench\QuickStatements;

use WikidataWorkBench\WikidataItem\Item as Item;

class QuickStatementsGenerator {
    
    const DEFAULT_LABEL_LANGUAGE = 'en';
    
    public static function create ($toCreate) {
        if ($toCreate instanceof Item) {
            $items = [$toCreate];
        } elseif (is_array($toCreate) || $toCreate instanceof Traversable) {
            $items = $toCreate;
        } else {
            throw new \InvalidArgumentException("An item or a collection of items were expected.");
        }
        
        foreach ($items as $item) {
            $instructions = static::createItem($item);
            echo implode("\n", $instructions), "\n";
        }
    }
    
    public static function formatValue ($value) {
        if (\strpos($value, " ")) {
            return '"' . $value . '"';
        }
        return $value;
    }

    public static function createItem (Item $item) {
        $instructions = [];
        $instructions[] = "CREATE";
        if (property_exists($item, 'title')) {
            $lang = static::DEFAULT_LABEL_LANGUAGE;
            $instructions[] = "LAST\tL$lang\t" . static::formatValue($value);
        }
        foreach ($item->getClaims() as $property => $value) {
            $instructions[] = "LAST\t$property\t" . static::formatValue($value);
        }
        return $instructions;
    }
}
