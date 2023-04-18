<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * @return array<string, mixed>
 */
Route::get('/arr-add/1', function (): array {
    return Arr::add(['name' => 'Desk'], 'price', 100);

    /*
        {
            "name": "Desk",
            "price": 100
        }
    */
});

/**
 * @return array<string, mixed>
 */
Route::get('/arr-add/2', function (): array {
    return Arr::add(['name' => 'Desk', 'price' => null], 'price', 200);

    /*
        {
            "name": "Desk",
            "price": 200
        }
    */
});

/**
 * @return array<int, int>
 */
Route::get('/arr-collapse', function (): array {
    return Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

    /*
        [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9
        ]
    */
});

/**
 * @return array<int, array>
 */
Route::get('/arr-cross-join/1', function (): array {
    return Arr::crossJoin([1, 2], ['a', 'b']);

    /*
        [
            [
                1,
                "a"
            ],
            [
                1,
                "b"
            ],
            [
                2,
                "a"
            ],
            [
                2,
                "b"
            ]
        ]
    */
});

/**
 * @return array<int, array>
 */
Route::get('/arr-cross-join/2', function (): array {
    return Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II']);

    /*
        [
            [
                1,
                "a",
                "I"
            ],
            [
                1,
                "a",
                "II"
            ],
            [
                1,
                "b",
                "I"
            ],
            [
                1,
                "b",
                "II"
            ],
            [
                2,
                "a",
                "I"
            ],
            [
                2,
                "a",
                "II"
            ],
            [
                2,
                "b",
                "I"
            ],
            [
                2,
                "b",
                "II"
            ]
        ]
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-divide/1', function (): array {
    [$keys, $values] = Arr::divide(['name' => 'Desk']);

    return $keys;

    /*
        [
            "name"
        ]
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-divide/2', function (): array {
    [$keys, $values] = Arr::divide(['name' => 'Desk']);

    return $values;

    /*
        [
            "Desk"
        ]
    */
});

/**
 * @return array<string, int>
 */
Route::get('/arr-dot', function (): array {
    return Arr::dot(['products' => ['desk' => ['price' => 100]]]);

    /*
        {
            "products.desk.price": 100
        }
    */
});

/**
 * @return array<string, string>
 */
Route::get('/arr-except', function (): array {
    return Arr::except(['name' => 'Desk', 'price' => 100], ['price']);

    /*
        {
            "name": "Desk"
        }
    */
});

Route::get('/arr-exists/1', function (): bool {
    return Arr::exists(['name' => 'John Doe', 'age' => 17], 'name');

    // true
});

Route::get('/arr-exists/2', function (): bool {
    return Arr::exists(['name' => 'John Doe', 'age' => 17], 'salary');

    // false
});

Route::get('/arr-first/1', function (): int {
    return Arr::first([100, 200, 300], fn (int $value, int $key): bool => $value >= 150);

    // 200
});

Route::get('/arr-first/2', function (): int {
    return Arr::first([100, 200, 300], fn (int $value, int $key): bool => $value >= 400, 500);

    // 500
});

/**
 * @return array<int, string>
 */
Route::get('/arr-flatten', function (): array {
    return Arr::flatten(['name' => 'Joe', 'languages' => ['PHP', 'Ruby']]);

    /*
        [
            "Joe",
            "PHP",
            "Ruby"
        ]
    */
});

/**
 * @return array<string, array>
 */
Route::get('/arr-forget', function (): array {

    $array = ['products' => ['desk' => ['price' => 100]]];

    Arr::forget($array, 'products.desk');

    return $array;

    /*
        {
            "products": []
        }
    */
});

Route::get('/arr-get/1', function (): int {
    return Arr::get(['products' => ['desk' => ['price' => 100]]], 'products.desk.price');

    // 100
});

Route::get('/arr-get/2', function (): int {
    return Arr::get(['products' => ['desk' => ['price' => 100]]], 'products.desk.salary', 500);

    // 500
});

Route::get('/arr-has/1', function (): bool {
    return Arr::has(['product' => ['name' => 'Desk', 'price' => 100]], 'product.name');

    // true
});

