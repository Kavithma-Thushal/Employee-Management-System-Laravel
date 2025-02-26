<?php

namespace App\Repositories\Media;

use App\Models\Media;
use App\Repositories\CrudRepository;

class MediaRepository extends CrudRepository implements MediaRepositoryInterface
{
    public function __construct(Media $model)
    {
        parent::__construct($model);
    }
}
