<?php

/**
 * Kirby Wrapper Tags
 *
 * (wrapper)(/wrapper) -> <div class="wrapper"></div>
 *
 * Define your wrappers in config.php:
 *
 * c::set('wrapper_tags', ['wrapper', 'slideshow', 'gallery']);
 */

kirbytext::$pre[] = function($kirbytext, $value) {
  $wrappedValue = $value;
  foreach (c::get('wrapper_tags', []) as $tag) {
    $wrappedValue = str_replace(
      array('(' . $tag . ')', '(/' . $tag . ')'),
      array('<div class="' . $tag . '">', '</div>'),
      $wrappedValue
    );
  }
  return $wrappedValue;
};
