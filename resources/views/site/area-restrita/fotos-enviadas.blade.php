<?php
/* @var $this yii\web\View */
use App\Http\Components\CHtml as CHtml;
use App\Site\Localidade;
$title = "Fotos do Imóvel";
$breadcrumbs = [
    'Home' => url('/'),
    'Área Restrita' => url('/area-restrita/index'),
    'Fotos do Imóvel'=> '',
];
?>
@extends('layouts.app')

@section('title', $title)

@section('content')

<div style="width: 100%; background-color: #E1ECF8;">
    <div class="container" style="padding-top: 40px; padding-bottom: 80px;">

        <div class="row">

            <div class="col-lg-10 col-lg-offset-1">

                <div class="panel panel-primary">

                    <div class="panel-heading">Fotos do Imóvel</div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h5>As imagens foram carregadas e serão atualizadas em breve em seu imóvel</h5>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12" style="text-align: right;">
                                {{ link_to('/area-restrita/index', 'Retornar à Área Restrita', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script language="javascript">
    Dropzone.options.dropzoneUpload = {
        init: function() {
            this.on("queuecomplete", function() {
                window.location.href = "/area-restrita/"
            })
        }
    }
</script>
@endpush