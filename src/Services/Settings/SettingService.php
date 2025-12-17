<?php

namespace atikullahnasar\setting\Services\Settings;

use App\Models\User;
use atikullahnasar\setting\Repositories\Settings\SettingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class SettingService implements SettingServiceInterface
{
    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function allSettings()
    {
        // $authUser = auth()->user();
        $authUser = Auth::user();
        $userId = null;

        if ($authUser) {
            // Use owner_id if available, otherwise use own id
            $userId = $authUser->owner_id ?? $authUser->id;
        }
        // Try to get settings for that user (owner or self)
        $settings = $this->settingRepository
            ->findWhere(['user_id' => $userId], ['value', 'key'], [])
            ->pluck('value', 'key')
            ->toArray();

        // If no settings found, fallback to admin
        if (empty($settings)) {
            $admin = User::where('role', 'Admin')->first();
            if ($admin) {
                $settings = $this->settingRepository
                    ->findWhere(['user_id' => $admin->id], ['value', 'key'], [])
                    ->pluck('value', 'key')
                    ->toArray();
            }
        }

        return $settings;
    }

    public function getAllSettings()
    {
        $user = Auth::user();
        $id = $user->owner_id ?? $user->id;

        $settings = $this->settingRepository
            ->findWhere(['user_id' => $id], ['value', 'key'], [])
            ->pluck('value', 'key')
            ->toArray();
        return $settings;
    }

    public function updateSettings(array $data)
    {
        $user = Auth::user();
        $userId = $user->owner_id ?? $user->id;
        foreach ($data as $key => $value) {
            if ($key === 'auth_page_points' && is_array($value)) {
                $value = json_encode($value);
            }
            $this->settingRepository->updateOrCreate(['user_id' => $userId, 'key' => $key], ['value' => $value]);
        }
    }

    private function uploadFile(\Illuminate\Http\UploadedFile $file, string $directory): string
    {
        try {
            return $file->store($directory, 'public');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error uploading file: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateSettingUnique(string $key, array $validatedData, Request $request)
    {
        try {
            $currentSettings = $this->getSetting($key, []); // Get current settings to retain old files
            $dataToSave = $validatedData; // Start with validated data

            // Handle file uploads and dynamic data based on the section key
            switch ($key) {

                case 'core_features':
                    $existing = $this->getSetting($key, []);
                    $existingItems = $existing['items'] ?? [];
                    $newItems = $validatedData['items'] ?? [];
                    $removedItems = array_diff_key($existingItems, $newItems);
                    foreach ($removedItems as $item) {
                        if (!empty($item['image']) && Storage::disk('public')->exists($item['image'])) {
                            Storage::disk('public')->delete($item['image']);
                        }
                    }

                    $items = [];
                    if (isset($validatedData['items']) && is_array($validatedData['items'])) {
                        foreach ($validatedData['items'] as $index => $item) {
                            $newItem = $item;
                            if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                                $newItem['image'] = $this->uploadFile($item['image'], 'core_feature');
                            } else {
                                $newItem['image'] = $currentSettings['items'][$index]['image'] ?? null;
                            }
                            $items[] = $newItem;
                        }
                    }
                    $dataToSave['items'] = $items;
                    break;

                // Footer sections and simple sections
                case 'footer_column2':
                case 'footer_column3':
                case 'footer_column4':
                    if (!array_key_exists('pages', $dataToSave)) {
                        $dataToSave['pages'] = [];
                        // dd('if',$currentSettings, $dataToSave);
                    }
                    // dd('else',$currentSettings, $dataToSave);

                    break;
                case 'footer_column1':
                case 'footer_social':
                case 'email_settings':
                case 'company_settings':
                case 'payment_settings':
                case 'google_recaptcha_settings':
                case 'site_seo_settings':
                case 'general_settings':

                case 'header_menu':
                case 'banner_settings':
                case 'overview':
                case 'about_us':
                case 'offer':
                case 'blog':
                case 'about_footer':
                case 'testimonials':
                case 'faq_section':
                    // For these sections, $dataToSave is already $validatedData.
                    $dataToSave = array_merge($currentSettings, $validatedData);
                    break;
                default:
                    // Should not happen if controller handles keys correctly
                    break;
            }

            $user = Auth::user();
            $userId = $user->owner_id ?? $user->id;
            $setting = $this->settingRepository->updateOrCreate(['key' => $key, 'user_id' => $userId], ['value' => $dataToSave]);

            return $setting;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error updating setting: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSetting(string $key, $default = null)
    {
        try {
            $setting = $this->settingRepository->findByKey($key);
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error getting setting: ' . $e->getMessage());
            return $default; // Return default on error
        }
    }
}
