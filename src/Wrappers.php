<?php

namespace JG\KirbyWrappers;

use Kirby\Toolkit\Html;

class Wrappers {
  public static function replace ($text, $tag, $data) {
    $options = [];
    $options['wrapper'] = is_array($tag) && isset($tag['wrapper']) ? $tag['wrapper'] : $tag;
    $options['class'] = is_array($tag) && isset($tag['class']) ? $tag['class'] : $options['wrapper'];
    $options['attributes'] = is_array($tag) && isset($tag['attributes']) && is_array($tag['attributes']) ? $tag['attributes'] : [];
    $options['tag'] = is_array($tag) && isset($tag['tag']) ? $tag['tag'] : 'div';

    // opting for simple ([^\)]*) instead of kirby core style of matching attributes (?:\s([a-z0-9_-]+:.*))*
    $text = preg_replace_callback('!(\(' . $options['wrapper'] . '([^\)]*)\))([\s\S]*?)(\(\/' . $options['wrapper'] . '\))!is', function ($matches) use ($data, $options) {
      $tag = $options['tag'];

      // split inline attributes
      $search = preg_split('!([^:\s]+):!i', trim($matches[2]), false, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
      
      // format data-attributes
      $dataAttributes = self::formatDataAttributes($search);

      // merge all attributes
      $attributes = array_merge([
        'class' => $options['class']
      ], $dataAttributes, $options['attributes']);

      // run kirbytext on child content
      $text = kirbytext(trim($matches[3]), $data);

      return Html::$tag([$text], $attributes);
    }, $text);

    return $text;
  }

  private static function formatDataAttributes ($arr) {
    $attributes = [];
    for ($i = 0; $i < count($arr); $i+=2) {
      if (isset($arr[$i+1])) {
        $attributes['data-' . trim($arr[$i])] = htmlspecialchars(trim($arr[$i+1]));
      } else {
        $attributes['data-' . trim($arr[$i])] = ' ';
      }
    }
    return $attributes;
  }
}
