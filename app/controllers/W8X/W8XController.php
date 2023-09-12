<?php
namespace W8X;

class W8XController extends \BaseController {
    function returnDataOne($sql, $bG4){
        if($bG4)
            return $this->connectionHR->selectOne($sql);
        else
            return $this->connection->selectOne($sql);
    }

    function returnData($sql, $bG4){
        if($bG4)
            return $this->connectionHR->select($sql);
        else
            return $this->connection->select($sql);
    }
}
