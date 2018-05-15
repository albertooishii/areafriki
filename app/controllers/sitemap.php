<?php
    set_time_limit(30 * 60);
    class Sitemapgen extends Controller{

        function index_sitemapgen(){
            include_once DIR.'/vendor/sitemap-php/Sitemap.php';
            $sitemap = new Sitemap(PAGE_DOMAIN);
            $this->loadModel("producto");
            $p = New Producto_Model();
            $this->loadModel("tag");
            $t = New Tag_Model();
            $this->loadModel("categoria");
            $cat = New Categoria_Model();
            $this->loadModel("design");
            $dg = New Design_Model();
            $creador = New Users_Model();
            
            $sitemap->setPath(DIR.'/sitemaps/'); 
            
            //Páginas estáticas
            $sitemap->addItem('/', '1.0', 'hourly', 'Today');
            $sitemap->addItem('/upload', '.05', 'weekly', 'Today');
            $sitemap->addItem('/info/registro_designer', '0.5', 'weekly', 'Today');
            $sitemap->addItem('/info/registro_crafter', '0.5', 'weekly', 'Today');
            $sitemap->addItem('/info/registro_baul', '0.5', 'weekly', 'Today');
            
            //Listado de categorías
            $categorias=$cat->getCategorias();
            foreach ($categorias as $categoria) {
                $sitemap->addItem('/' . $categoria['nombre'], '0.9', 'hourly', 'Today');
            }
            
            //Listado de etiquetas
            $tags=$t->getPopularTags();
            foreach ($tags as $tag) {
                $sitemap->addItem('/tag/' . $tag["tag"], '0.6', 'hourly', 'Today');
            }
            
            //Listado de productos
            $productos=$p->getProductos(false, true);
            foreach ($productos as $producto) {
                $cat->id=$producto["categoria"];
                $sitemap->addItem('/'. $cat->get()["nombre"] . '/' .  $producto["design"], '0.7', 'daily', 'Today');
            }
            
            //Listado de usuarios
            $usuarios=$creador->getUsers();
            foreach ($usuarios as $usuario) {
                $sitemap->addItem('/user/' . $creador->user2URL($usuario["user"]), '0.8', 'daily', 'Today');
            }
            
            $sitemap->createSitemapIndex(PAGE_DOMAIN.'/sitemaps/', 'Today');
            $this->pingSitemap();
        }
        
        function pingSitemap(){
            //Set this to be your site map URL
            $sitemapUrl = PAGE_DOMAIN."/sitemaps/sitemap-index.xml";

            // cUrl handler to ping the Sitemap submission URLs for Search Engines…
            function myCurl($url){
              $ch = curl_init($url);
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_exec($ch);
              $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
              curl_close($ch);
              return $httpCode;
            } 

            //Google
            $url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=".$sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>Google Sitemaps has been pinged (return code: $returnCode).</p>";

            //Bing / MSN
            $url = "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>Bing / MSN Sitemaps has been pinged (return code: $returnCode).</p>";

            //ASK
            $url = "http://submissions.ask.com/ping?sitemap=".$sitemapUrl;
            $returnCode = myCurl($url);
            echo "<p>ASK.com Sitemaps has been pinged (return code: $returnCode).</p>";
        }
        
    }
?>