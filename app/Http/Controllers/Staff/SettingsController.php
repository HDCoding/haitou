<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\Settings\AnalyticsRequest;
use App\Http\Requests\Staff\Settings\FaviconImageRequest;
use App\Http\Requests\Staff\Settings\ImagesRequest;
use App\Http\Requests\Staff\Settings\IndexImageRequest;
use App\Http\Requests\Staff\Settings\LoginImageRequest;
use App\Http\Requests\Staff\Settings\MailRequest;
use App\Http\Requests\Staff\Settings\OthersRequest;
use App\Http\Requests\Staff\Settings\PointsRequest;
use App\Http\Requests\Staff\Settings\PolicyRequest;
use App\Http\Requests\Staff\Settings\SeoRequest;
use App\Http\Requests\Staff\Settings\SocialRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function save(array $data)
    {
        foreach ($data as $key => $val) {
            Setting::add($key, $val);
        }

        toastr()->info('Configuração atualizada.', 'Sucesso');
    }

    public function images()
    {
        return view('staff.settings.images');
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

    public function imageIndex(IndexImageRequest $request)
    {
        if ($request->hasFile('index') && $request->file('index')->isValid()) {
            File::delete('images/index-site.png');

            // Faz o upload
            $upload = $request->file('index');

            $imageMake = Image::make($upload);
            $imageMake->save('images/index-site.png');
            // Se tiver funcionado o arquivo foi armazenado em public/images/index.extensao

            sleep(5);
            return redirect()->route('setting.images');
        } else {
            return redirect()->route('setting.images')
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.');
        }
    }

    public function imageLogin(LoginImageRequest $request)
    {
        if ($request->hasFile('login') && $request->file('login')->isValid()) {
            File::delete('images/login-register.jpg');

            // Faz o upload
            $upload = $request->file('login');

            $imageMake = Image::make($upload);

            $imageMake->save('images/login-register.jpg');
            // Se tiver funcionado o arquivo foi armazenado em public/images/login-register.jpg

            sleep(5);
            return redirect()->route('setting.images');
        } else {
            toastr()->error('Erro', 'Erro no arquivo de imagem, check o arquivo e tente novamente.');;
            return redirect()->route('setting.images');
        }
    }

    public function imageFavicon(FaviconImageRequest $request)
    {
        //TODO
    }

}
