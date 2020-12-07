<?php
namespace Mmrtonmoybd\Comment;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


trait HasComments
{
    public function comments()
    {
        return $this->morphMany(config('comment.model'), 'commentable');
    }

    public function canBeRated()
    {
        return false;
    }

    public function mustBeApproved()
    {
        return false;
    }

    public function primaryId()
    {
        return (string)$this->getAttribute($this->primaryKey);
    }

    public function averageRate(int $round = 2)
    {
        if (!$this->canBeRated()) {
            return 0;
        }

        $rates = $this->comments()->approvedComments();

        if (!$rates->exists()) {
            return 0;
        }

        return round((float)$rates->avg('rate'), $round);
    }

    public function totalCommentsCount()
    {
        if (!$this->mustBeApproved()) {
            return $this->comments()->count();
        }

        return $this->comments()->approvedComments()->count();
    }
}
