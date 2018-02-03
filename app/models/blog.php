<?php
    require_once 'app/helpers/database.php';

    define('WP_USE_THEMES', false);
    include_once BLOG_PATH.'/wp-load.php';

    class Blog_Model extends Database{

        var $posts, $podcasts;

        function __construct(){
           parent::__construct();
        }

        function getPosts()
        {
            $this->posts = [];
            $args = array (
                'numberposts' => 6
            );
            foreach (get_posts($args) as $key => $post) {
                //print_r($post);
                $this->posts[$key] = array (
                    'id' => $post->ID,
                    'date' => $post->post_date,
                    'title' => $post->post_title,
                    //'content' => $post->post_content,
                    'description' => $this->getDescription($post->post_content),
                    'image' => $this->getImage($post->ID),
                    'url' => $post->guid,
                    'category_name' => $this->getCategoryName($post->ID),
                    'category_slug' => $this->getCategorySlug($post->ID),
                    'author_id' => $post->post_author,
                    'author_user' => $this->getAuthorName($post->post_author),
                );
            }
        }

        function registerWPUser($username, $password, $email) {
            $user_id = $this->checkWPUser($username);
            if ( !$user_id AND email_exists($email) == false ) {
                $user_id = wp_create_user( $username, $password, $email );
            }
            return $user_id;
        }

        function checkWPUser($username) {
            return username_exists($username);
        }

        function loginWPUser ($user_login, $password, $remember) {
            $creds = array(
                'user_login'    => $user_login,
                'user_password' => $password,
                'remember'      => $remember,
            );
            return wp_signon ($creds);
        }

        function logoutWPUser() {
            wp_logout();
        }

        function recoverPassword($password, $user_id) {
            wp_set_password( $password, $user_id );
        }

        function getImage($id) {
            add_image_size( 'areafriki', 360, 240, true );
            return get_the_post_thumbnail_url($id, 'areafriki');
        }

        function getDescription($content) {
            return substr(trim(strip_tags($content)), 0, 200).'...'; 
        }

        function getAuthorName($author) {
            return get_userdata($author)->user_login;
        }

        function getCategoryName($id) {
            return get_the_category($id)[0]->name;
        }

        function getCategorySlug($id) {
            return get_the_category($id)[0]->slug;
        }
    }
?>
