<?php
/**
 * A Moodle theme which uses the Moodle Event_2 API.
 *
 * @copyright Nick Freear, 14-March-2018.
 *
 * @link https://github.com/moodle/moodle/blob/master/theme/boost/classes/output/core_renderer.php
 * @link https://github.com/moodle/moodle/blob/master/theme/boost/templates/columns2.mustache#L118
 */

namespace theme_evented\output;

defined('MOODLE_INTERNAL') || die();

use html_writer;
use theme_evented\event\endofhtml_rendering;

class core_renderer extends \theme_boost\output\core_renderer {

    public function _x_disable__standard_footer_html() {
        global $PAGE;

        header( 'X-theme-outesla-01: ' . get_class( $PAGE ));

        $html = parent::standard_footer_html();
        $fn = __METHOD__;

        $html .= "\n<script> console.warn('NDF -- $fn'); </script>\n";

        return $html;
    }

    /**
     * Output the standard tags (typically script tags that are not needed earlier)...
     * @link https://github.com/moodle/moodle/blob/master/lib/outputrenderers.php#L901-L913
     * @return string HTML fragment.
     */
    public function standard_end_of_body_html() {

        $html = parent::standard_end_of_body_html();

        ob_start();
        $event = \theme_evented\event\endofhtml_rendering::create([ 'other' => [
            'themename' => 'evented',
            // Not: 'page' => $PAGE.
            'javascripts' => [],
            'styleshEets' => [],
            'html' => [],
        ] ]);
        $event->trigger();

        $evdata = json_encode( $event->get_data() );
        $html .= "\n<script> console.warn('Event:', '$evdata' ); </script>\n";

        $html .= ob_get_clean();

        $html .= self::write_config_javascripts();
        $html .= self::write_debug_javascript( __METHOD__ );

        return $html;
    }

    /**
     * @return string Return HTML fragment.
     */
    protected static function write_config_javascripts() {
        global $CFG;

        $scripts = isset( $CFG->theme_evented_enqueue_script ) ? $CFG->theme_evented_enqueue_script : [];

        $html = '';
        foreach ($scripts as $script) {
            $script = str_replace('{base}', '', $script);
            $html .= html_writer::start_tag('script', [ 'src' => $script ]);
            $html .= html_writer::end_tag('script');
        }
        return $html;
    }

    /**
     * @return string Return HTML fragment.
     */
    protected static function write_debug_javascript($func) {
        global $PAGE;

        $pgclass = get_class( $PAGE );

        $html = '';
        $html .= html_writer::start_tag('script');
        $html .= "console.warn('Debug: $func, $pgclass');";
        $html .= html_writer::end_tag('script');

        return $html;
    }
}

// End.
