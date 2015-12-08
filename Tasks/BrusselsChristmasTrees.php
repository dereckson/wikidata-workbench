<?php

namespace WikidataWorkBench\Tasks;

use WikidataWorkBench\Helpers\TabulatedToJson;
use WikidataWorkBench\QuickStatements\QuickStatementsGenerator;
use WikidataWorkBench\WikidataItem\ChristmasTree;

class BrusselsChristmasTrees extends Task {
    const DATASOURCE_DAT = 'data/brussels-christmas.dat';
    const DATASOURCE_JSON = 'data/brussels-christmas.json';

    public static function generateJsonDatasource () {
        $data = TabulatedToJson::tabulatedToJson(static::DATASOURCE_DAT);
        file_put_contents(static::DATASOURCE_JSON, $data);
    }
    
    public static function getItems () {
        $items = [];
        $trees = json_decode(file_get_contents(static::DATASOURCE_JSON));
        foreach ($trees as $tree) {
            //TODO: add Composer to have easy deps and use JsonMapper here?
            $item = new ChristmasTree;
            $item->year = $tree->year;
            $item->origin = $tree->origin;
            $item->height = $tree->height;
            $items[] = $item;
        }
        return $items;
    }
    
    public static function run () {
        if (!file_exists(static::DATASOURCE_JSON)) {
            self::generateJsonDatasource();
        }
        $items = static::getItems();
        QuickStatementsGenerator::create($items);
    }
}
