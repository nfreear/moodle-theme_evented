
# [![Build status — Travis-CI][travis-icon]][travis]

A Moodle theme built on [Boost][] which uses the [Moodle Event_2 API][event_2].


## Usage

Example `db/events.php`:

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

Example `classes/theme_event_observer.php`:

```php
<?php namespace mod_example;

class theme_event_observer {

    public static function endofhtml_rendering( $event ) {
        ?> <pre> Hello:  <?= __METHOD__ ?> </pre> <?php
    }
}
```

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
