<?php

/**
 * Kirby Wrapper Tags
 *
 * (wrapper)(/wrapper) -> <div class="wrapper"></div>
 *
 * Define your wrappers in config.php:
 *
 * c::set('wrapper_tags', [['tag' => 'wrapper', 'classname' => 'foo-wrapper'], 'slideshow', 'gallery']);
 */

kirbytext::$pre[] = function($kirbytext, $value) {
  $wrappedValue = $value;
  foreach (c::get('wrapper_tags', []) as $tag) {
    if(!is_array($tag)) {
      $tag = [
        'tag' => $tag,
        'classname' => $tag
      ];
    }
    $wrappedValue = str_replace(
      array('(' . $tag['tag'] . ')', '(/' . $tag['tag'] . ')'),
      array('<div class="' . $tag['classname'] . '">', '</div>'),
      $wrappedValue
    );
  }
  return $wrappedValue;
};