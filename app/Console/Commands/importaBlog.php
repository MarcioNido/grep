<?php

namespace App\Console\Commands;

use App\Blog\Imagem;
use App\Blog\Post;
use Illuminate\Console\Command;
use App\Site\Imovel;
use App\Site\ImovelCaracteristica;
use Illuminate\Support\Facades\DB;

class importaBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guru:importaBlog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa dados do blog da Leardi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        DB::table('blog_post_imagem')->truncate();
        DB::table('blog_post')->truncate();

        $wposts = DB::table('blogleardi.wp_posts')->where(['post_type' => 'post', 'post_status' => 'publish'])->get();
        foreach($wposts as $wpost) {

            echo  $wpost->ID." - ".$wpost->post_title."\n";
            $post = new Post();
            $post->key = $wpost->post_name;
            $post->titulo = $wpost->post_title;
            $post->texto = $wpost->post_content;
            $post->ativo = 1;
            $post->saveOrFail();

            $wpostImage = DB::table('blogleardi.wp_postmeta')->where(['post_id' => $wpost->ID, 'meta_key' => '_wp_attachment_metadata'])->first();
            if ($wpostImage) {

                $meta_value = null;
                var_dump($wpostImage);

                if (strlen($wpostImage->meta_value) > 10) {
                    $meta_value = unserialize($wpostImage->meta_value);
                    var_dump($meta_value);
                } else {
                    echo $wpostImage->meta_value."\n";
                    continue;
                }

                if (isset($meta_value['sizes'])) {
                    $arquivo = $meta_value['sizes']['big-1col']['file'];
                    $postImage = new Imagem();
                    $postImage->post_id = $post->id;
                    $postImage->arquivo = $arquivo;
                    $postImage->saveOrFail();
                }


            }

            var_dump($wpostImage);

        }

    }

//    public function toUrl($termo) {
//
//        echo "before:".$termo."\n";
//        //$termo = mb_convert_encoding($termo, 'UTF-8');
//
//        // the ugly way !!! is the best ... iconv didn´t work at all !!!
//        $termo = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$termo);
//        //$termo = strtr($termo,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
//        $termo = str_replace(" ", "-", $termo);
//        $termo = str_replace("'", "", $termo);
//        $termo = strtolower($termo);
//        echo "after:".$termo."\n";
//        return $termo;
//    }
//

}
