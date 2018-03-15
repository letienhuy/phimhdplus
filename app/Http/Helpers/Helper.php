<?php
namespace App\Http\Helpers;
use App\Category;
class Helper{
    public static function slideCategories($parentId = 0){
        $html = "";
        $categories = Category::where('parent_id', $parentId)->get();
        foreach($categories as $category){
            $html .= "<li>";
            $html .= $category->name;
            if(count($category->child) > 0 && $parentId === 0){
                $html .= '<ul class="collapse">';
                $html .= self::slideCategories($category->id);
                $html .= "</ul>";
            }
            $html .= "</li>";
        }
        return $html;
    }
}
?>