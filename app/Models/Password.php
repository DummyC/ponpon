<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Password extends Model
{
    /** @use HasFactory<\Database\Factories\PasswordFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loginname',
        'email',
        'password',
        'note'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'loginname',
        'email',
        'password',
        'note',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email' => 'encrypted',
            'password' => 'encrypted',
            'note' => 'encrypted',
        ];
    }

    // public function toSearchableArray()
    // {
    //     return [
    //         'loginname' => $this->loginname,
    //         'email' => $this->email,
    //         'note' => $this->note,
    //     ];
    // }
}
