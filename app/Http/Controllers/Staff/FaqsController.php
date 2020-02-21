<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\FaqsRequest;
use App\Models\Category;
use App\Models\Faq;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:faq-mod');
    }

    public function index()
    {
        $categories = Category::select('id', 'name')->where('is_faq', '=', true)->get();
        $faqs = Faq::select('id', 'category_id', 'is_enable', 'question')->get();
        return view('staff.faqs.index', compact('categories', 'faqs'));
    }

    public function create()
    {
        if (Category::where('is_faq', '=', true)->count() <= 0) {
            toastr()->error('Nenhuma categoria cadastrada, registre uma para continuar', 'Aviso');
            return redirect()->back();
        } else {
            $categories = Category::where('is_faq', '=', true)->pluck('name', 'id');
            return view('staff.faqs.create', compact('categories'));
        }
    }

    public function store(FaqsRequest $request)
    {
        $faq = new Faq($request->except('_token'));
        $faq->save();
        toastr()->success('Nova FAQ cadastrada.', 'Sucesso');
        return redirect()->to('staff/faqs');
    }

    public function edit($faq_id)
    {
        $faq = Faq::findOrFail($faq_id);
        $categories = Category::where('is_faq', '=', true)->pluck('name', 'id');
        return view('staff.faqs.edit', compact('faq', 'categories'));
    }

    public function update(FaqsRequest $request, $faq_id)
    {
        Faq::findOrFail($faq_id)->update($request->except('_token'));
        toastr()->info('FAQ atualizada.', 'Sucesso');
        return redirect()->to('staff/faqs');
    }

    public function destroy($faq_id)
    {
        Faq::findOrFail($faq_id)->delete();
        toastr()->warning('FAQ deletada.', 'Aviso');
        return redirect()->to('staff/faqs');
    }

    public function enableFaq($faq_id)
    {
        $faq = Faq::findOrFail($faq_id);
        $faq->is_enable = true;
        $faq->update();
        toastr()->info('FAQ Ativada.', 'Aviso');
        return redirect()->to('staff/faqs');
    }

    public function disableFaq($faq_id)
    {
        $faq = Faq::findOrFail($faq_id);
        $faq->is_enable = false;
        $faq->update();
        toastr()->info('FAQ Desativada.', 'Aviso');
        return redirect()->to('staff/faqs');
    }
}
