<?php
/**
 *  app/Http/Controllers/CategoryController.php
 *
 * User:
 * Date-Time: 23.09.20
 * Time: 12:55
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'title' => 'nullable|string',
        ]);
        $categories = Category::query()->orderBy('id', 'DESC');
        if ($request->title) {
            $categoryTitle = 'title_' . App()->getLocale();
            $categories = $categories->where($categoryTitle, 'LIKE', '%' . $request->title . '%');
        }
        if ($request->date_from) {
            $categories = $categories->whereDate('created_at', '>=', Carbon::parse($request->date_from));
        }
        if ($request->date_to) {
            $categories = $categories->whereDate('created_at', '<=', Carbon::parse($request->date_to));
        }

        $categories = $categories->paginate(25);
        return view('theme.template.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.template.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title_ge' => 'required|string',
            'title_en' => 'nullable|string',
            'title_ru' => 'nullable|string',
        ]);

        Category::create([
            'title_ge' => $request->title_ge,
            'title_en' => $request->title_ge,
            'title_ru' => $request->title_ge
        ]);

        return redirect('category')->with('success', 'Category added.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_ge' => 'required|string',
            'title_en' => 'nullable|string',
            'title_ru' => 'nullable|string',
        ]);
        $category = Category::find($id);
        $category->title_ge = $request->title_ge;
        $category->title_en = $request->title_en;
        $category->title_ru = $request->title_ru;
        $category->save();

        return redirect('category')->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $category = Category::find($id);
        $category->deleted_at = Carbon::now();
        $category->save();
        return redirect('category')->with('danger', 'Category deleted.');
    }
}
