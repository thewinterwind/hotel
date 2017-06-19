<?php

Route::get('/', 'InventoryController@index');
Route::get('inventory', 'InventoryController@getInventory');
Route::post('inventory/update', 'InventoryController@updateInventory');
