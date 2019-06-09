<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Response;

class CategoryController extends AbstractController {

    public $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;
    }

    /**
     * List all users.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $categories  = $this->categoryService->listCategories();
        $tableData = $this->categoryService->datatables($categories);

        if($request->ajax())
            return $tableData;

        return view('categories.index')
              ->with('modal', 'categories')
              ->with('modal_', 'قسم')
              ->with('tableData', $tableData);
    }

    /**
     * Update user.
     * requirements={
     *      {"name"="image", "dataType"="String", "requirement"="\d+", "description"="user image"},
     *      {"name"="phone", "dataType"="String", "requirement"="\d+", "description"="phone"},
     *      {"name"="username", "dataType"="String", "requirement"="\d+", "description"="username"},
     *      {"name"="display_name", "dataType"="String", "requirement"="\d+", "description"="display_name"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $category = $this->categoryService->createCategory($data);
        return $category;
    }
    /**
     * Edit user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function edit(Request $request , $id)
    {
        $category = $this->categoryService->getCategory($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $category->toJson()]);
    }

    /**
     * Update user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"},
     *      {"name"="image", "dataType"="String", "requirement"="\d+", "description"="user image"},
     *      {"name"="phone", "dataType"="String", "requirement"="\d+", "description"="phone"},
     *      {"name"="username", "dataType"="String", "requirement"="\d+", "description"="username"},
     *      {"name"="display_name", "dataType"="String", "requirement"="\d+", "description"="display_name"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $category = $this->categoryService->updateCategory( $data, $id);
        return $category;
    }

    /**
     * Delete user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function destroy(Request $request, $id)
    {
        $category = $this->categoryService->deleteCategory($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function sortCategories(Request $request)
    {
        $data  = $request->all();
        $category = $this->categoryService->sortCategories($data);

        return $category;
    }
}
