<?php
namespace atikullahnasar\setting\Repositories\CountryCityState;

use atikullahnasar\setting\Models\Country;
use atikullahnasar\setting\Repositories\BaseRepository;

class CountryCityStateRepository extends BaseRepository implements CountryCityStateRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}