<?php
/**
 * @SWG\Definition(definition="App\Models\Base\Users\User",required={"first_name", "last_name","email"})
 *
 * @SWG\Property(
 *     property="first_name",
 *     type="string",
 *     example="Іван"
 * )
 * @SWG\Property(
 *     property="last_name",
 *     type="string",
 *     example="Іванович"
 * )
 * @SWG\Property(
 *     property="email",
 *     type="string",
 *     example="email@email.com"
 * )

 */
namespace App\Models\Base\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = ['created_at', 'updated_at',"password"];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
