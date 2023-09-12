<?php


class D94T1000 extends Eloquent  {

    protected $connection="CONDEFAULT";
	protected $table = 'D94T1000';
    protected $primaryKey ="ReportGroupID";
   // protected $fillable = array('username', 'email', 'password');
    public $timestamps = false;
    public function changeConnection($conn)
    {
        $this->connection = $conn;
    }
}
