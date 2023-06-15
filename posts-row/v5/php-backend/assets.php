<?php
$bust_asset_cache = true; // ⚠️ avoid doing this (don't bust cache, not even based on filetime) in prod
$bust_asset_cache = false; // ⛔️ comment out this line to disable cache (bust cache based on filetime)
$asset_version = '2.0.0';
$plugin_version = 'v5';

$plugin_dir = plugin_dir_path(__FILE__);
$css_file = "../assets/posts-row.css";
$js_file =  "../assets/script.js";
$css_paged_file = "../assets/posts-row-paged.css";
// $svg_symbols_file = "../php-templates/svg-symbols.html";
// $css, $js, $css_paged, and svg_symbols -_files are set here:
// require('config.php');

add_filter('the_content', 'posts_row_filter_the_content', 1);
function posts_row_filter_the_content($content)
{
    global $css_file, $js_file, $css_paged_file;
    // include assets only if the [posts-row] shortcode is used inside the content
    if (has_shortcode($content, 'posts-row')) {

        enqueue_asset($css_file);
        if (posts_row_has_att($content, "posts-row", "paginate")) {
            enqueue_asset($js_file);
            enqueue_asset($css_paged_file, 'posts-row-style-paged');
            // inject html with svg symbols in footer
            $content .= '
            <!-- next-prev-arrows -->
            <svg style="display:none">
                <symbol id="arrow-left-thin"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></symbol>
                <symbol id="arrow-left"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></symbol>
                <symbol id="arrow-right"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></symbol>
            </svg>
            <!-- /next-prev-arrows -->';
        }
    }
    return $content;
}

function enqueue_asset($file, $name = "")
{
    global $bust_asset_cache, $asset_version, $plugin_dir;
    $cache_buster = $bust_asset_cache ? filemtime($plugin_dir . $file) : $asset_version;
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    if ($extension === 'css') {
        if (!$name) $name = 'posts-row-style';
        wp_enqueue_style($name, plugins_url($file, __FILE__), [], $cache_buster);
    } elseif ($extension === 'js') {
        if (!$name) $name = 'posts-row-script';
        wp_enqueue_script($name, plugins_url($file, __FILE__), [], $cache_buster, true);
    }
}

// add_action('wp_head', function(){
//     // hide if it assets weren't enqueued (and it happens to exist, eg: second page of a category)
//     if ( (is_category() && is_paged()) ) {
//         wp_register_style( 'hide-posts-row', false );
//         wp_enqueue_style( 'hide-posts-row' );
//         wp_add_inline_style('hide-posts-row', "[id^='posts-row-wrapper']{ display: none; }");
//     }
// });



// from:
// https://github.com/nonsalant/wp-plugins/blob/main/posts-row/shortcode/assets.php#L110
function posts_row_has_att($content, $shortcode, $att)
{
    $found = false;
    // Enqueue javascript only if "show-arrows" att: [posts-row show-arrows]
    // https://wordpress.stackexchange.com/a/340819
    preg_match_all('/' . get_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        // echo "<pre>"; var_dump($match); echo "</pre>";
        // https://wordpress.stackexchange.com/a/56975
        // https://pastebin.com/rBeTjZRL get atts from shortcode regex
        $regex_pattern = get_shortcode_regex();
        preg_match('/' . $regex_pattern . '/s', $match[0], $regex_matches);
        if ($regex_matches[2] == $shortcode) {
            //  Turn the attributes into a URL parm string
            $attributeStr = str_replace(" ", "&", trim($regex_matches[3]));
            $attributeStr = str_replace('"', '', $attributeStr);
            //  Parse the attributes
            $attributes = wp_parse_args($attributeStr);
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
function posts_row_get_att_values($content, $shortcode, $att, $csv_default = 'heading, link_button')
{
    $buffer = '';
    $shortcodes = [];
    // https://wordpress.stackexchange.com/a/340819
    preg_match_all('/' . get_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $shortcodes[] = $match[0];
        // https://wordpress.stackexchange.com/a/56975
        // https://pastebin.com/rBeTjZRL get atts from shortcode regex
        $regex_pattern = get_shortcode_regex();
        preg_match('/' . $regex_pattern . '/s', $match[0], $regex_matches);
        if ($regex_matches[2] == $shortcode) {
            //  Turn the attributes into a URL parm string
            $attributeStr = str_replace(" ", "&", trim($regex_matches[3]));
            $attributeStr = str_replace('"', '', $attributeStr);
            //  Parse the attributes
            $defaults = array(
                $att => $csv_default,
            );
            $attributes = wp_parse_args($attributeStr, $defaults);
            if (isset($attributes[$att])) {
                $buffer .= $attributes[$att] . ',';
            }
        }
    }
    // Remove spaces around commas from $buffer 
    $buffer = str_replace(', ', ',', $buffer);
    $buffer = str_replace(' ,', ',', $buffer);
    // Remove duplicates from csv $buffer
    $buffer = explode(',', $buffer);
    $buffer = array_unique($buffer);
    return $buffer;
}

// see re using type="module" when enqueueing js scripts:
// https://github.com/nonsalant/wp-plugins/blob/bfbdb7f84ad01d6da014a9fb08d8359e0d7313d4/posts-row/shortcode/assets.php#L60
