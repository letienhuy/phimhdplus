<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\Category;
use App\FilmDetail;
use App\Report;
class AdminController extends Controller
{
    //
    public function index(){
        $film = Film::orderBy('id', 'desc')->paginate(10);
        return view('admin.index', ['film' => $film]);
    }
    public function film(Request $request, $action = null){
        switch($action){
            case 'add':
                if($request->method() === "POST"){
                    if(empty($request->name) || empty($request->about) || empty($request->actor) || empty($request->director) || empty($request->episode) || empty($request->category_parent)){
                        return response()->json(['message' => 'Xin vui lòng nhập đầy đủ thông tin phim'], 422);
                    } else {
                        $categoryParent = Category::findOrFail($request->category_parent);
                        $film = new Film;
                        $film->name = $request->name;
                        $film->actor = $request->actor;
                        $film->director = $request->director;
                        $film->about = $request->about;
                        $film->episode = $request->episode;
                        $film->type = $categoryParent->type;
                        $film->is_slide = $request->is_slide == "on" ? 1 : 0;
                        $film->disable = $request->disable == "on" ? 1 : 0;
                        $film->tags = $request->tags;
                        $category = $request->category ?? [];
                        array_unshift($category, $categoryParent->id);
                        $film->category = json_encode($category);
                        if($request->hasFile('poster')){
                            $posterName = md5(time()).$request->poster->getClientOriginalExtension();
                            if($request->poster->move(public_path('upload/posters'), $posterName)){
                                $film->poster = url('upload/posters/'.$posterName);                          
                            } else {
                            return response()->json(['message' => 'Có lỗi xảy ra, vui lòng thử lại sau giây lát'], 422);                            
                            }
                        } else {
                            $film->poster = $request->poster;
                            $film->save();
                            return response()->json(['message' => 'Thêm phim <b>'.$film->name.'</b> thành công. Click <a href="'.route('admin.film.source', ['id' => $film->id]).'">vào đây</a> để quản lý resource phim']);  
                        }
                        
                    }
                } else {
                    $categoryParent = Category::where('parent_id', 0)->get();
                    return view('admin.film.add', ['categoryParent' => $categoryParent]);
                }             
            break;
            case 'edit':
                $film = Film::findOrFail($request->id);
                if($request->method() === "POST"){
                    if(empty($request->name) || empty($request->about) || empty($request->actor) || empty($request->director) || empty($request->episode) || empty($request->category_parent)){
                        return response()->json(['message' => 'Xin vui lòng nhập đầy đủ thông tin phim'], 422);
                    } else {
                        $categoryParent = Category::findOrFail($request->category_parent);
                        $film->name = $request->name;
                        $film->actor = $request->actor;
                        $film->director = $request->director;
                        $film->about = $request->about;
                        $film->episode = $request->episode;
                        $film->type = $categoryParent->type;
                        $film->is_slide = $request->is_slide == "on" ? 1 : 0;
                        $film->disable = $request->disable == "on" ? 1 : 0;
                        $film->tags = $request->tags;
                        $category = $request->category ?? [];
                        array_unshift($category, $categoryParent->id);
                        $film->category = json_encode($category);
                        if($request->hasFile('poster')){
                            $posterName = md5(time()).$request->poster->getClientOriginalExtension();
                            if($request->poster->move(public_path('upload/posters'), $posterName)){
                                $film->poster = url('upload/posters/'.$posterName);
                            }
                        }
                        if($film->save()){
                            return response()->json(['message' => 'Sửa phim <b>'.$film->name.'</b> thành công. Click <a href="'.route('admin.film.source', ['id' => $film->id]).'">vào đây</a> để quản lý resource phim']);                            
                        } else {
                            return response()->json(['message' => 'Có lỗi xảy ra, vui lòng thử lại sau giây lát'], 422);                            
                        }
                    }
                } else {
                    $categoryParent = Category::where('parent_id', 0)->get();
                    $categories = json_decode($film->category, true);
                    $parent = Category::find(array_shift($categories));
                    return view('admin.film.edit', ['categoryParent' => $categoryParent, 'film' => $film, 'categories' => $categories, 'parent' =>$parent]);
                }
            break;
            case 'delete':
                $film = Film::findOrFail($request->id);
                if(count($film->filmDetail) > 0){
                    $html = "<center><div class='alert alert-danger'>Rescource phim đang tồn tại!  Vui lòng xoá resource của phim <b>$film->name</b> trước khi xoá phim này.</div></center>";
                    return view('dialog', ['html' => $html]);
                }
                if($request->method() === "POST"){
                    if($film->delete()){
                        $html = "<center><div class='alert alert-success'>
                        Đã xoá phim <b>$film->name</b> thành công
                        </div>
                        </center>";
                        return view('dialog', ['html' => $html]);
                    } else {
                        $html = "<center><div class='alert alert-danger'>
                        Lỗi khi xoá phim <b>$film->name</b>, vui lòng thử lại
                        </div>
                        </center>";
                        return view('dialog', ['html' => $html]);
                    }
                } else {
                    $html = "<center><div class='alert alert-warning'>
                    Xác nhận xoá phim <b>$film->name</b>
                    </div>
                    <button class='btn btn-warning' id='confirm-delete' data-id='$film->id'>Xác nhận</button>
                    </center>";
                    return view('dialog', ['html' => $html]);
                }
            break;
            case 'category':
                $category = Category::findOrFail($request->id);
                return $category->child;
            break;
            default:
                $film = Film::orderBy('id', 'desc')->paginate(20);
                return view('admin.film.index', ['film' => $film]);
        }
    }
    public function filmSource(Request $request, $id, $action = null){
        switch($action){
            case 'add':
                $film = Film::findOrFail($id);
                if($film->type === 1 || count($film->filmDetail) === $film->episode){
                    return redirect()->route('admin.film.source', ['id' => $film->id]);
                }
                if($request->method() === "POST"){
                    if(empty($request->name) || empty($request->m18) || empty($request->m22) || empty($request->m36) || empty($request->m18_vip) || empty($request->m22_vip) || empty($request->m36_vip)){
                        return response()->json(['message' => 'Xin vui lòng nhập đầy đủ thông tin resource phim'], 422);
                    } else {
                        $filmDetail = new FilmDetail;
                        $filmDetail->name = $request->name;
                        $filmDetail->film_id = $id;
                        $filmDetail->source1 = $request->m18;
                        $filmDetail->source2 = $request->m22;
                        $filmDetail->source3 = $request->m36;
                        $filmDetail->source_vip1 = $request->m18_vip;
                        $filmDetail->source_vip2 = $request->m22_vip;
                        $filmDetail->source_vip3 = $request->m36_vip;
                        if($filmDetail->save()){
                            return response()->json(['message' => 'Thêm resource phim thành công!']);                            
                        } else {
                            return response()->json(['message' => 'Có lỗi xảy ra, xin vui lòng thử lại sau giây lát!'], 422);                            
                        }
                    }
                } else {
                    return view('admin.film.source.add', ['film' => $film]);
                }   
            break;
            case 'edit':
                $filmDetail = FilmDetail::findOrFail($id);
                if($request->method() === "POST"){
                    if(empty($request->name) || empty($request->m18) || empty($request->m22) || empty($request->m36) || empty($request->m18_vip) || empty($request->m22_vip) || empty($request->m36_vip)){
                        return response()->json(['message' => 'Xin vui lòng nhập đầy đủ thông tin resource phim'], 422);
                    } else {
                        $filmDetail->name = $request->name;
                        $filmDetail->film_id = $id;
                        $filmDetail->source1 = $request->m18;
                        $filmDetail->source2 = $request->m22;
                        $filmDetail->source3 = $request->m36;
                        $filmDetail->source_vip1 = $request->m18_vip;
                        $filmDetail->source_vip2 = $request->m22_vip;
                        $filmDetail->source_vip3 = $request->m36_vip;
                        if($filmDetail->save()){
                            return response()->json(['message' => 'Sửa resource phim thành công!']);                            
                        } else {
                            return response()->json(['message' => 'Có lỗi xảy ra, xin vui lòng thử lại sau giây lát!'], 422);                            
                        }
                    }
                } else {
                    return view('admin.film.source.edit', ['filmDetail' => $filmDetail]);
                }   
            break;
            case 'delete':
                $filmDetail = FilmDetail::findOrFail($id);
                if($request->method() === "POST"){
                    if($filmDetail->delete()){
                        $html = "<center><div class='alert alert-success'>
                        Đã xoá resource <b>$filmDetail->name</b> thành công
                        </div>
                        </center>";
                        return view('dialog', ['html' => $html]);
                    } else {
                        $html = "<center><div class='alert alert-danger'>
                        Lỗi khi xoá phim <b>$filmDetail->name</b>, vui lòng thử lại
                        </div>
                        </center>";
                        return view('dialog', ['html' => $html]);
                    }
                } else {
                    $html = "<center><div class='alert alert-warning'>
                    Xác nhận xoá resource <b>$filmDetail->name</b>
                    </div>
                    <button class='btn btn-warning' id='confirm-delete-resource' data-id='$filmDetail->id'>Xác nhận</button>
                    </center>";
                    return view('dialog', ['html' => $html]);
                }
            break;
           default:
                $film = Film::findOrFail($request->id);
                return view('admin.film.source.index', ['film' => $film, 'filmDetail' => $film->filmDetail()->paginate(20)]);
        }
    }
}
