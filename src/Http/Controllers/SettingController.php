<?php

namespace atikullahnasar\setting\Http\Controllers;

use App\Http\Controllers\Controller;
use atikullahnasar\setting\Http\Requests\UpdateChooseUsRequest;
use atikullahnasar\setting\Http\Requests\UpdateOfferRequest;
use atikullahnasar\setting\Http\Requests\UpdateCoreFeaturesRequest;
use atikullahnasar\setting\Http\Requests\UpdateFooterColumn1Request;
use atikullahnasar\setting\Http\Requests\UpdateFooterColumn2Request;
use atikullahnasar\setting\Http\Requests\UpdateFooterColumn3Request;
use atikullahnasar\setting\Http\Requests\UpdateFooterColumn4Request;
use atikullahnasar\setting\Http\Requests\UpdateFooterSocialRequest;
use atikullahnasar\setting\Http\Requests\UpdateGeneralSettings;
use atikullahnasar\setting\Http\Requests\UpdateLoginSettingsRequest;
use atikullahnasar\setting\Repositories\CountryCityState\CountryCityStateRepositoryInterface;
use atikullahnasar\setting\Services\CustomPages\CustomPageServiceInterface;
use atikullahnasar\setting\Services\Settings\SettingServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\View;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingServiceInterface $settingService,
        private readonly CustomPageServiceInterface $customPageService,
        private readonly CountryCityStateRepositoryInterface $cscr,
    ) {}

    public function footerSettings()
    {
        $customPages = $this->customPageService->getAllWithRelations();
        $settings = [
            'footer_column1' => $this->settingService->getSetting('footer_column1', []),
            'footer_column2' => $this->settingService->getSetting('footer_column2', []),
            'footer_column3' => $this->settingService->getSetting('footer_column3', []),
            'footer_column4' => $this->settingService->getSetting('footer_column4', []),
            'footer_social' => $this->settingService->getSetting('footer_social', []),
        ];

        // if (View::exists('setting::system-settings.footer.index')) {
        //     dd('setting::system-settings.footer.index');
        // } else {
        //     dd('setting::system-settings.footer.index');
        // }
        // \dd($settings);
        return view('setting::system-settings.footer.index', compact('settings', 'customPages'));
    }

    public function settings()
    {
        $settings = $this->settingService->getAllSettings();
        $countries = $this->cscr->all(['id', 'timezones'], []);
        return view('setting::system-settings.settings.index', compact('settings', 'countries'));
    }

    public function homepageSettings()
    {
        $settings = $this->settingService->getAllSettings();
        $customPages = $this->customPageService->getAllWithRelations();
        return view('setting::system-settings.homepage.index', compact('settings', 'customPages'));
    }

    public function update(Request $request)
    {
        $key = $request->input('_key');
        switch ($key) {
            case 'choose_us':
                return $this->updateChooseUs(app(UpdateChooseUsRequest::class));
            case 'core_features':
                return $this->updateCoreFeatures(app(UpdateCoreFeaturesRequest::class));
            case 'offer':
                return $this->updateOffer(app(UpdateOfferRequest::class));
            case 'footer_column1':
                return $this->updateFooterColumn1(app(UpdateFooterColumn1Request::class));
            case 'footer_column2':
                return $this->updateFooterColumn2(app(UpdateFooterColumn2Request::class));
            case 'footer_column3':
                return $this->updateFooterColumn3(app(UpdateFooterColumn3Request::class));
            case 'footer_column4':
                return $this->updateFooterColumn4(app(UpdateFooterColumn4Request::class));
            case 'footer_social':
                return $this->updateFooterSocial(app(UpdateFooterSocialRequest::class));
            case 'about_footer':
            case 'header_menu':
            case 'banner_settings':
            case 'overview':
            case 'about_us':
            case 'blog':
            case 'testimonials':
            case 'faq_section':
            case 'email_settings':
            case 'company_settings':
            case 'payment_settings':
            case 'google_recaptcha_settings':
            case 'site_seo_settings':
            case 'general_settings':
                return $this->updateGeneralSettings(app(UpdateGeneralSettings::class));
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Unknown settings section provided.'
                ], 400);
        }
    }

    private function updateGeneralSettings(UpdateGeneralSettings $request)
    {
        $key = $request->input('_key');
        $existing = $this->settingService->getSetting($key, []);

        // merge existing data so old images stay available
        $data = array_merge($existing, $request->except(['_token', '_key']));

        $imageFields = [
            'logo' => 'logos',
            'favicon' => 'logos',
            'logo_light' => 'logos',
            'landing_page_logo' => 'logos',
            'meta_image' => 'logos',
            'header_sub_image' => 'homepage',
            'header_main_image' => 'homepage',
            'box1_image' => 'homepage',
            'box2_image' => 'homepage',
            'box3_image' => 'homepage',
            'box4_image' => 'homepage',
            'banner_image' => 'homepage',
        ];
        foreach ($imageFields as $field => $folder) {
            if ($request->hasFile($field)) {

                // delete old image if exists
                if (!empty($existing[$field]) && Storage::disk('public')->exists($existing[$field])) {
                    Storage::disk('public')->delete($existing[$field]);
                }

                // save new image
                $data[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        $this->settingService->updateSettingUnique($key, $data, $request);

        return response()->json([
            'success' => true,
            'message' => ucfirst(str_replace('_', ' ', $key)) . ' updated successfully!'
        ]);
    }

    private function updateChooseUs(UpdateChooseUsRequest $request)
    {
        $key = $request->input('_key');
        $existing = $this->settingService->getSetting($key, []);
        $existingItems = $existing['items'] ?? [];
        $newItems = $request->validated()['items'] ?? [];

        // Handle removed items
        $removedItems = array_diff_key($existingItems, $newItems);
        foreach ($removedItems as $item) {
            if (!empty($item['image']) && Storage::disk('public')->exists($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
        }

        // Handle new / updated items
        foreach ($newItems as $index => $item) {
            if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete old image
                if (
                    isset($existingItems[$index]['image']) &&
                    Storage::disk('public')->exists($existingItems[$index]['image'])
                ) {
                    Storage::disk('public')->delete($existingItems[$index]['image']);
                }
                // Upload new image
                $newItems[$index]['image'] = $item['image']->store('choose_us', 'public');
            } else {
                // Keep old image
                $newItems[$index]['image'] = $existingItems[$index]['image'] ?? null;
            }
        }

        // Handle banner image separately
        if ($request->hasFile('banner_image')) {
            $previousBanner = $existing['banner_image'] ?? null;

            // Delete previous banner if exists
            if ($previousBanner && Storage::disk('public')->exists($previousBanner)) {
                Storage::disk('public')->delete($previousBanner);
            }

            // Store new banner
            $bannerImage = $request->file('banner_image')->store('choose_us', 'public');
        } else {
            $bannerImage = $existing['banner_image'] ?? null;
        }

        // Prepare save data
        $saveData = $request->except(['_token', '_key']);
        $saveData['items'] = $newItems;
        $saveData['banner_image'] = $bannerImage;

        $this->settingService->updateSettingUnique($key, $saveData, $request);

        return response()->json([
            'success' => true,
            'message' => 'Choose us settings updated successfully!'
        ]);
    }

    private function updateCoreFeatures(UpdateCoreFeaturesRequest $request)
    {
        $validatedData = $request->validated();
        $this->settingService->updateSettingUnique('core_features', $validatedData, $request);
        return response()->json([
            'success' => true,
            'message' => 'Core Features settings updated successfully!'
        ]);
    }

    private function updateOffer(UpdateOfferRequest $request)
    {
        $key = $request->input('_key');
        $existing = $this->settingService->getSetting($key, []);
        $existingItems = $existing['items'] ?? [];
        $newItems = $request->validated()['items'] ?? [];

        // Handle removed items
        $removedItems = array_diff_key($existingItems, $newItems);
        foreach ($removedItems as $item) {
            if (!empty($item['image']) && Storage::disk('public')->exists($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
        }

        // Handle new/updated items
        foreach ($newItems as $index => $item) {
            if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                if (isset($existingItems[$index]['image']) && Storage::disk('public')->exists($existingItems[$index]['image'])) {
                    Storage::disk('public')->delete($existingItems[$index]['image']);
                }
                $item['image'] = $item['image']->store('offers', 'public');
            } else {
                if (isset($existingItems[$index]['image'])) {
                    $item['image'] = $existingItems[$index]['image'];
                }
            }
        }


        $offerData = $request->except(['_token', '_key']);
        $offerData['items'] = $newItems;
        $this->settingService->updateSettingUnique('offer', $offerData, $request);

        return response()->json([
            'success' => true,
            'message' => 'Offer settings updated successfully!'
        ]);
    }

    private function updateFooterColumn1(UpdateFooterColumn1Request $request)
    {
        $offerData = $request->except(['_token', '_key']);
        $this->settingService->updateSettingUnique('footer_column1', $offerData, $request);
        return response()->json([
            'success' => true,
            'message' => 'Footer column-1 updated successfully!'
        ]);
    }
    private function updateFooterColumn2(UpdateFooterColumn2Request $request)
    {
        $validatedData = $request->validated();
        $this->settingService->updateSettingUnique('footer_column2', $validatedData, $request);
        return response()->json([
            'success' => true,
            'message' => 'Footer column-2 settings updated successfully!'
        ]);
    }
    private function updateFooterColumn3(UpdateFooterColumn3Request $request)
    {
        $validatedData = $request->validated();
        $this->settingService->updateSettingUnique('footer_column3', $validatedData, $request);
        return response()->json([
            'success' => true,
            'message' => 'Footer column-3 settings updated successfully!'
        ]);
    }
    private function updateFooterColumn4(UpdateFooterColumn4Request $request)
    {
        $validatedData = $request->validated();
        $this->settingService->updateSettingUnique('footer_column4', $validatedData, $request);
        return response()->json([
            'success' => true,
            'message' => 'Footer column-4 settings updated successfully!'
        ]);
    }

    private function updateFooterSocial(UpdateFooterSocialRequest $request)
    {
        $this->settingService->updateSettingUnique('footer_social', $request->all(), $request);
        return response()->json([
            'success' => true,
            'message' => 'Footer Social settings updated successfully!'
        ]);
    }

    public function loginSettings()
    {
        $settings = $this->settingService->getAllSettings();
        return view('setting::system-settings.auth.index', compact('settings'));
    }

    public function updateloginSettings(UpdateLoginSettingsRequest $request)
    {
        $data = $request->except(['_token']);

        if ($request->hasFile('auth_page_image')) {
            // Get current stored image for this user
            $settings = $this->settingService->allSettings();
            $previousImage = $settings['auth_page_image'] ?? null;

            // Delete previous image if exists
            if ($previousImage && Storage::disk('public')->exists($previousImage)) {
                Storage::disk('public')->delete($previousImage);
            }

            // Store new image
            $data['auth_page_image'] = $request->file('auth_page_image')->store('auth', 'public');
        }

        $points = [];
        if ($request->has('CoreFeatureTitle')) {
            foreach ($request->CoreFeatureTitle as $key => $title) {
                $points[] = [
                    'title' => $title,
                    'subtitle' => $request->CoreFeatureSubTitle[$key] ?? ''
                ];
            }
        }
        $data['auth_page_points'] = $points;

        // Remove the individual core feature fields
        unset($data['CoreFeatureTitle'], $data['CoreFeatureSubTitle']);

        $this->settingService->updateSettings($data);

        return response()->json([
            'success' => true,
            'message' => 'Auth settings updated successfully!'
        ]);
    }
}
