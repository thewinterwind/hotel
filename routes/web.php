<?php

Route::get('/', 'InventoryController@index');
Route::get('inventory', 'InventoryController@getInventory');
Route::post('inventory/update', 'InventoryController@updateInventory');
Route::post('inventory/update/{roomId}', 'InventoryController@updateSingleInventory');
Route::get('inventory/find', 'InventoryController@findInventory');
