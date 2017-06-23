<?php

class kirbyWrappers {

  public static function replace ($string, $tag) {
    if (!is_array($tag)) {
      $tag = [
        'tag' => $tag,
        'classname' => $tag
      ];
    }

    // opting for simple ([^\)]*) instead of kirby core style of matching attributes (?:\s([a-z0-9_-]+:.*))*
    $string = preg_replace_callback('!(\(' . $tag['tag'] . '([^\)]*)\))([\s\S]*)(\(\/' . $tag['tag'] . '\))!is', function ($matches) use ($tag) {
     
      // split attributes
      $search = preg_split('!([^:\s]+):!i', trim($matches[2]), false, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
      
      // stringify data-attributes
      $attributes = self::dataAttributify($search);

      return '<div class="' . $tag['classname'] . '"'. ($attributes ? ' ' . $attributes : '') . '>' . $matches[3] . '</div>';
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

