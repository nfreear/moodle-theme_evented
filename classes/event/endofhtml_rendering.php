<?php
/**
 * A Moodle theme which uses the Moodle Event_2 API.
 *
 * @package    theme_evented
 * @copyright  © Nick Freear, 14-March-2018.
 */

namespace theme_evented\event;

defined('MOODLE_INTERNAL') || die();

/**
 * Event triggered in 'core_renderer::standard_end_of_body_html()'.
 *
 * @since      Moodle 2.6
 * @package    theme_evented
 * @copyright  © Nick Freear, 14-March-2018.
 */
class endofhtml_rendering extends \core\event\base {

    /**
     * Initialise required event data properties.
     */
    protected function init() {
        $this->data[ 'anonymous' ] = true;

        $this->context = \context_system::instance();

        // $this->data['objecttable'] = 'user';
        $this->data[ 'crud' ] = 'r';
        $this->data[ 'edulevel' ] = self::LEVEL_OTHER;
    }

    /**
     * @return string  Returns event name.
     */
    public static function get_name() {
        return 'event_evented_endofhtml_rendering';
    }

    /**
     * Returns non-localised event description with id's for admin use only.
     * @return string
     */
    public function get_description() {
        return "Called by the theme in 'core_renderer' derived class: output.standard_end_of_body_html";
    }

    /**
     * @return \moodle_url  Returns relevant URL.
     */
    public function _X__get_url() {
        return new \moodle_url('/user/view.php', [ 'id' => $this->objectid ]);
    }
}

// End.
// "classes/event/endofhtml_rendered.php" 59L, 1364C
