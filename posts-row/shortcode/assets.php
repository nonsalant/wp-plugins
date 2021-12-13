<?php
// force cache busting based on the time the file was last modified
// $posts_row_force_asset_busting = false;

$posts_row_force_asset_busting = true;
/*  ⚠️  ONLY USE IN DEVELOPMENT  ⚠️  

If set to true, a filemtime() will be performed 
on each page build for each cached asset 
to check if it can still be used. 
It can be vital in development when testing in
multiple browsers and caching is turned on. */

// ? may have problems when using non-default ports (eg: not 8080)
// see: query monitor (top admin bar) -> Scripts -> Host / Other



// Add front end styles+script for: theme/public site
add_action( 'wp_enqueue_scripts', function() {
    $content = get_the_content();

    // include css only if the [posts-row] shortcode is used inside the content
    if ($content && has_shortcode($content,'posts-row')) {
        posts_row_enqueue('style.css', '0.1.2');
    }

    // include nav assets if a shortcode has the "show-arrows" attribute
    // if [posts-row show-arrows]
    if ( posts_row_has_att($content, "posts-row", "show-arrows") ) {
        posts_row_enqueue('nav.css', '0.1.0');
        posts_row_enqueue('script.js', '0.1.0');
    }

    // include some assets on first pages of categories
    if ((is_category() && ! is_paged())) {
        posts_row_enqueue('style.css', '0.1.2');
    }

    if (is_home() || is_front_page()) {
        posts_row_enqueue("aw2g-home.css");
    }
});

// Add backend styles for: Gutenberg/block editor
add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');
function gutenberg_editor_assets()
{
    posts_row_enqueue('style.css');
    posts_row_enqueue('nav.css');
    //
    posts_row_enqueue('script.js', '0.1.0');
}

// use type="module" when loading the script // https://stackoverflow.com/a/59594789
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    //echo ($handle); // some weirdness going on where the handles don't end in "-js" at this filter
    if ('posts-row-script' !== $handle) {

        return $tag;
    }
    $tag = '
        <script type="module" 
            id="' . $handle . '" 
            src="' . esc_url($src) . '">
        </script>';

    return $tag;
}, 10, 3);


function posts_row_enqueue($filename, $ver='0.0.0') {
    $handle = pathinfo($filename, PATHINFO_FILENAME);
    $suffix = pathinfo($filename, PATHINFO_EXTENSION);
    global $posts_row_force_asset_busting;

    include(__DIR__ . '/../config/config.php');
    // $posts_row_template is set here

    if ($posts_row_force_asset_busting) $ver = posts_row_cache_buster(__DIR__.'/../templates/'.$posts_row_template.'/'.$suffix.'/'.$handle.'.'.$suffix);
    
    $template_folder = '../templates/'.$posts_row_template;
    $file__relative_path = $template_folder.'/'.$suffix.'/'.$handle.'.'.$suffix;
    
    if ($suffix == 'css') {
        posts_row_enqueue_style($handle, $file__relative_path, $ver);
        return;
    }
    if ($suffix == 'js') {
        posts_row_enqueue_script($handle, $file__relative_path, $ver);
        return;
    }
    return;
}

function posts_row_enqueue_style($handle, $file__relative_path, $cache_buster) {
    wp_enqueue_style('posts-row-'.$handle , plugins_url($file__relative_path, __FILE__), [], $cache_buster);
}

function posts_row_enqueue_script($handle, $file__relative_path, $cache_buster) {
    wp_enqueue_script('posts-row-'.$handle , plugins_url($file__relative_path, __FILE__), [], $cache_buster, true);
}

function posts_row_has_att($content, $shortcode, $att) {
    $found = false;
    // Enqueue javascript only if "show-arrows" att: [posts-row show-arrows]
    // https://wordpress.stackexchange.com/a/340819
    preg_match_all('/'.get_shortcode_regex().'/', $content, $matches, PREG_SET_ORDER);
    foreach( $matches as $match ) {
        // echo "<pre>"; var_dump($match); echo "</pre>";
        // https://wordpress.stackexchange.com/a/56975
        // https://pastebin.com/rBeTjZRL get atts from shortcode regex
        $regex_pattern = get_shortcode_regex();
        preg_match('/'.$regex_pattern.'/s', $match[0], $regex_matches);
        if ($regex_matches[2] == $shortcode) {
            //  Turn the attributes into a URL parm string
            $attributeStr = str_replace (" ", "&", trim ($regex_matches[3]));
            $attributeStr = str_replace ('"', '', $attributeStr);
            //  Parse the attributes
            $attributes = wp_parse_args ($attributeStr);
            if (isset($attributes[$att])) {
                $found = true;
                break;
            }
        }
    }
    return $found;
}

// get an array with all the values of an attribute of a shortcode, 
// merged with a CSV string of default values
// not used (yet)
function posts_row_get_att_values($content, $shortcode, $att, $csv_default='heading, link_button') {
    $buffer = '';
    $shortcodes = [];
    // https://wordpress.stackexchange.com/a/340819
    preg_match_all('/'.get_shortcode_regex().'/', $content, $matches, PREG_SET_ORDER);
    foreach( $matches as $match ) {
        $shortcodes[] = $match[0];
        // https://wordpress.stackexchange.com/a/56975
        // https://pastebin.com/rBeTjZRL get atts from shortcode regex
        $regex_pattern = get_shortcode_regex();
        preg_match('/'.$regex_pattern.'/s', $match[0], $regex_matches);
        if ($regex_matches[2] == $shortcode) {
            //  Turn the attributes into a URL parm string
            $attributeStr = str_replace (" ", "&", trim ($regex_matches[3]));
            $attributeStr = str_replace ('"', '', $attributeStr);
            //  Parse the attributes
            $defaults = array (
                $att => $csv_default,
            );
            $attributes = wp_parse_args ($attributeStr, $defaults);

            if (isset($attributes[$att])) {
                $buffer.=$attributes[$att].',';
            }
        }
    }
    // Remove spaces around commas from $buffer 
    $buffer = str_replace(', ', ',', $buffer);
    $buffer = str_replace(' ,', ',', $buffer);
    // Remove duplicates from csv $buffer
    $buffer = explode(',',$buffer);
    $buffer = array_unique($buffer);
    return $buffer;
}

// cache busting based on the time the file was last modified
function posts_row_cache_buster($file) {
    if (file_exists($file)) return filemtime($file); 
    else return '0.0.0';
}