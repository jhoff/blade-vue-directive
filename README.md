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

<!-- /MarkdownTOC -->

<a name="installation"></a>
## Installation

To install the Laravel Blade Vue Directive, simply run `composer require blade-vue-directive` in a terminal, or if you prefer to manually install you can the following in your `composer.json` file and then run `composer install` from the terminal:

```json
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

```js
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

```js
    Vue.component('welcome-header', {
        props: {
            user: {
                type: Object
            }
        }
    });
```
