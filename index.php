<?php

load([
  'jg\\kirbywrappers\\wrappers' => 'src/Wrappers.php'
], __DIR__);

Kirby::plugin('jg/wrappers', [
  'hooks' => [
    'kirbytags:before' => function (string $text = null, array $data = []) {
      foreach (option('jg.wrappers', []) as $tag) {
        $text = JG\KirbyWrappers\Wrappers::replace($text, $tag, $data);
      }

      return $text;
    }
  ]
]);
