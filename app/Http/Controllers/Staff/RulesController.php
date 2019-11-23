<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\RulesRequest;
use App\Models\Rule;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function index()
    {
        $rules = Rule::all();
        return view('staff.rules.index', compact('rules'));
    }

    public function create()
    {
        return view('staff.rules.add');
    }

    public function store(RulesRequest $request)
    {
        $rule = new Rule($request->except('_token'));
        $rule->save();
        toastr()->success('Nova regra cadastrada.', 'Sucesso');
        return redirect()->route('rules.index');
    }

    public function edit($rule_id)
    {
        $rule = Rule::findOrFail($rule_id);
        return view('staff.rules.edit', compact('rule'));
    }

    public function update(RulesRequest $request, $rule_id)
    {
        Rule::findOrFail($rule_id)->update($request->except('_token'));
        toastr()->info('Regra atualizada.', 'Sucesso');
        return redirect()->route('rules.index');
    }

    public function destroy($rule_id)
    {
        Rule::findOrFail($rule_id)->delete();
        toastr()->warning('Regra deletada.', 'Aviso');
        return redirect()->route('rules.index');
    }
}
