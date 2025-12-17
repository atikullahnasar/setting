<?php

namespace atikullahnasar\setting\Repositories\Settings;

use atikullahnasar\setting\Models\Setting;
use atikullahnasar\setting\Repositories\BaseRepository;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function findByKey(string $key)
    {
        return $this->model->where('key', $key)->first();
    }
}
