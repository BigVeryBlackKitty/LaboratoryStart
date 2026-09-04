<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Тестовый маршрут для проверки связи с фронтендом
Route::get('/test', function () {
    return response()->json([
        'message' => '✅ Laravel API работает!',
        'status' => 'success',
        'time' => now()->toDateTimeString(),
        'version' => '1.0.0'
    ]);
});

// Маршрут для получения пользователей (пример)
Route::get('/users', function () {
    return response()->json([
        ['id' => 1, 'name' => 'Иван Петров', 'email' => 'ivan@example.com'],
        ['id' => 2, 'name' => 'Мария Смирнова', 'email' => 'maria@example.com'],
        ['id' => 3, 'name' => 'Алексей Иванов', 'email' => 'alex@example.com'],
    ]);
});

// Маршрут для проверки статуса
Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'database' => app()->has('db') ? 'connected' : 'disconnected',
        'timestamp' => now()->toDateTimeString()
    ]);
});

// Если нужно защищённые маршруты - раскомментируйте
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });