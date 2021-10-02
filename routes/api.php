<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('introduction', "VisitorController@introduction")->name('api.introduction');
Route::post('conversation', "VisitorController@conversation")->name('api.conversation');
Route::post('conversation/send', "VisitorController@sendConversation")->name('api.conversation.send');
Route::post('conversation-init', "VisitorController@conversationInit")->name('api.conversation.init');

Route::get('visitor/{token?}', "VisitorController@getInfo")->name('api.visitor.info');
