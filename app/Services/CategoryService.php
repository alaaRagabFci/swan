<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Category;

class CategoryService
{
    /**
     * List all Categories.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listCategories()
    {
        return Category::orderBy('sort', 'ASC')->get();
    }

    /**
     * Datatebles
     * @param $Categories
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($Categories)
    {
        $tableData = Datatables::of($Categories)
            ->addColumn('is_active', function (Category $category){
                if($category->is_active)
                    return '<span class="label label-sm label-primary"> نشط </span>';
                else
                    return '<span class="label label-sm label-warning">غير نشط</span>';
            })
            ->setRowId('id')
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','categories')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'is_active'])->make(true);

        return $tableData ;
    }

    /**
     * Get description.
     * @param $categoryId
     * @return Category
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getCategory($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);
            return $category;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Category not found');
        }
    }

    public function sortCategories($ids)
    {
        for($i = 0; $i < count($ids); $i++){
            $category = Category::findOrFail($ids[$i]);
            $category->sort = $i+1;
            $category->save();
        }
        return 'true';
    }

    /**
     * Create description.
     * @param $type
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function createCategory($parameters)
    {
        try {
            if(Category::where('name', $parameters['name'])->first())
                return \Response::json(['msg'=>'هذا القسم موجود بالفعل'],404);
            $max = Category::max('sort');
            $parameters['sort'] = $max + 1;
            $category = new Category();
            $category->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Update user.
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateCategory($parameters, $categoryId)
    {
        try {
            $Category = Category::findOrFail($categoryId);

            if(Category::where('name', $parameters['name'])->where('id', '!=', $categoryId)->first())
                return \Response::json(['msg'=>'هذا القسم موجود بالفعل'],404);

            $Category->update($parameters);
            return \Response::json(['msg'=>'تم التحديث بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Delete Category.
     * @param $CategoryId
     * @return Category
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteCategory($CategoryId)
    {
        return Category::find($CategoryId)->delete();
    }
}
