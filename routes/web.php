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