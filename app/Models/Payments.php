<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Payments extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'iduser',
	'idauctionbids',
	'tanggal',
	'kurs',
	'amountdp',
	'amount',
    'tipebayar',
    'note',
	'reference',
	'paymentorderid',
  ];
  
  protected $table = 'payment';


}