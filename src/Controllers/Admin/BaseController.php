<?php

namespace Owlcoder\CmsShop\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public $baseName;
    public $modelClass;
    public $formClass;

    public function index(Request $request)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::query()->simplePaginate(20);
        return view('cms-shop::admin.shop.' . $this->baseName . '.index', ['model' => $model]);
    }

    public function update(Request $request)
    {
        $model = $this->modelClass::find($request->route('id'));
        $form = new $this->formClass([], $model);

        if ($request->method() == 'POST') {
            if ($form->load($_POST, $request->files->all()) && $form->save()) {
                return redirect(route('cms-shop.' . $this->baseName . '.update', ['id' => $model->id]));
            }
        }

        return view('cms-shop::admin.shop.' . $this->baseName . '.update', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    public function create(Request $request)
    {
        $model = new $this->modelClass();
        $form = new $this->formClass([], $model);

        if ($request->method() == 'POST') {
            if ($form->load($_POST, $request->files->all()) && $form->save()) {
                return redirect(route('cms-shop.' . $this->baseName . '.update', ['id' => $model->id]));
            }
        }

        return view('cms-shop::admin.shop.' . $this->baseName . '.create', [
            'form' => $form,
            'model' => $model
        ]);
    }

    public function delete(Request $request)
    {
        $model = $this->modelClass::find($request->route('id'));
        return redirect(route('cms-shop.admin.' . $this->baseName . '.index'));
    }
}
