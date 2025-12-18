<?php

namespace atikullahnasar\setting\Repositories\Settings;

use atikullahnasar\setting\Repositories\BaseRepositoryInterface;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Update or create a record
     */
    public function updateOrCreate(array $attributes, array $values = []);
    public function findByKey(string $key);
}
