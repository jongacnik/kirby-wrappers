<?php

class kirbyWrappers {

  public static function replace ($string, $tag, $kirbytext) {
    $options = [];
    $options['tag'] = is_array($tag) && isset($tag['tag']) ? $tag['tag'] : $tag;
    $options['classname'] = is_array($tag) && isset($tag['classname']) ? $tag['classname'] : $options['tag'];
    $options['element'] = is_array($tag) && isset($tag['element']) ? $tag['element'] : 'div';

    // opting for simple ([^\)]*) instead of kirby core style of matching attributes (?:\s([a-z0-9_-]+:.*))*
    $string = preg_replace_callback('!(\(' . $options['tag'] . '([^\)]*)\))([\s\S]*?)(\(\/' . $options['tag'] . '\))!is', function ($matches) use ($options, $kirbytext) {
     
      // split attributes
      $search = preg_split('!([^:\s]+):!i', trim($matches[2]), false, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
      
      // stringify data-attributes
      $attributes = self::dataAttributify($search);

      $field = new Field($kirbytext->field->page, null, trim($matches[3]));

      return '<' . $options['element'] . ' class="' . $options['classname'] . '"'. ($attributes ? ' ' . $attributes : '') . '>' . kirbytext($field) . '</' . $options['element'] . '>';
    }, $string);

    return $string;
  }

  private static function dataAttributify ($arr) {
    $pairs = [];
    for ($i = 0; $i < count($arr); $i+=2) {
      if (isset($arr[$i+1])) {
        $pairs[] = 'data-' . trim($arr[$i]) . '="' . htmlspecialchars(trim($arr[$i+1])) . '"';
      } else {
        $pairs[] = 'data-' . trim($arr[$i]);
      }
    }
    return implode(' ', $pairs);
  }
  
}

