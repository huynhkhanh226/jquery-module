<?php


class D94T0000 extends Eloquent  {

    protected $connection="CONDEFAULT";
	protected $table = 'D94T0000';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
    public function changeConnection($conn)
    {
        $this->connection = $conn;
    }
}
