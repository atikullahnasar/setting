<?php

namespace atikullahnasar\setting\Services\Settings;

use Illuminate\Http\Request;

interface SettingServiceInterface
{
    public function getAllSettings();
    public function allSettings();
    public function updateSettings(array $data);
    public function getSetting(string $key, array $default = []);

    public function updateSettingUnique(string $key, array $data, Request $request);
}
