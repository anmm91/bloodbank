<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'content', 'category_id');
    protected $appends=array('is_favourite');

    public function getIsFavouriteAttribute()
    {
        if(auth()->guard('client')->check()) {


            $favourite = $this->whereHas('clients', function ($query) {
                $query->where('client_post.client_id', auth()->guard('client')->user()->id);
                $query->where('client_post.post_id', $this->id);
            })->first();
            // client
            // null
            if ($favourite) {
                return true;
            }
        }
        return false;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
