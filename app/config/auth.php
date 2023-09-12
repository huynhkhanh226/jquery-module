<?php

return array(
	'multi' => array(
		'ess' => array(
			'driver' => 'eloquent',
			'model' => 'D00T0030'
		),
		'user' => array(
			'driver' => 'eloquent',
			'model' => 'D00T0030'
		)
	),


	'reminder' => array(

		'email' => 'emails.auth.reminder',

		'table' => 'password_reminders',

		'expire' => 60,

	),

);
