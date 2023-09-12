<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class D00T0030 extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $connection= 'sqlsrvLMS';
	protected $table = 'D00T0030';
    protected $primaryKey ="UserID";
    public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('UserPassword','remember_token');

    public function Avatar() {
        if (Schema::hasTable('D09T0300'))
            return $this->hasOne('D09T0300','EmployeeID','HREmployeeID')->first();
        else
            return ["EmployeePicture"=>""];
    }
    public function getAuthPassword() {

        return Hash::make($this->UserPassword);
    }

    public function getRememberToken()
    {
        return $this->LogonToken;
    }

    public function setRememberToken($value)
    {
        $this->LogonToken = $value;
    }

    public function getRememberTokenName()
    {
        return 'LogonToken';
    }

}
