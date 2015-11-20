<?php

namespace WikidataWorkBench\WikidataItem;

class Episode extends Item {
    public function getClaims () {
        $claims = [];
        
        $claims["Dfr"] = "épisode de " . $this->series->title;
        $claims["Den"] = $this->series->title . " episode";
        
        $claims["P31"] = 'Q1983062';
        $claims["P179"] = $this->series->QID;
        $claims["P361"] = $this->seasonQID; // part of
        $claims["P1545"] = '"' . $this->number . '"';
        $claims["P577"] = "+0000000" . $this->date . "T00:00:00Z/11";
        
        return $claims;
    }
}
