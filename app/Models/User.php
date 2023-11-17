<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    /**
     * The attribute that are mass assignable
     *
     * @var array
     */

    protected $fillable = [
        'username',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */

    protected $hidden = [
        'password'
    ];

    /**
     * Users-Accounts relationship
     *
     * @result \Illuminate\Database\Eloquent\Relationships\HasMany
     */

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    /**
     * User-transactions relationship. Assuming each user can have multiple transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Account::class);
    }
}
