<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property Agent $agents
 * @property Company $companies
 */
class State extends Model
{
    use HasFactory;

    public function agents()
    {
        return $this->hasMany(Agent::class, 'state_id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'state_id');
    }
}

