<?php

namespace App;

use Illuminate\Notifications\Notifiable; #REQUIRED
use Illuminate\Foundation\Auth\User as Authenticatable; #ERQUIRED

class User extends Authenticatable
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username',
		'first_name',
		 'last_name', 
		 'type',
		 'email',
		 'password'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

}