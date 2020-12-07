<?php
namespace Mmrtonmoybd\Comment\Contracts;

interface Commentable {
    public function comments();

    public function canBeRated();

    public function mustBeApproved();

    public function primaryId();
}

