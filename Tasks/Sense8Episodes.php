<?php

namespace WikidataWorkBench\Tasks;

class Sense8Episodes extends Task {
    const DATASOURCE = 'data/sense8-episodes-S01.dat';
    
    public static function getSeries () {
        $item = new \WikidataWorkBench\WikidataItem\Item;
        $item->title = 'Sense8';
        $item->QID = 'Q17080059';
        return $item;
    }
    
    public static function getEpisodes ($file = self::DATASOURCE) {
        $episodes = [];
        $series = static::getSeries();
        
        $lines = array_reverse(file($file));
        foreach ($lines as $line) {
            $data = explode('. ', $line, 2);
            $episodeTitle = trim($data[1]);
            $episodeNumber = trim($data[0]);
            
            $episode = new \WikidataWorkBench\WikidataItem\Episode;
            $episode->series = $series;
            $episode->seasonQID = 'Q21096791';
            $episode->number = $episodeNumber;
            $episode->title = $episodeTitle;
            $episode->date = '2015-06-05';
            $episodes[] = $episode;
        }
        
        return $episodes;
    } 
    
    public static function run () {
        $episodes = static::getEpisodes();
        \WikidataWorkBench\QuickStatements\QuickStatementsGenerator::create($episodes);
    }
}
