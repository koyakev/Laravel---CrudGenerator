<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;

Route::get('/', [CrudController::class, 'create_view'])->name('create_view');

Route::post('/tables/create', [CrudController::class, 'create_table'])->name('create_table');

Route::get('/tables/show', [CrudController::class, 'show_tables'])->name('show_tables');

Route::get('/tables/show/{id}', [CrudController::class, 'show_table'])->name('show_table');

Route::post('/tables/migrate/{id}', [CrudController::class, 'migrate_table'])->name('migrate_table');

Route::delete('/tables/delete/{id}', [CrudController::class, 'delete_table'])->name('delete_table');

Route::get('/tables/table/add/{table_id}', [CrudController::class, 'add_to_table'])->name('add_to_table');

Route::post('/tables/table/add/{table_id}/{table_name}', [CrudController::class, 'store_to_table'])->name('store_to_table');

Route::delete('/tables/table/delete/{table_id}/{table_name}/{id}', [CrudController::class, 'delete_from_table'])->name('delete_from_table');

Route::get('tables/table/edit/{table_id}/{table_name}/{id}', [CrudController::class, 'edit_from_table'])->name('edit_from_table');

Route::put('tables/table/update/{table_id}/{table_name}/{id}', [CrudController::class, 'update_from_table'])->name('update_from_table');