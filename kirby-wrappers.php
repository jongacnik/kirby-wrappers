<?php

/**
 * Kirby Wrapper Tags
 *
 * (wrapper)(/wrapper) -> <div class="wrapper"></div>
 *
 * Define your wrappers in config.php:
 *
 * c::set('wrapper_tags', [['tag' => 'wrapper', 'classname' => 'foo-wrapper', 'element' => 'section'], 'slideshow', 'gallery']);
 *
 * Optionally pass data to data-attributes
 *
 * (wrapper size: large)(/wrapper) -> <div class="wrapper" data-size="large"></div>
 */

require_once('kirby-wrappers-class.php');

kirbytext::$pre[] = function($kirbytext, $value) {
  $wrappedValue = $value;
  foreach (c::get('wrapper_tags', []) as $tag) {
    $wrappedValue = kirbyWrappers::replace($wrappedValue, $tag, $kirbytext);
  }
  return $wrappedValue;
};