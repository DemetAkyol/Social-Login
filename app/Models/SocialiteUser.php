<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialiteUser extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];
    protected $table = "social_facebook_accounts";
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