Route::get('/arr-has/2', function (): bool {
    return Arr::has(['product' => ['name' => 'Desk', 'price' => 100]], ['product.price', 'product.discount']);

    // false
});

Route::get('/arr-has-any/1', function (): bool {
    return Arr::hasAny(['product' => ['name' => 'Desk', 'price' => 100]], 'product.name');

    // true
});

Route::get('/arr-has-any/2', function (): bool {
    return Arr::hasAny(['product' => ['name' => 'Desk', 'price' => 100]], ['product.name', 'product.discount']);

    // true
});

Route::get('/arr-has-any/3', function (): bool {
    return Arr::hasAny(['product' => ['name' => 'Desk', 'price' => 100]], ['category', 'product.discount']);

    // false
});

Route::get('/arr-is-list/1', function (): bool {
    return Arr::isList(['foo', 'bar', 'baz']);

    // true
});

Route::get('/arr-is-list/2', function (): bool {
    return Arr::isList(['product' => ['name' => 'Desk', 'price' => 100]]);

    // false
});

Route::get('/arr-join/1', function (): string {
    return Arr::join(['Tailwind', 'Alpine', 'Laravel', 'Livewire'], ', ');

    // Tailwind, Alpine, Laravel, Livewire
});

Route::get('/arr-join/2', function (): string {
    return Arr::join(['Tailwind', 'Alpine', 'Laravel', 'Livewire'], ', ', ' and ');

    // Tailwind, Alpine, Laravel and Livewire
});

/**
 * @return array<string, array>
 */
Route::get('/arr-key-by', function (): array {
    return Arr::keyBy([
        ['product_id' => 'prod-100', 'name' => 'Desk'],
        ['product_id' => 'prod-200', 'name' => 'Book'],
    ], 'product_id');

    /*
        {
            "prod-100": {
                "product_id": "prod-100",
                "name": "Desk"
            },
            "prod-200": {
                "product_id": "prod-200",
                "name": "Book"
            }
        }
    */
});

Route::get('/arr-last/1', function (): int {
    return Arr::last([100, 200, 300, 110], fn (int $value, int $key): bool => $value >= 150);

    // 300
});

Route::get('/arr-last/2', function (): int {
    return Arr::last([100, 200, 300, 110], fn (int $value, int $key): bool => $value >= 400, 500);

    // 500
});

/**
 * @return array<string, string>
 */
Route::get('/arr-map', function (): array {
    return Arr::map(['first' => 'james', 'last' => 'kirk'], fn (string $value, string $key) => Str::of($value)->ucfirst());

    /*
        {
            "first": "James",
            "last": "Kirk"
        }
    */
});

/**
 * @return array<string, mixed>
 */
Route::get('/arr-only', function (): array {
    return Arr::only(['name' => 'Desk', 'price' => 100, 'orders' => 10], ['name', 'price']);

    /*
        {
            "name": "Desk",
            "price": 100
        }
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-pluck/1', function (): array {
    return Arr::pluck([
        ['developer' => ['id' => 1, 'name' => 'Taylor']],
        ['developer' => ['id' => 2, 'name' => 'Abigail']],
    ], 'developer.name');

    /*
        [
            "Taylor",
            "Abigail"
        ]
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-pluck/2', function (): array {
    return Arr::pluck([
        ['developer' => ['id' => 1, 'name' => 'Taylor']],
        ['developer' => ['id' => 2, 'name' => 'Abigail']],
    ], 'developer.name', 'developer.id');

    /*
        {
            "1": "Taylor",
            "2": "Abigail"
        }
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-prepend/1', function (): array {
    return Arr::prepend(['one', 'two', 'three', 'four'], 'zero');

    /*
        [
            "zero",
            "one",
            "two",
            "three",
            "four"
        ]
    */
});

/**
 * @return array<string, mixed>
 */
Route::get('/arr-prepend/2', function (): array {
    return Arr::prepend(['price' => 100], 'Desk', 'name');

    /*
        {
            "name": "Desk",
            "price": 100
        }
    */
});

