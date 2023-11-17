<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'amount',
        'currency',
        'status',
    ];

    /**
     * Get the account from which the transfer is made.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromAccount()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    /**
     * Get the account to which the transfer is made.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toAccount()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }
}
