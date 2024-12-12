<?php

namespace App\Http\Controllers\Admin;

use Nnjeim\World\World;
use Illuminate\Http\Request;
use App\Settings\EmailSettings;
use App\Settings\SalarySetting;
use App\Settings\ThemeSettings;
use App\Settings\CompanySettings;
use App\Settings\InvoiceSettings;
use App\Http\Controllers\Controller;
use App\Settings\LocalizationSettings;
use LaravelLang\Locales\Facades\Locales;
use LaravelLang\Routes\Events\LocaleHasBeenSetEvent;

class SettingsController extends Controller
{

    public function index(CompanySettings $settings)
    {
        $pageTitle = __('General Settings');
        return view('pages.settings.company', compact(
            'pageTitle',
            'settings'
        ));
    }

    public function updateCompany(Request $request, CompanySettings $settings)
    {

        $settings->name = $request->name ?? $settings->name;
        $settings->contact_person = $request->contact_person ?? $settings->contact_person;
        $settings->address = $request->address ?? $settings->address;
        $settings->country = $request->country  ?? $settings->countryy;
        $settings->city = $request->city ?? $settings->city;
        $settings->province = $request->province ?? $settings->province;
        $settings->postal_code = $request->postal_code ?? $settings->postal_code;
        $settings->email = $request->email ?? $settings->email;
        $settings->phone = $request->phone  ?? $settings->phone;
        $settings->mobile = $request->mobile ?? $settings->mobile;
        $settings->fax = $request->fax ?? $settings->fax;
        $settings->website_url = $request->website_url ?? $settings->website_url;
        $settings->save();
        $notification = notify(__("Company Settings has been updated"));
        return redirect()->route('settings.index')->with($notification);
    }

    public function locale(LocalizationSettings $settings)
    {
        $pageTitle = 'Localization';
        $country = World::countries([
            'fields' => "iso2",
            'filters' => [
                'iso2' => $settings->country
            ]
        ])->data->first();
        $language = World::languages(['filters' => [
            'code' => $settings->lang
        ]])->data->first();
        return view('pages.settings.locale', compact(
            'pageTitle',
            'settings',
            'country',
            'language'
        ));
    }

    public function updateLocale(Request $request, LocalizationSettings $settings)
    {
        $settings->country = $request->country ?? $settings->country;
        $settings->date_format = $request->date_format ?? $settings->date_format;
        $settings->timezone = $request->timezone ?? $settings->timezone;
        $settings->lang = $request->lang ?? $settings->lang;
        $settings->currency_symbol = $request->currency_symbol ?? $settings->currency_symbol;
        $settings->currency_code = $request->currency_code ?? $settings->currency_code;

        $isInstalled = Locales::isInstalled($settings->lang);
        if ($isInstalled) {
            $locale = Locales::get($settings->lang);
            LocaleHasBeenSetEvent::dispatch($locale);
        }
        $settings->save();
        $notification = notify(__("Locale Settings has been updated"));
        return redirect()->route('settings.locale')->with($notification);
    }


    public function theme(ThemeSettings $settings)
    {
        $pageTitle = 'Theme Settings';
        return view('pages.settings.theme', compact(
            'pageTitle',
            'settings'
        ));
    }

    public function updateTheme(Request $request, ThemeSettings $settings)
    {
        $side_img = $settings->sidebar_img;
        $logo_light = $settings->logo_light;
        $logo_dark = $settings->logo_dark;
        $favicon = $settings->favicon;
        if ($request->hasFile('side_img')) {
            $side_img = random_str(8) . '.' . $request->side_img->extension();
            $request->side_img->move(public_path('storage/settings/theme'), $side_img);
        }
        if ($request->hasFile('logo_light')) {
            $logo_light = random_str(5) . '_light.' . $request->logo_light->extension();
            $request->logo_light->move(public_path('storage/settings/theme'), $logo_light);
        }
        if ($request->hasFile('logo_dark')) {
            $logo_dark = random_str(5) . '_dark.' . $request->logo_dark->extension();
            $request->logo_dark->move(public_path('storage/settings/theme'), $logo_dark);
        }
        if ($request->hasFile('favicon')) {
            $favicon = random_str(5) . '_favicon.' . $request->favicon->extension();
            $request->favicon->move(public_path('storage/settings/theme'), $favicon);
        }
        $settings->name = $request->name ?? $settings->name;
        $settings->logo_light = $logo_light;
        $settings->logo_dark = $logo_dark;
        $settings->favicon = $favicon;
        $settings->theme = $request->theme ?? $settings->theme;
        $settings->layout = $request->layout ?? $settings->layout;
        $settings->color_scheme = $request->color_scheme ?? $settings->color_scheme;
        $settings->layout_width = $request->layout_width ?? $settings->layout_width;
        $settings->layout_position = $request->layout_pos ?? $settings->layout_position;
        $settings->topbar_color = $request->topbar_color ?? $settings->topbar_color;
        $settings->sidebar_size = $request->sidebar_size ?? $settings->sidebar_size;
        $settings->sidebar_view = $request->sidebar_view ?? $settings->sidebar_view;
        $settings->sidebar_img = $side_img;
        $settings->sidebar_color  = $request->sidebar_color ?? $settings->sidebar_color;
        $settings->save();
        $notification = notify(__("Theme Settings has been updated"));
        return redirect()->route('settings.theme')->with($notification);
    }


