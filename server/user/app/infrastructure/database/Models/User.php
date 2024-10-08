<?php

namespace app\infrastructure\database\Models;

use DateTime;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property DateTime|null $email_verified_at
 * @property DateTime $created_at
 * @property string|null $email_code_verification
 */
class User extends Model
{
    use HasUuids;

    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'email_verified_at',
        'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

}
