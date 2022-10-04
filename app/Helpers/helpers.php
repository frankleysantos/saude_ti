<?php 

class Helpers {
    static function formatDate($data, $formatNew='Y-m-d', $formatOld='d/m/Y'){
        return Carbon\Carbon::createFromFormat($formatOld, $data)->format($formatNew);
    }
}
