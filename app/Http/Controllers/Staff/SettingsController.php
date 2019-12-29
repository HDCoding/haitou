<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Settings\AnalyticsRequest;
use App\Http\Requests\Staff\Settings\FaviconRequest;
use App\Http\Requests\Staff\Settings\ImagesRequest;
use App\Http\Requests\Staff\Settings\MailRequest;
use App\Http\Requests\Staff\Settings\OthersRequest;
use App\Http\Requests\Staff\Settings\PointsRequest;
use App\Http\Requests\Staff\Settings\PolicyRequest;
use App\Http\Requests\Staff\Settings\SeoRequest;
use App\Http\Requests\Staff\Settings\SocialRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:configuracoes-mod');
    }

    public function analytics(AnalyticsRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.analytics');
        }
    }

    public function favicon(FaviconRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');

        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.favicon');
        }
    }

    public function images(ImagesRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');

        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.images');
        }
    }

    public function mail(MailRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.mail');
        }
    }

    public function others(OthersRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.others');
        }
    }

    public function points(PointsRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.points');
        }
    }

    public function policy(PolicyRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.policy');
        }
    }

    public function seo(SeoRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.seo');
        }
    }

    public function social(SocialRequest $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            $this->save($data);
            return redirect()->back();
        }
        if ($request->isMethod('GET')) {
            return view('staff.settings.social');
        }
    }

    public function save(array $data)
    {
        foreach ($data as $key => $val) {
            Setting::add($key, $val);
        }

        toastr()->info('Configuração atualizada.', 'Sucesso');
    }

}
