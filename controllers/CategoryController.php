<?php
class CategoryController{
    public function getCategoriesController(){
        $cats = Category::getCategories();
        return $cats;
    }
    public function getCategoryByIdController($data){
        $id = $data;
        $cats = Category::getCategoryById($id);
        return $cats['name_cat'];
    }
    public function deleteCategoriesController($id){
        Category::deleteCategories($id);
        SetAlert::set("info", "Category deleted Successfully");
        Redirect::to("categories-s-blog");

    }
    public function addCategoryController($name){
        Category::addCategory($name);
        SetAlert::set("info", "Post Added Successfully");
        Redirect::to("categories-s-blog");
    }
}