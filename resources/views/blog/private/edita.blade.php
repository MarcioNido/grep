@extends('layouts.app')

@section('title', 'Blog Admin')

@push('header')
<link rel="stylesheet" href="/vendor/summernote/summernote.css" />
@endpush

@section('content')

<div class="container">
    <form method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-9">
                {{ Form::activeText('Título', 'titulo', $model->titulo) }}
            </div>
            <div class="col-md-3">
                {{ Form::activeDropDownList('Status', 'ativo', $model->ativo, \App\DropDownTool::getSimNaoBoolean(), ['class' => 'form-control guru-select']) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ Form::activeTextArea('Texto', 'texto', $model->texto, ['id' => 'summernote']) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ Form::activeFile('Imagem', 'imagem') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="text-align: right;">
                <input type="submit" value="CONFIRMA" class="btn btn-warning">
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="/vendor/summernote/summernote.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height:400,
        });
    });
</script>
@endpush