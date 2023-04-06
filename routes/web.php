<?php

use Illuminate\Support\Arr;
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