/**
 * @return array<string, mixed>
 */
Route::get('/arr-prepend-keys-with', function (): array {
    return Arr::prependKeysWith([
        'name' => 'Desk',
        'price' => 100,
    ], 'product.');

    /*
        {
            "product.name": "Desk",
            "product.price": 100
        }
    */
});

Route::get('/arr-pull/1', function (): string {
    /** @var array<string, mixed> $array */
    $array = ['name' => 'Desk', 'price' => 100];

    return Arr::pull($array, 'name');

    // Desk
});

/**
 * @return array<string, int>
 */
Route::get('/arr-pull/2', function (): array {
    /** @var array<string, mixed> $array */
    $array = ['name' => 'Desk', 'price' => 100];

    Arr::pull($array, 'name');

    return $array;

    /*
        {
            "price": 100
        }
    */
});

Route::get('/arr-query', function (): string {
    return Arr::query([
        'name' => 'Taylor',
        'order' => [
            'column' => 'created_at',
            'direction' => 'desc',
        ]
    ]);

    // name=Taylor&order%5Bcolumn%5D=created_at&order%5Bdirection%5D=desc
});

Route::get('/arr-random/1', function (): int {
    return Arr::random([1, 2, 3, 4, 5]);

    // 4 - (retrieved randomly)
});

/**
 * @return array<int, int>
 */
Route::get('/arr-random/2', function (): array {
    return Arr::random([1, 2, 3, 4, 5], 3);

    /*
        [
            2,
            4,
            5
        ]

        - (retrieved randomly)
    */
});

/**
 * @return array<string, array>
 */
Route::get('/arr-set', function (): array {
    /** @var array<string, array> $array */
    $array = [
        'products' => [
            'desk' => [
                'price' => 100,
            ],
        ],
    ];
    
    Arr::set($array, 'products.desk.price', 250);

    return $array;

    /*
        {
            "products": {
                "desk": {
                    "price": 250
                }
            }
        }
    */
});

/**
 * @return array<int, int>
 */
Route::get('/arr-shuffle', function (): array {
    return Arr::shuffle([1, 2, 3, 4, 5]);
    
    /*
        [
            2,
            5,
            3,
            1,
            4
        ]

        - (generated randomly)
    */
});

// Route::get('/arr-sort', function (): array {
//     /** @var array<int, string> */
//     $array = ['Desk', 'Table', 'Chair'];

//     Arr::sort($array);

//     return $array;
// });

Route::get('/arr-to-css-classes', function (): string {
    /** @var bool $isActive */
    $isActive = false;

    /** @var bool $hasError */
    $hasError = true;

    /** @var array<mixed, mixed> */
    $array = ['p-4', 'font-bold' => $isActive, 'bg-red' => $hasError];

    return Arr::toCssClasses($array);

    // p-4 bg-red
});

/**
 * @return array<string, array>
 */
Route::get('/arr-undot', function (): array {
    /** @var array<string, string> */
    $array = [
        'user.name' => 'Kevin Malone',
        'user.occupation' => 'Accountant',
    ];

    return Arr::undot($array);

    /*
        {
            "user": {
                "name": "Kevin Malone",
                "occupation": "Accountant"
            }
        }
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-where', function (): array {
    return Arr::where([100, '200', 300, '400', 500], fn (string|int $value, int $key): bool => is_string($value));

    /*
        {
            "1": "200",
            "3": "400"
        }
    */
});

/**
 * @return array<int, int>
 */
Route::get('/arr-where-not-null', function (): array {
    return Arr::whereNotNull([0, 1, null, 2, 3]);

    /*
        {
            "0": 0,
            "1": 1,
            "3": 2,
            "4": 3
        }
    */
});

/**
 * @return array<int, string>
 */
Route::get('/arr-wrap/1', function (): array {
    return Arr::wrap('Laravel');

    /*
        [
            "Laravel"
        ]
    */
});

/**
 * @return array<null>
 */
Route::get('/arr-wrap/2', function (): array {
    return Arr::wrap(null);

    /*
        []
    */
});

