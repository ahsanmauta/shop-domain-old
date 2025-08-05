<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Auctions extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'domain',
	'category',
	'price',
    'register',
    'endtime',
	'country',
	'traffic',
	'about',
	'sellernote',
	'verificationcode',
	'status',
	'iduser',
  ];
  
  protected $table = 'auction';


}