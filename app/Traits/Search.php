<?php

namespace App\Traits;


trait Search
{
    public function fullTextSearch($query,$column,$string){
        foreach ($column as $item){
            return $query->whereRaw("MATCH($item) AGAINST( '$string' IN NATURAL LANGUAGE MODE)");

        }
    }


}

?>