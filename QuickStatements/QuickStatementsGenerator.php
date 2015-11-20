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
    
    public static function createItem (Item $item) {
        $lang = static::DEFAULT_LABEL_LANGUAGE;
        
        $instructions = [];
        $instructions[] = "CREATE";
        $instructions[] = "LAST\tL$lang\t$item->title";
        foreach ($item->getClaims() as $property => $value) {
            $instructions[] = "LAST\t$property\t$value";
        }
        return $instructions;
    }
}

/*
CREATE

LAST TAB Lfr TAB "Le croissant magnifique!"
*/