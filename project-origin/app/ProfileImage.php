<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    protected $fillable = ['filename', 'user_id', 'mime', 'path', 'size'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function publciPath()
    {
      return '/storage/images/userProfileImage/'. $this->path.'/'.$this->filename;
    }

}
