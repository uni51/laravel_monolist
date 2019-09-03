<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;

class RankingController extends Controller
{
    public function want()
    {
        // ランキングは上位10個を表示する
        $items = \DB::table('item_user')->join('items', 'item_user.item_id', '=', 'items.id')->select('items.*', \DB::raw('COUNT(*) as want_count'))->where('type', 'want')->groupBy('items.id')->orderBy('want_count', 'DESC')->take(10)->get();

        return view('ranking.want', [
            'items' => $items,
        ]);
    }

    public function have()
    {
        // ランキングは上位10個を表示する
        $items = \DB::table('item_user')->join('items', 'item_user.item_id', '=', 'items.id')->select('items.*', \DB::raw('COUNT(*) as have_count'))->where('type', 'have')->groupBy('items.id')->orderBy('have_count', 'DESC')->take(10)->get();

        return view('ranking.have', [
            'items' => $items,
        ]);
    }
}
