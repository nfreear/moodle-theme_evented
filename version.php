<?php
/**
 * A Moodle theme which uses the Moodle Event_2 API.
 *
 * @package    theme_evented
 * @copyright  © Nick Freear, 14-March-2018.
 * @license    n/a
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2018031400;  // Was: 2016120500.
$plugin->requires  = 2016112900;
$plugin->component = 'theme_evented';  // Was: 'theme_boost'.

$plugin->dependencies = [
    'theme_boost' => '2016120500'
];

// End.
