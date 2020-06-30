# Kirby Wrappers

Simple wrapper tags for Kirbytext.

`(wrapper)(/wrapper)` → `<div class="wrapper"></div>`

## Installation

```
composer require monoeq/kirby-wrappers
```

<details>
  <summary>Other installation methods</summary>

### Download

Download and copy this repository to `/site/plugins/kirby-wrappers`.

### Git submodule

```
git submodule add https://github.com/monoeq/kirby-wrappers.git site/plugins/kirby-wrappers
```
</details>

## Example

Let's create a `columns` wrapper. 

**config.php**

```php
return [
  'monoeq.wrappers' => ['columns']
];
```

**kirbytext**

```md
(columns)
  - One
  - Two
  - Three
(/columns)
```

**output**

```html
<div class="columns">
  <ul>
    <li>One</li>
    <li>Two</li>
    <li>Three</li>
  </ul>
</div>
```

## Configuration

You can specify wrapper tags as `Strings` or `Arrays` with `wrapper`, `class`, `tag`, and `attributes` keys. Arrays are useful when you want the tag and the associated classname to be different, or you want to use a tag other than `div`.

**config.php**

```php
return [
  'monoeq.wrappers' => [
    'center', // ← simplest
    [
      'wrapper' => 'gallery',
      'class' => 'image-gallery',
    ],
    [
      'wrapper' => 'card',
      'tag' => 'article',
    ],
    [
      'wrapper' => 'toggle',
      'attributes' => [
        'data-component' => 'toggle'
      ]
    ],
    [
      'wrapper' => 'modal',
      'class' => false // ← pass false to disable class
      'attributes' => [
        'data-component' => 'modal'
      ]
    ]
  ]
];
```

**kirbytext**

```md
(center)(/center)
(gallery)(/gallery)
(card)(/card)
(toggle)(/toggle)
(modal)(/modal)
```

**output**

```html
<div class="center"></div>
<div class="image-gallery"></div>
<article class="card"></article>
<div class="toggle" data-component="toggle"></div>
<div data-component="modal"></div>
```

## Passing Data

You can optionally pass additional data into data-attributes:

**kirbytext**

```md
(gallery size: large)(/gallery)
```

**output**

```html
<div class="gallery" data-size="large"></div>
```

## Nesting

Does nesting work? Yep.

**kirbytext**

```md
(outer)(inner)(/inner)(/outer)
```

**output**

```html
<div class="outer"><div class="inner"></div></div>
```

## Why?

This is handy if you need to wrap content in Kirby to do fancy stuff with js and css.

## Notes

- Kirby 2 version found under the `k2` branch