<?php

namespace atikullahnasar\setting\Repositories\CustomPages;

use atikullahnasar\setting\Models\CustomPage;
use atikullahnasar\setting\Repositories\BaseRepository;

class CustomPageRepository extends BaseRepository implements CustomPageRepositoryInterface
{
    public function __construct(CustomPage $model)
    {
        parent::__construct($model);
    }
}
