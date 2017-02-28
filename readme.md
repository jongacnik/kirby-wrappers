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
