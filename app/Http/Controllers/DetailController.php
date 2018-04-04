<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\FilmDetail;
use App\Like;
use App\Vote;
use App\Report;
use App\Category;
use Auth;
class DetailController extends Controller
{
    public function category($id){
        $category = Category::findOrFail($id);
        $film = Film::where([['category', 'like', '%'.$category->id.'%'], ['disable', 0]])->get();
        return view('detail.category', ['category' => $category, 'film' => $film]);
    }
    public function detail($id){
        $film = Film::findOrFail($id);
        return view('detail.detail', ['film' => $film]);
    }
    public function viewFilm($id){
        $film = Film::findOrFail($id);
        $film->view++;
        $film->save();
        return view('detail.view', ['film' => $film]);
    }
    public function download($id){
        $film = Film::findOrFail($id);
        return view('detail.download', ['film' => $film]);
    }
    public function like($id){
        $film = Film::findOrFail($id);
        $like = Like::where([['film_id', $id], ['user_id', Auth::id()]])->first();
        if(is_null($like)){
            $like = new Like;
            $like->film_id = $film->id;
            $like->user_id = Auth::id();
            $like->save();
            return response()->json(['code' => 1]);
        } else {
            $like->delete();
            return response()->json(['code' => 0]);            
        }
    }
    public function vote(Request $request, $id){
        $film = Film::findOrFail($id);
        $vote = Vote::where([['film_id', $id], ['user_id', Auth::id()]])->first();
        if(is_null($vote)){
            $vote = new Vote;
            $vote->film_id = $film->id;
            $vote->user_id = Auth::id();
            $vote->point = $request->point;
            $vote->save();
            return response()->json(['code' => 1]);            
        } else {
            return response()->json(['code' => 0]);                    
        }
    }
    public function report(Request $request, $id){
        if($request->method() === "POST"){
            if(is_null($request->email)){
                return response()->json(['message' => 'Vui lòng nhập email!'], 422);                
            }elseif(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9_.+-].[a-zA-Z0-9_.+-]/', $request->email)){
                return response()->json(['message' => 'Vui lòng nhập email hợp lệ!'], 422);                
            }elseif(is_null($request->message)){
                return response()->json(['message' => 'Vui lòng nhập nội dung lỗi bạn muốn gửi đi!'], 422);                
            }else{
                $report = new Report;
                $report->film_id = $request->film;
                $report->email = $request->email;
                $report->messages = $request->message;
                $report->save();
                if($report){
                    return response()->json(['message' => 'Chúng tôi đã ghi nhận báo lỗi của bạn. Cảm ơn vì sự giúp đỡ, chúng tôi sẽ phản hồi lại với bạn sau!']);                                    
                } else {
                    return response()->json(['message' => 'Có lỗi xảy ra, bạn vui lòng thử lại sau!'], 422);                                    
                }
            }
        }
        $film = Film::findOrFail($id);
        return view('detail.report', ['film' => $film]);
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
