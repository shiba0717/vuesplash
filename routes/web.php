<?php

// APIのURL以外のリクエストに対してはindexテンプレートを返す
// 画面遷移はフロントエンドのVueRouterが制御する

Route::get('/photos/{photo}/download', 'PhotoController@download');


Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');

