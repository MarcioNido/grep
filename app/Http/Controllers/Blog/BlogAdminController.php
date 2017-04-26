<?php

namespace App\Http\Controllers\Blog;
use App\Blog\Imagem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog\Post;
use Intervention\Image\Facades\Image;


class BlogAdminController extends Controller
{

    public function index(Request $request) {
        $posts = Post::orderBy('id', 'desc')->paginate(20);
        return view('blog.private.index', ['posts' => $posts]);
    }

    public function inclui(Request $request)
    {
        $model = new Post();
        if ($request->isMethod('post')) {
            $model->key = $this->toUrl($request->titulo);
            $model->titulo = $request->titulo;
            $model->texto = $request->texto;
            $model->ativo = $request->ativo;
            $model->saveOrFail();

            if ($request->hasFile('imagem')) {
                $image = Image::make($request->file('imagem')->path());
                $image->orientate();
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save('wp-content/uploads/grep/'.$model->id.'.'.$request->file('imagem')->extension());
                $modelImagem = new Imagem();
                $modelImagem->post_id = $model->id;
                $modelImagem->arquivo = 'grep/'.$model->id.'.'.$request->file('imagem')->extension();
                $modelImagem->saveOrFail();
            }
            return redirect('/blogadmin');

        }
        return view('blog.private.edita', ['model' => $model]);
    }

    public function edita(Request $request)
    {
        $model = Post::find($request->id);
        if ($model == null) {
            abort(404);
        }
        if ($request->isMethod('post')) {
            $model->key = $this->toUrl($request->titulo);
            $model->titulo = $request->titulo;
            $model->texto = $request->texto;
            $model->ativo = $request->ativo;
            $model->saveOrFail();
            if ($request->hasFile('imagem')) {
                $image = Image::make($request->file('imagem')->path());
                $image->orientate();
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save('wp-content/uploads/grep/'.$model->id.'.'.$request->file('imagem')->extension());
                $modelImagem = Imagem::where('post_id', $model->id)->first();
                if (! $modelImagem) {
                    $modelImagem = new Imagem();
                }
                $modelImagem->post_id = $model->id;
                $modelImagem->arquivo = 'grep/'.$model->id.'.'.$request->file('imagem')->extension();
                $modelImagem->saveOrFail();
            }
            return redirect('/blogadmin');
        }
        return view('blog.private.edita', ['model' => $model]);
    }

    public function toUrl($termo) {
        // the ugly way !!! is the best ... iconv didn´t work at all !!!
        $termo = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$termo);
        //$termo = strtr($termo,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        $termo = str_replace("?", "", $termo);
        $termo = str_replace(":", "", $termo);
        $termo = str_replace("!", "", $termo);
        $termo = str_replace("'", "", $termo);
        $termo = trim($termo);
        $termo = str_replace(" ", "-", $termo);
        $termo = strtolower($termo);
        return $termo;
    }
}
