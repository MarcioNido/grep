<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * Eloquent Model for table blog_post
 * @package App\Blog
 */
class Post extends Model
{
    // table name
    protected $table = "blog_post";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorias()
    {
        return $this->belongsToMany('App\Blog\Categoria', 'blog_categoria_post', 'post_id', 'categoria_id');
    }


    public function tags()
    {
        return $this->belongsToMany('App\Blog\Tag', 'blog_post_tag', 'post_id', 'tag_id');
    }

    public function imagem()
    {
        return $this->hasOne('App\Blog\Imagem');
    }


}
