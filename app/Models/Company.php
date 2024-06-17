<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $state_id
 * @property int|null $registered_agent_id
 * @property string $name
 * @property int $registered_agent_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = 'companies';
    protected $fillable = ['user_id', 'state_id', 'registered_agent_id', 'name', 'registered_agent_type'];
    protected $hidden   = ['registered_agent_type', 'created_at'];
}
