Laravel Blade Vue Directive
==============

Laravel Blade Vue Directive provides a blade directive for vue.js inline components.

[![Latest Stable Version](https://img.shields.io/github/release/jhoff/blade-vue-directive.svg?style=flat-square)](https://packagist.org/packages/jhoff/blade-vue-directive)
[![Total Downloads](https://img.shields.io/packagist/dt/jhoff/blade-vue-directive.svg?style=flat-square)](https://packagist.org/packages/jhoff/blade-vue-directive)
[![MIT License](https://img.shields.io/packagist/l/jhoff/blade-vue-directive.svg?style=flat-square)](https://packagist.org/packages/jhoff/blade-vue-directive)
[![Build Status](https://scrutinizer-ci.com/g/jhoff/blade-vue-directive/badges/build.png?b=master)](https://scrutinizer-ci.com/g/jhoff/blade-vue-directive/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/jhoff/blade-vue-directive/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jhoff/blade-vue-directive/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jhoff/blade-vue-directive/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jhoff/blade-vue-directive/?branch=master)

<!-- MarkdownTOC autolink="true" autoanchor="true" bracket="round" depth="4" -->

- [Installation](#installation)
- [Usage](#usage)
    - [Basic Example](#basic-example)
    - [Scalars Example](#scalars-example)
    - [Booleans and Numbers Example](#booleans-and-numbers-example)
    - [Objects and Arrays Example](#objects-and-arrays-example)
    - [camelCase to kebab-case](#camelcase-to-kebab-case)
    - [Using compact to pass variables directly through](#using-compact-to-pass-variables-directly-through)

<!-- /MarkdownTOC -->

<a name="installation"></a>
## Installation

To install the Laravel Blade Vue Directive, simply run `composer require blade-vue-directive` in a terminal, or if you prefer to manually install you can the following in your `composer.json` file and then run `composer install` from the terminal:

```javascripton
{
    "require": {
        "jhoff/blade-vue-directive": "1.*"
    }
}
```

Then all you need to do is add the new provider to the providers array of `config/app.php`:

```php
  'providers' => [
    // ...
    Jhoff\BladeVue\DirectiveServiceProvider::class,
    // ...
  ],
```

<a name="usage"></a>
## Usage

The Laravel Blade Vue Directive was written to be simple and intuitive to use. It's not opinionated about how you use your vue.js components. Simply provide a component name and (optionally) an associative array of properties.

<a name="basic-example"></a>
### Basic Example

Using the vue directive with no arguments in your blade file

```html
    @vue('my-component')
        <div>Some content</div>
    @endvue
```

Renders in html as

```html
    <component inline-template v-cloak is="my-component">
        <div>Some content</div>
    </component>
```

<a name="scalars-example"></a>
### Scalars Example

Using the vue directive with an associative array as the second argument will automatically translate into native properties that you can use within your vue.js components.

```html
    @vue('page-title', ['title' => 'Welcome to my page'])
        <h1>@{{ title }}</h1>
    @endvue
```

Renders in html as

```html
    <component inline-template v-cloak is="page-title" title="Welcome to my page">
        <h1>{{ title }}</h1>
    </component>
```

Then, to use the properties in your vue.js component, add them to `props` in your component definition. See [Component::props](https://vuejs.org/v2/guide/components.html#Props) for more information.

```javascript
    Vue.component('page-title', {
        props: ['title']
    });
```

<a name="booleans-and-numbers-example"></a>
### Booleans and Numbers Example

Properties that are booleans or numeric will be bound automatically as well

```html
    @vue('report-viewer', ['show' => true, 'report' => 8675309])
        <h1 v-if="show">Report #@{{ report }}</h1>
    @endvue
```

Renders in html as

```html
    <component inline-template v-cloak is="report-viewer" :show="true" :report="8675309">
        <h1 v-if="show">Report #{{ report }}</h1>
    </component>
```

<a name="objects-and-arrays-example"></a>
### Objects and Arrays Example

The vue directive will automatically handle any objects or arrays to make sure that vue.js can interact with them without any additional effort.

```html
    @vue('welcome-header', ['user' => (object)['name' => 'Jordan Hoff']])
        <h2>Welcome @{{ user.name }}!</h2>
    @endvue
```

Renders in html as

```html
    <component inline-template v-cloak is="welcome-header" :user="{&quot;name&quot;:&quot;Jordan Hoff&quot;}">
        <h2>Welcome {{ user.name }}!</h2>
    </component>
```

Notice that the object is json encoded, html escaped and the property is prepended with `:` to ensure that vue will bind the value as data.

To use an object property in your component, make sure to make it an `Object` type:

```javascript
    Vue.component('welcome-header', {
        props: {
            user: {
                type: Object
            }
        }
    });
```

<a name="camelcase-to-kebab-case"></a>
### camelCase to kebab-case

If you provide camel cased property names, they will automatically be converted to kebab case for you. This is especially useful since vue.js will (still work)[https://vuejs.org/v2/guide/components.html#camelCase-vs-kebab-case] with camelCase variable names.

```html
    @vue('camel-to-kebab', ['camelCasedVariable' => 'value']])
        <div>You can still use it in camelCase see :) @{{ camelCasedVariable }}!</div>
    @endvue
```

Renders in html as

```html
    <component inline-template v-cloak is="camel-to-kebab" camel-cased-variable="value">
        <div>You can still use it in camelCase see :) {{ camelCasedVariable }}!</div>
    </component>
```

Just make sure that it's still camelCased in the component props definition:

```javascript
    Vue.component('camel-to-kebab', {
        props: ['camelCasedVariable']
    });
```

<a name="using-compact-to-pass-variables-directly-through"></a>
### Using compact to pass variables directly through

Just like when you render a view from a controller, you can use compact to pass a complex set of variables directly through to vue:

```html
    <?php list($one, $two, $three) = ['one', 'two', 'three']; ?>
    @vue('compact-variables', compact('one', 'two', 'three'))
        <div>Variables are passed through by name: @{{ one }}, @{{ two }}, @{{ three }}.</div>
    @endvue
```

Renders in html as

```html
    <component inline-template v-cloak is="compact-variables" one="one" two="two" three="three">
        <div>Variables are passed through by name: {{ one }}, {{ two }}, {{ three }}.</div>
    </component>
```

Then in vue, make sure to define all of your properties:

```javascript
    Vue.component('compact-variables', {
        props: ['one', 'two', 'three']
    });
```
