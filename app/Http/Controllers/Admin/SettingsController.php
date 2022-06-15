<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Settings\ThemeSettings;
use App\Settings\CompanySettings;
use App\Settings\InvoiceSettings;
use App\Http\Controllers\Controller;
use App\Settings\AttendanceSettings;

class SettingsController extends Controller
{
    
    public function index(ThemeSettings $settings){
        $title = 'theme settings';
        return view('backend.settings.theme',compact(
            'title','settings'
        ));
    }    

    public function updateTheme(Request $request,ThemeSettings $settings){
        $this->validate($request,[
            'site_name' => 'required',
            'logo' => 'nullable|file|image',
            'favicon' => 'nullable|file|image',
            'currency_symbol' => 'nullable|min:1|max:10',
            'currency_code' => 'nullable|min:1|max:10'
        ]);
        $logo = '';
        if($request->hasFile('logo')){
            $logo = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('storage/settings/theme'), $logo);
        }
        $favicon = '';
        if($request->hasFile('favicon')){
            $favicon = time().'.'.$request->favicon->extension();
            $request->favicon->move(public_path('storage/settings/theme'), $favicon);
        }
        $settings->site_name = $request->site_name;
        $settings->logo = $logo;
        $settings->favicon = $favicon;
        $settings->currency_code = $request->currency_code;
        $settings->currency_symbol = $request->currency_symbol;
        $settings->save();
        $notification = notify('theme has been updated');
        return back()->with($notification);
    }

    public function invoice(InvoiceSettings $settings){
        $title = 'invoice settings';
        return view('backend.settings.invoice', compact(
            'title','settings'
        ));
    }

    public function updateInvoice(Request $request, InvoiceSettings $settings){
        $this->validate($request,[
            'prefix' => 'nullable',
            'logo' => 'nullable|file|image'
        ]);
        $logo = $request->logo;
        if($request->hasFile('logo')){
            $logo = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('storage/settings/invoice'), $logo);
        }
        $settings->prefix = $request->prefix;
        $settings->logo = $logo;
        $settings->save();
        $notification = notify('invoice settings updated');
        return back()->with($notification);
    }

    public function attendance(AttendanceSettings $settings){
        $title = 'attendance settings';
        return view('backend.settings.attendance',compact(
            'title','settings'
        ));
    }

    public function updateAttendance(Request $request, AttendanceSettings $settings){
        $this->validate($request,[
            'checkin' => 'required',
            'checkout' => 'required'
        ]);
        $settings->checkin_time = $request->checkin;
        $settings->checkout_time = $request->checkout;
        $settings->save();
        $notification = notify('attendance settings updated');
        return back()->with($notification);
    }

    public function company(CompanySettings $settings){
        $title = 'company settings';
        return view('backend.settings.company',compact(
            'title','settings'
        ));
    }

    public function updateCompany(Request $request, CompanySettings $settings){
        $this->validate($request,[
            'company_name' => 'required',
            'contact_person' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'fax' => 'required',
            'website_url' => 'required|url'
        ]);

        $settings->company_name = $request->company_name;
        $settings->contact_person = $request->contact_person;
        $settings->address = $request->address;
        $settings->country = $request->country;
        $settings->city = $request->city;
        $settings->province = $request->province;
        $settings->postal_code = $request->postal_code;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->mobile = $request->mobile;
        $settings->fax = $request->fax;
        $settings->website_url = $request->website_url;
        $settings->save();
        $notification = notify('company settings has been updated');
        return back()->with($notification);
    }
   
}

