<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'mission';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'has_finished',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'has_finished' => 'bool',
        'user_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStatusMissionAttribute() 
    {
        if ($this->has_finished) {
            return 'SIM';
        }

        return 'NÃO';
    }

    public function getCreatedAtMissionAttribute() 
    {
    return date("d/m/Y H:i:s", strtotime($this->created_at));
    }
}
