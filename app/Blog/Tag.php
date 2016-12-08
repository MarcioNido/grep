<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * Eloquent Model for table blog_post
 * @package App\Blog
 */
class Tag extends Model
{
    // table name
    protected $table = "blog_tag";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posts()
    {
        return $this->belongsToMany('App\Blog\Post', 'blog_post_tag', 'tag_id', 'post_id');
    }

}