Route::get('/app-path/1', function (): string {
    return app_path();

    // /home/ceyhun/Desktop/laravel-helpers/app
});

Route::get('/app-path/2', function (): string {
    return app_path('Http/Controllers/Controller.php');

    // /home/ceyhun/Desktop/laravel-helpers/app/Http/Controllers/Controller.php
});

Route::get('/base-path/1', function (): string {
    return base_path();

    // /home/ceyhun/Desktop/laravel-helpers
});

Route::get('/base-path/2', function (): string {
    return base_path('vendor/bin');

    // /home/ceyhun/Desktop/laravel-helpers/vendor/bin
});

Route::get('/config-path/1', function (): string {
    return config_path();

    // /home/ceyhun/Desktop/laravel-helpers/config
});

Route::get('/config-path/2', function (): string {
    return config_path('app.php');

    // /home/ceyhun/Desktop/laravel-helpers/config/app.php
});

Route::get('/database-path/1', function (): string {
    return database_path();

    // /home/ceyhun/Desktop/laravel-helpers/database
});

Route::get('/database-path/2', function (): string {
    return database_path('factories/UserFactory.php');

    // /home/ceyhun/Desktop/laravel-helpers/database/factories/UserFactory.php
});

Route::get('/lang-path/1', function (): string {
    return lang_path();

    // /home/ceyhun/Desktop/laravel-helpers/lang
});

Route::get('/lang-path/2', function (): string {
    return lang_path('en/messages.php');

    // /home/ceyhun/Desktop/laravel-helpers/lang/en/messages.php
});

Route::get('/public-path/1', function (): string {
    return public_path();

    // /home/ceyhun/Desktop/laravel-helpers/public
});

Route::get('/public-path/2', function (): string {
    return public_path('css/app.css');

    // /home/ceyhun/Desktop/laravel-helpers/public/css/app.css
});

Route::get('/resource-path/1', function (): string {
    return resource_path();

    // /home/ceyhun/Desktop/laravel-helpers/resources
});

Route::get('/resource-path/2', function (): string {
    return resource_path('sass/app.scss');

    // /home/ceyhun/Desktop/laravel-helpers/resources/sass/app.scss
});

Route::get('/storage-path/1', function (): string {
    return storage_path();

    // /home/ceyhun/Desktop/laravel-helpers/storage
});

Route::get('/storage-path/2', function (): string {
    return storage_path('app/file.txt');

    // /home/ceyhun/Desktop/laravel-helpers/storage/app/file.txt
});

Route::get('/class-basename', function (): string {
    return class_basename('Foo\Bar\Baz');

    // Baz
});

Route::get('/e', function (): string {
    return e('<h1>Laravel</h1>');

    // &lt;h1&gt;Laravel&lt;/h1&gt;gt;
});

Route::get('/preg-replace-array', function (): string {
    return preg_replace_array('/:[a-z_]+/', ['8:30', '9:00'], 'The event will take place between :start and :end');

    // The event will take place between 8:30 and 9:00
});

Route::get('/str-after', function (): string {
    return Str::after('This is my name', 'This is');

    // ' my name'
});

Route::get('/str-after-last', function (): string {
    return Str::afterLast('App\Http\Controllers\UserController', '\\');

    // UserController
});

Route::get('/str-ascii', function (): string {
    return Str::ascii('û');

    // u
});

Route::get('/str-before', function (): string {
    return Str::before('This is my name', 'my name');

    // 'This is '
});

Route::get('/str-before-last', function (): string {
    return Str::beforeLast('App\Http\Controllers\UserController', '\\');

    // App\Http\Controllers
});

Route::get('/str-between', function (): string {
    return Str::between('This is my name', 'This', 'name');

    // ' is my '
});

Route::get('/str-between-first', function (): string {
    return Str::betweenFirst('[a] bc [d]', '[', ']');

    // a
});

Route::get('/str-camel', function (): string {
    return Str::camel('foo_bar');

    // fooBar
});

Route::get('/str-contains/1', function (): bool {
    return Str::contains('This is my name', 'my');

    // true
});

