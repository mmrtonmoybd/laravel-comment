<?php
namespace Mmrtonmoybd\Comment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mmrtonmoybd\Comment\Contracts\Commentable;
use Illuminate\Database\Eloquent\Builder;
use Mmrtonmoybd\Comment\HasComments;

class Comment extends Model implements Commentable
{
    use HasFactory, HasComments;
    
    
    protected $guarded = [];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function commented()
    {
        return $this->morphTo();
    }

    public function scopeApprovedComments(Builder $query)
    {
        return $query->where('approved', true);
    }

    public function approve()
    {
        $this->approved = true;
        $this->save();

        return $this;
    }

}
