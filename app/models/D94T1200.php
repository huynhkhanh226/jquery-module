<?php


class D94T1200 extends Eloquent  {

    protected $connection="CONDEFAULT";
	protected $table = 'D94T1200';
    protected $primaryKey ="MReportID";
   // protected $fillable = array('username', 'email', 'password');
    public $timestamps = false;
    public function changeConnection($conn)
    {
        $this->connection = $conn;
    }
}
