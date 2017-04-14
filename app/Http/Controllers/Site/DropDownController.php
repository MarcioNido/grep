<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Collective\Html\FormFacade;
use App\DropDownTool;
use Illuminate\Http\Request;

class DropDownController extends Controller
{
    public function cidade(Request $request)
    {
        return FormFacade::activeDropDownList('', 'codcidade', 0, DropDownTool::getCidade($request->estado, 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%;', 'id' => 'codcidade', 'placeholder' => 'Cidade', 'onchange' => 'trigger_codcidade()']);
    }

    public function bairro(Request $request)
    {
        return FormFacade::activeDropDownList('', 'codbairro[]', 0, DropDownTool::getBairro($request->codcidade, 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%;', 'id' => 'codbairro', 'placeholder' => 'Todas as Regiões']);
    }

}