Route::get('/str-contains/2', function (): bool {
    return Str::contains('This is my name', ['my', 'foo']);

    // true
});

Route::get('/str-contains-all/1', function (): bool {
    return Str::containsAll('This is my name', ['my', 'name']);

    // true
});

Route::get('/str-contains-all/2', function (): bool {
    return Str::containsAll('This is my name', ['my', 'foo']);

    // false
});

Route::get('/str-ends-with/1', function (): bool {
    return Str::endsWith('This is my name', 'name');

    // true
});

Route::get('/str-ends-with/2', function (): bool {
    return Str::endsWith('This is my name', 'foo');

    // false
});

Route::get('/str-ends-with/3', function (): bool {
    return Str::endsWith('This is my name', ['name', 'foo']);

    // true
});

Route::get('/str-ends-with/4', function (): bool {
    return Str::endsWith('This is my name', ['foo', 'bar']);

    // false
});

Route::get('/str-excerpt/1', function (): string {
    return Str::excerpt('This is my name', 'my', [
        'radius' => 3
    ]);

    // ...is my na...
});

Route::get('/str-excerpt/2', function (): string {
    return Str::excerpt('This is my name', 'name', [
        'radius' => 3,
        'omission' => '(...)',
    ]);

    // (...)my name
});

Route::get('/str-finish/1', function (): string {
    return Str::finish('this/string', '/');

    // this/string/
});

Route::get('/str-finish/2', function (): string {
    return Str::finish('this/string/', '/');

    // this/string/
});

Route::get('/str-headline/1', function (): string {
    return Str::headline('steve_jobs');

    // Steve Jobs
});

Route::get('/str-headline/2', function (): string {
    return Str::headline('EmailNotificationSent');

    // Email Notification Sent
});

Route::get('/str-inline-markdown', function (): string {
    return Str::inlineMarkdown('**Laravel**');

    // <strong>Laravel</strong>
});

Route::get('/str-is/1', function (): bool {
    return Str::is('foo*', 'foobar');

    // true
});

Route::get('/str-is/2', function (): bool {
    return Str::is('baz*', 'foobar');

    // false
});

Route::get('/str-is-ascii/1', function (): bool {
    return Str::isAscii('Taylor');

    // true
});

Route::get('/str-is-ascii/2', function (): bool {
    return Str::isAscii('ü');

    // false
});

Route::get('/str-is-json/1', function (): bool {
    return Str::isJson('[1,2,3]');

    // true
});

Route::get('/str-is-json/2', function (): bool {
    return Str::isJson('{"first": "John", "last": "Doe"}');

    // true
});

Route::get('/str-is-json/3', function (): bool {
    return Str::isJson('{first: "John", last: "Doe"}');

    // false
});

Route::get('/str-is-ulid/1', function (): bool {
    return Str::isUlid('01gd6r360bp37zj17nxb55yv40');

    // true
});

Route::get('/str-is-ulid/2', function (): bool {
    return Str::isUlid('Laravel');

    // false
});

Route::get('/str-is-uuid/1', function (): bool {
    return Str::isUuid('a0a2a2d2-0b87-4a18-83f2-2529882be2de');

    // true
});

Route::get('/str-is-uuid/2', function (): bool {
    return Str::isUuid('Laravel');

    // false
});

Route::get('/str-kebab', function (): string {
    return Str::kebab('fooBar');

    // foo-bar
});

Route::get('/str-lcfirst', function (): string {
    return Str::lcfirst('Foo Bar');

    // foo Bar
});

Route::get('/str-length', function (): int {
    return Str::length('Laravel');

    // 7
});

Route::get('/str-limit/1', function (): string {
    return Str::limit('The quick brown fox jumps over the lazy dog', 20);

    // The quick brown fox...
});

Route::get('/str-limit/2', function (): string {
    return Str::limit('The quick brown fox jumps over the lazy dog', 20, '(...)');

    // The quick brown fox(...)
});

Route::get('/str-lower', function (): string {
    return Str::lower('LARAVEL');

    // laravel
});

