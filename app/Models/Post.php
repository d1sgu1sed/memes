<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; //Для времени
class Post extends Model
{
  protected $fillable = ['user_id', 'title', 'content', 'image', 'published_at'];
  protected $dates = ['published_at'];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function comments()
  {
      return $this->hasMany(Comment::class);
  }

  public function isPublished()
  {
      return $this->published_at === null || $this->published_at <= Carbon::now();
  }

  public function isSoonToBePublished()
  {
      return $this->published_at !== null && $this->published_at > Carbon::now() && $this->published_at <= Carbon::now()->addHours(1);
  }
}
