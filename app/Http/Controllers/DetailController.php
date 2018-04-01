<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\FilmDetail;
use Auth;
class DetailController extends Controller
{
    public function category($id){
        return $id;
    }
    public function detail($id){
        $film = Film::findOrFail($id);
        return view('detail.detail', ['film' => $film]);
    }
    public function viewFilm($id){
        $film = Film::findOrFail($id);
        return view('detail.view', ['film' => $film]);
    }
    public function getSource($filmDetailId){
        $filmDetail = FilmDetail::findOrFail($filmDetailId);
        $data = array();
        $data['source'] = [
            'm18' => $filmDetail['source1'],
            'm22' => $filmDetail['source2'],
            'm36' => $filmDetail['source3'],
        ];
        if(Auth::check()){
            if(Auth::user()->vip){
                $data['source'] = [
                    'm18' => $filmDetail['source_vip1'],
                    'm22' => $filmDetail['source_vip2'],
                    'm36' => $filmDetail['source_vip3'],
                ];
            }
        }
        $data['name'] = $filmDetail->name;
        $data['poster'] = $filmDetail->film->poster;
        return response()->json($data);
    }
}
