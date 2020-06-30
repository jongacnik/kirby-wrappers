<?php

load([
  'monoeq\\kirbywrappers\\wrappers' => 'src/Wrappers.php'
], __DIR__);

Kirby::plugin('monoeq/wrappers', [
  'hooks' => [
    'kirbytags:before' => function (string $text = null, array $data = []) {
      foreach (option('monoeq.wrappers', []) as $tag) {
        $text = Monoeq\KirbyWrappers\Wrappers::replace($text, $tag, $data);
      }

      return $text;
    }
  ]
]);
