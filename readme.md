# Kirby Wrapper Tags

Simple wrapper tags for Kirbytext.

`(wrapper)(/wrapper)` → `<div class="wrapper"></div>`

## Example

Let's create a `columns` wrapper. 

**config.php**

```php
c::set('wrapper_tags', ['columns']);
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

You can specify wrapper tags as strings or arrays with *tag*, *classname*, and *element* keys. Arrays are useful when you want the tag and the associated classname to be different, or you want to use an element other than `div`.

**config.php**

```php
c::set('wrapper_tags', [
  [
    'tag' => 'gallery',
    'classname' => 'image-gallery',
  ],
  [
    'tag' => 'card',
    'element' => 'article',
  ],
  'slideshow',
]);
```

**kirbytext**

```md
(gallery)(/gallery)
(card)(/card)
(slideshow)(/slideshow)
```

**output**

```html
<div class="image-gallery"></div>
<article class="card"></article>
<div class="slideshow"></div>
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

## Notes

You can add as many wrapper tags as you need:

**config.php**

```php
c::set('wrapper_tags', ['columns', 'gallery', 'slideshow', 'card']);
```

Which will turn any of these...

```md
(columns)(/columns)
(gallery)(/gallery)
(slideshow)(/slideshow)
(card)(/card)
```

Into these...

```html
<div class="columns"></div>
<div class="gallery"></div>
<div class="slideshow"></div>
<div class="card"></div>
```

## Why?

This is handy if you need to wrap content in Kirby to do fancy stuff with js and css.