    public function invoice(InvoiceSettings $settings){
        $pageTitle = __("Invoice Settings");
        return view('pages.settings.invoice',compact(
            'settings','pageTitle'
        ));
    }

    public function updateInvoice(Request $request, InvoiceSettings $settings){

        $request->validate([
            'prefix' => 'required',
            'logo' => 'nullable|file|image',
        ]);

        $imageName = $settings->logo;
        if ($request->hasFile('logo')) {
            $imageName = random_str(8) . '.' . $request->logo->extension();
            $request->logo->move(public_path('storage/settings/invoice'), $imageName);
        }
        $settings->prefix = $request->prefix ?? $settings->prefix;
        $settings->logo = $imageName;
        $settings->save();
        $notification = notify(__('Invoice settings has been updated'));
        return back()->with($notification);
    }


    public function email(EmailSettings $settings){
        $pageTitle = __('Email Settings');
        return view('pages.settings.email',compact(
            'settings','pageTitle'
        ));
    }


    public function updateEmail(Request $request, EmailSettings $settings){
        $request->validate([
            'from_address' => 'required|email',
            'port' => 'required|numeric',
            'host' => 'required'
        ]);

        $settings->mailer = $request->mailer ?? $settings->mailer;
        $settings->from_address = $request->from_address ?? $settings->from_address;
        $settings->from_name = $request->from_name ?? $settings->from_name;
        $settings->host = $request->host ?? $settings->host;
        $settings->port = $request->port ?? $settings->port;
        $settings->enc = $request->enc ?? $settings->enc;
        $settings->domain = $request->domain ?? $settings->domain;
        $settings->user = $request->username ?? $settings->user;
        $settings->password = $request->password ?? $settings->password;
        $notification = notify(__("Mail Client settings has been updated"));
        return back()->with($notification);
    }

    
    public function salary(SalarySetting $settings){
        $pageTitle = __('Salary Settings');
        return view('pages.settings.salary',compact(
            'settings','pageTitle'
        ));
    }

    public function updateSalarySettings(Request $request, SalarySetting $settings)
    {
        $request->validate([
            'enable_pf' => 'nullable|string',
            'enable_esi' => 'nullable|string',
            'emp_esi' => 'nullable|numeric',
            'da_percent' => 'nullable|numeric',
            'hra_percent' => 'nullable|numeric',
            'emp_pf' => 'nullable|numeric',
            'company_pf' => 'nullable|numeric',
            'company_esi' => 'nullable|numeric',
        ]);

        $settings->enable_da_hra = !empty($request->enable_da_hra) ?? $settings->enable_da_hra;
        $settings->enable_provident_fund = !empty($request->enable_pf) ?? $settings->enable_provident_fund;
        $settings->enable_esi_fund = !empty($request->enable_esi) ?? $settings->enable_esi_fund;
        $settings->da_percent = $request->da_percent ?? $settings->da_percent;
        $settings->hra_percent = $request->hra_percent ?? $settings->hra_percent;
        $settings->emp_pf_percent = $request->emp_pf ?? $request->emp_pf_percent;
        $settings->company_pf_percentage = $request->company_pf ?? $settings->company_pf_percentage;
        $settings->emp_esi_percentage = $request->emp_esi ?? $settings->emp_esi_percentage;
        $settings->company_esi_percentage = $request->company_esi ?? $settings->company_esi_percentage;
        $settings->save();
        $notification = notify(__('Salary settings has been updated'));
        return back()->with($notification);
    }
    
}
