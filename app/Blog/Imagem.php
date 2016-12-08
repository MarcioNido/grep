<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * Eloquent Model for table blog_post
 * @package App\Blog
 */
class Imagem extends Model
{
    // table name
    protected $table = "blog_post_imagem";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Blog\Post', 'blog_post');
    }

}
