<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * Eloquent Model for table blog_post
 * @package App\Blog
 */
class Categoria extends Model
{
    // table name
    protected $table = "blog_categoria";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posts()
    {
        return $this->belongsToMany('App\Blog\Post', 'blog_categoria_post', 'categoria_id', 'post_id');
    }

}
