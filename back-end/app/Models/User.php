<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, SoftDeletes;
    
    public $table = 'user';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_user_id'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'type_user_id' => 'integer'
    ];

    public function typeUser()
    {
        return $this->belongsTo(TypeUser::class, 'type_user_id', 'id');
    }

    public function getCreatedAtUserAttribute() 
    {
    return date("d/m/Y H:i:s", strtotime($this->created_at));
    }
}
