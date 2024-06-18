<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property string $email
 * @property int $capacity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
 class Agent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = 'registered_agents';
    protected $fillable = ['state_id', 'name', 'email', 'capacity'];
    protected $hidden   = ['updated_at', 'deleted_at'];

    public function companies()
    {
        return $this->hasMany(Company::class, 'registered_agent_id','id');
    }

    public function taken() {
        $this->loadCount('companies');
        return ($this['companies_count'] * 100) / $this->capacity;
    }

    public function theLimitWasExceeded(): bool {
        $limit = env('LIMIT_OF_COMPANIES_ASSIGNED_TO_AN_AGENT');

        return ceil($this->taken()) >= $limit;
    }

}
