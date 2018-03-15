
# [![Build status — Travis-CI][travis-icon]][travis]

A Moodle theme built on [Boost][] and the [Moodle Event 2 API][event_2].

Other Moodle plugins can observe `rendering` events to manipulate
any or every page, for example, by injecting Javascripts.

## Events

### `endofhtml_rendering`

* Event name: `\theme_evented\event\endofhtml_rendering`
* Triggered: just before the closing `</body></html>`,
  in the PHP method, `..\core_renderer::standard_end_of_body_html()`
* Anonymous: _yes_,
* Context: _system_.

## Usage

Example `mod/example/db/events.php`:

```php
<?php

$observers = [
  [
    'eventname' => '\theme_evented\event\endofhtml_rendering',
    'callback'  => '\mod_example\theme_event_observer::endofhtml_rendering',
  ],

  // ...
];
```

Example `mod/example/classes/theme_event_observer.php`:

```php
<?php namespace mod_example;

class theme_event_observer {

    public static function endofhtml_rendering( $event ) {
        ?>
          <pre>
            Hello world! ~ <?= __METHOD__ ?>
          </pre>
        <?php
    }
}
```

## Install... Test

And, at the commandline / terminal, type:

```sh
composer install
composer test
```

---
© 2018 Nick Freear.


[gh]: https://github.com/nfreear/moodle-theme_evented
[travis]:  https://travis-ci.org/nfreear/moodle-theme_evented
[travis-icon]: https://api.travis-ci.org/nfreear/moodle-theme_evented.svg
    "Build status – Travis-CI (PHP + NPM/eslint)"
[gh-boost]: https://github.com/moodle/moodle/tree/master/theme/boost "Boost theme"
[boost]: https://docs.moodle.org/dev/Creating_a_theme_based_on_boost#Starting_files "Boost theme"
[event_2]: https://docs.moodle.org/dev/Event_2 "Moodle Event_2 API."

[End]: //.
