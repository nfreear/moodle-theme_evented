<?php
/**
 * A Moodle theme which uses the Moodle Event_2 API.
 *
 * @copyright Nick Freear, 14-March-2018.
 *
 * @link https://github.com/moodle/moodle/blob/master/theme/boost/classes/output/core_renderer.php
 * @link https://github.com/moodle/moodle/blob/master/theme/boost/templates/columns2.mustache
 */

namespace theme_evented\output;

use html_writer;
use theme_evented\event\endofhtml_rendering;

// require_once $CFG->libdir . '/../theme/boost/classes/output/core_renderer.php';


// class core_renderer extends \core_renderer {
class core_renderer extends \theme_boost\output\core_renderer {

    public function _X_DISABLE__standard_footer_html() {
        global $PAGE;

        header( 'X-theme-outesla-01: ' . get_class( $PAGE ));

        $html = parent::standard_footer_html();
        $fn = __METHOD__;

        $html .= "\n<script> console.warn('NDF -- $fn'); </script>\n";

        return $html;
    }

    // https://github.com/moodle/moodle/blob/master/lib/outputrenderers.php#L901-L913
    public function standard_end_of_body_html() {

        $html = parent::standard_end_of_body_html();

        ob_start();
        $event = \theme_evented\event\endofhtml_rendering::create([ 'other' => [
            'themename' => 'evented',
            // 'page' => $PAGE,
            'javascripts' => [],
            'styleshEets' => [],
            'html' => [],
        ] ]);
        $event->trigger();

        $ev_data = json_encode( $event->get_data() );
        $html .= "\n<script> console.warn('Event:', '$ev_data' ); </script>\n";

        $html .= ob_get_clean();

        $html .= self::write_config_javascripts( $html );
        $html .= self::write_debug_javascript( $html, __METHOD__ );

        return $html;
    }

    protected static function write_config_javascripts( $html ) {
        global $CFG;

        $scripts = isset( $CFG->theme_evented_enqueue_script ) ? $CFG->theme_evented_enqueue_script : [];

        foreach ( $CFG->theme_outesla_enqueue_script as $script ) {
            $script = str_replace( '{base}', '', $script );
            $html .= html_writer::start_tag('script', [ 'src' => $script ]);
            $html .= html_writer::end_tag('script');
        }
        return $html;
    }

    protected static function write_debug_javascript( $html, $func ) {
        global $PAGE, $CFG;

        $pg_class = get_class( $PAGE );

        // $html .= "\n<script> console.warn('NDF: $fn; $pg'); </script>\n";
        $html .= html_writer::start_tag('script');
        $html .= "console.warn('NDF 1: $func, $pg_class');";
        $html .= html_writer::end_tag('script');

        return $html;
    }
}

// End.
