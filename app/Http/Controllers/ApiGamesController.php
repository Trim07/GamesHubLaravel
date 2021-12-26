<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;

class ApiGamesController extends Controller
{
    public function getAllGames(Request $request){
        $games = new Games();

        if ($request->filter){
            $query = $games::query();
            $query->where($request->type, 'LIKE', "{$request->filter}");
            $data = $query->get();
        }else{
          $data = $games::all();
        }
        return $data;
    }

    public function registerGame(Request $request){
        $data = $request->all();

        try {
            Games::create($data);
        }catch (Exception $e){
            return $e->getMessage();
        };

        return $data;
    }

    public function updateGame(Request $request){
        $request_data = $request->only(['id', 'rating']);


        try {
            $query = Games::where('id', $request_data['id'])->first();
            if ($query->avaliacao == 0.0){
                $query->avaliacao = floatval($request_data['rating']);
            }else{
                $oldsum = $query->avaliacao * $query->times_rated;
                $newaverage = ($oldsum + $request_data['rating']) / ($query->times_rated *100);
                $query->avaliacao = $newaverage;
                $query->avaliacao = floatval(($request_data['rating'] + $query->avaliacao) / 2);
            }
            $query->times_rated += 1;
            $query->save();
            return $query;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteGame(){

    }
}