Route::get('/str-markdown/1', function (): string {
    return Str::markdown('# Laravel');

    // <h1>Laravel</h1>
});

Route::get('/str-markdown/2', function (): string {
    return Str::markdown('# Taylor <b>Otwell</b>');

    // <h1>Taylor <b>Otwell</b></h1>
});

Route::get('/str-markdown/3', function (): string {
    return Str::markdown('# Taylor <b>Otwell</b>', [
        'html_input' => 'strip',
    ]);

    // <h1>Taylor Otwell</h1>
});

Route::get('/str-mask/1', function (): string {
    return Str::mask('taylor@example.com', '*', 3);

    // tay***************
});

Route::get('/str-mask/2', function (): string {
    return Str::mask('taylor@example.com', '*', -15, 3);

    // tay***@example.com
});

Route::get('/str-pad-both/1', function (): string {
    return Str::padBoth('James', 10, '_');

    // __James___
});

Route::get('/str-pad-both/2', function (): string {
    return Str::padBoth('James', 10);

    // '  James   '
});

Route::get('/str-pad-left/1', function (): string {
    return Str::padLeft('James', 10, '-=');

    // -=-=-James
});

Route::get('/str-pad-left/2', function (): string {
    return Str::padLeft('James', 10);

    // '     James'
});

Route::get('/str-pad-right/1', function (): string {
    return Str::padRight('James', 10, '-');

    // James-----
});

Route::get('/str-pad-right/2', function (): string {
    return Str::padRight('James', 10);

    // 'James     '
});

Route::get('/str-password/1', function (): string {
    return Str::password();

    // 6.ao{q}sZp{^c2FN&MsEO/w2^{4&Ptxr
});

Route::get('/str-password/2', function (): string {
    return Str::password(12);

    // 79%&cH?w)xh2
});

Route::get('/str-plural/1', function (): string {
    return Str::plural('car');

    // cars
});

Route::get('/str-plural/2', function (): string {
    return Str::plural('child');

    // children
});

Route::get('/str-plural-studly/1', function (): string {
    return Str::pluralStudly('VerifiedHuman');

    // VerifiedHumans
});

Route::get('/str-plural-studly/2', function (): string {
    return Str::pluralStudly('UserFeedback');

    // UserFeedback
});

Route::get('/str-random', function (): string {
    return Str::random(40);

    // PraDU3VKjayJUK6bZ2srch8d1DcjhVunJtGHgcJF
});

Route::get('/str-remove', function (): string {
    return Str::remove('e', 'Peter Piper picked a peck of pickled peppers.');

    // Ptr Pipr pickd a pck of pickld ppprs.
});

Route::get('/str-replace', function (): string {
    return Str::replace('8.x', '9.x', 'Laravel 8.x');

    // Laravel 9.x
});

Route::get('/str-replace-array', function (): string {
    return Str::replaceArray('?', ['8:30', '9:00'], 'The event will take place between ? and ?');

    // The event will take place between 8:30 and 9:00
});

Route::get('/str-replace-first', function (): string {
    return Str::replaceFirst('the', 'a', 'the quick brown fox jumps over the lazy dog');

    // a quick brown fox jumps over the lazy dog
});

Route::get('/str-replace-last', function (): string {
    return Str::replaceLast('the', 'a', 'the quick brown fox jumps over the lazy dog');

    // the quick brown fox jumps over a lazy dog
});

Route::get('/str-reverse', function (): string {
    return Str::reverse('Laravel');

    // levaraL
});

Route::get('/str-singular/1', function (): string {
    return Str::singular('cars');

    // car
});

Route::get('/str-singular/2', function (): string {
    return Str::singular('children');

    // child
});

Route::get('/str-slug', function (): string {
    return Str::slug('Laravel 5 Framework', '-');

    // laravel-5-framework
});

Route::get('/str-snake/1', function (): string {
    return Str::snake('fooBar');

    // foo_bar
});

Route::get('/str-snake/2', function (): string {
    return Str::snake('fooBar', '-');

    // foo-bar
});

// https://github.com/piotrplenik/clean-code-php#liskov-substitution-principle-lsp