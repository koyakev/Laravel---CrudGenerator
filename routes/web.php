<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;

Route::get('/', [CrudController::class, 'create_view'])->name('create_view');

Route::post('/create', [CrudController::class, 'create_table'])->name('create_table');

Route::get('/show_tables', [CrudController::class, 'show_tables'])->name('show_tables');

Route::get('/show_table/{id}', [CrudController::class, 'show_table'])->name('show_table');

Route::post('/table/{id}/migrate', [CrudController::class, 'migrate_table'])->name('migrate_table');

Route::delete('/table/{id}/delete', [CrudController::class, 'delete_table'])->name('delete_table');

Route::get('/table/{table_id}', [CrudController::class, 'add_to_table'])->name('add_to_table');

Route::post('/table/{table_id}/{table_name}/add', [CrudController::class, 'store_to_table'])->name('store_to_table');

Route::delete('/table/{table_id}/{table_name}/{id}/delete', [CrudController::class, 'delete_from_table'])->name('delete_from_table');