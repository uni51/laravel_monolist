<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Item;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $count_want = $user->want_items()->count();
        $count_have = $user->have_items()->count();
        // 重複した商品は $user->items()->distinct() とすれば MySQL だと表示されるが、
        // Heroku で稼働する PostgreSQL だとエラーが出てしまったので、SQL で書いている
        $items = \DB::table('items')->join('item_user', 'items.id', '=', 'item_user.item_id')->select('items.*')->where('item_user.user_id', $user->id)->distinct()->groupBy('items.id')->paginate(20);

        return view('users.show', [
            'user' => $user,
            'items' => $items,
            'count_want' => $count_want,
            'count_have' => $count_have,
        ]);
    }
}
