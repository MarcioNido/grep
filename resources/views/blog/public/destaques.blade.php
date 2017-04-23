<?php
$posts = \App\Blog\Post::getDestaques();
?>
<div class="container">
    <div class="row">

        <div class="col-lg-12">

            <h2 style="color: #FFFFFF;">Blog Leardi</h2>
            <p style="color: #FAFAFA;">Fique por dentro das novidades do mercado imobiliario e de franquias. Oportunidades, dicas, informacao.</p>

        </div>

    </div>

    <div class="row">

        @foreach($posts as $post)
        <div class="col-md-4">

            <div class="thumbnail">
                <a href="/blogleardi/{{$post->key}}">
                    @if ($post->imagem != null)
                        <img class="img-responsive" style="width: 100%" src="/wp-content/uploads/{{ $post->imagem->arquivo }}" />
                    @endif
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

</div>
