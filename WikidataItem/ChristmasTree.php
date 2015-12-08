<?php

namespace WikidataWorkBench\WikidataItem;

class ChristmasTree extends Item {
    public $height;
    public $year;
    
    public function getClaims () {
        $claims = [];

        $claims["Lfr"] = "sapin de Noël de la Grand-Place de Bruxelles $this->year";
        $claims["Len"] = "Brussels Grand Place chistmas tree $this->year";        
        $claims["Dfr"] = "sapin de Noël de la Grand-Place de Bruxelles";
        $claims["Den"] = "Brussels Grand Place chistmas tree";
        $claims["P276"] = 'Q215429'; // Grand-Place de Bruxelles
        
        $claims["P31"] = 'Q47128';
        $claims["P19"] = $this->origin;
        $claims["P2048"] = $this->height;
        $claims["P571"] = "+0000000" . $this->year . "-00-00T00:00:00Z/11";
        
        return $claims;
    }
}
