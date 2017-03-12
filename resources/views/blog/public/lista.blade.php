<?php
use App\Http\Components\CHtml;
$title = "Agências Paulo Roberto Leardi";
if (! isset($tag)) {
    $tag = '';
}
if (! isset($term)) {
    $term = '';
}
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div style="background-color: #345C8C; width: 100%">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Blog</li>
            </ol>
        </div>
    </div>

    <div style="background-color: #6B88AE; width: 100%">
        <div class="container">
            <div class="row" style="padding: 20px 0;">
                <div class="col-sm-9">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default {{ $tag=='' ? 'active' : '' }}" onclick="tag('');">Geral</button>
                        <button type="button" class="btn btn-default {{ $tag=='Franquias' ? 'active' : '' }}" onclick="tag('');">Franquias</button>
                        <button type="button" class="btn btn-default {{ $tag=='Imobiliáris' ? 'active' : '' }}" onclick="tag('');">Imobili&aacute;rias</button>
                        <button type="button" class="btn btn-default {{ $tag=='Corretores' ? 'active' : '' }}" onclick="tag('');">Corretores</button>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form method="get" class="form-inline" id="formblog">
                        <div class="form-group">
                            <div class='input-group'>
                                <input type="hidden" id="tag" name="tag" value="{{ $tag }}">
                                <input name="term" type="text" class="form-control" placeholder="Procurar" value="{{ $term }}" />
                                <div class="input-group-btn"><button class='btn btn-primary'><span class="fa fa-search"></span></button></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color: #E1ECF8; width: 100%; padding-top: 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-9">

                    <div class="row">
                        <?php $i=0; ?>
                        @foreach ($posts as $post)
                            <?php
                                if ($i++ >= 3) {
                                    $i=1;
                                    echo '</div>';
                                    echo '<div class="row">';
                                }
                                if ($post->imagem) {
                                    $arquivo = $post->imagem->arquivo;
                                } else {
                                    $arquivo = "";
                                }

                            ?>
                            <div class="col-sm-4">
                                <div class="thumbnail">
                                    <a href="/blogleardi/{{$post->key}}">
                                        <img class="img-responsive" style="width: 100%" src="/wp-content/uploads/{{ $arquivo }}" />
                                    </a>
                                    <div class="caption">
                                        <h3><a href="/blogleardi/{{$post->key}}">{{ $post->titulo }}</a></h3>
                                        <p>{{ substr(strip_tags($post->texto), 0, 200) }}</p>
                                        <p style='text-align: right;'><a href="/blogleardi/{{$post->key}}">Continuar lendo</a></p>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    <div class="row">
                        <div class="col-sm-12" style="text-align: right;">
                            {{ $posts->links() }}
                        </div>
                    </div>


                </div>


                <div class='col-lg-3'>

                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <a href="/area-restrita/ebook">
                                <img class='img-responsive' src='/images/Layout_Facebook.png' />
                            </a>
                        </div>
                    </div>

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title">Receba Novidades</h3>
                        </div>

                        <form class="form-group">


                            <div class="panel-body">

                                <p>Cadastre-se e receba as novidades do mercado imobili&aacute;rio em seu email.</p>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/area-restrita/dados-pessoais" class="btn btn-warning" style="font-weight: 300; width: 100%;"><span class="fa fa-mail-forward"></span> QUERO RECEBER!</a>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <a href="/area-restrita/ebook-corretor">
                                <img class='img-responsive' src='/images/Capa_Ebook-logo1.png' />
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script language="javascript">
    function tag(tagname)
    {
        $('#tag').value=tagname;
        $('#formblog').submit();
    }
</script>
@endpush