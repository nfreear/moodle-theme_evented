<?php
/**
 * A Moodle theme which uses the Moodle Event_2 API.
 *
 * @package    theme_evented
 * @copyright  © Nick Freear, 14-March-2018.
 *
 * @link https://docs.moodle.org/dev/Event_2
 * @link https://docs.moodle.org/dev/Creating_a_theme_based_on_boost#Starting_files
 */

defined('MOODLE_INTERNAL') || die();

// Was: $THEME = new \stdClass().
$THEME->name = 'evented';
$THEME->sheets = [];
$THEME->parents = [ 'boost' ];
// Was: $THEME->doctype = 'html5'.


// A dock is a way to take blocks out of the page and put them in a persistent floating area on the side of the page. Boost
// does not support a dock so we won't either - but look at bootstrapbase for an example of a theme with a dock.
$THEME->enable_dock = false;

// This is an old setting used to load specific CSS for some YUI JS. We don't need it in Boost based themes because Boost
// provides default styling for the YUI modules that we use. It is not recommended to use this setting anymore.
$THEME->yuicssmodules = [];

// Most themes will use this rendererfactory as this is the one that allows the theme to override any other renderer.
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

// This is a list of blocks that are required to exist on all pages for this theme to function correctly. For example
// bootstrap base requires the settings and navigation blocks because otherwise there would be no way to navigate to all the
// pages in Moodle. Boost does not require these blocks because it provides other ways to navigate built into the theme.
$THEME->requiredblocks = '';

// This is a feature that tells the blocks library not to use the "Add a block" block. We don't want this in boost based
// themes because it forces a block region into the page when editing is enabled and it takes up too much room.
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;

// End.
