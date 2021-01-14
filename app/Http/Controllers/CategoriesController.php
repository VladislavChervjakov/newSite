<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesCreateRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('categories.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesCreateRequest $request)
    {
        $data = $request->all();

        $item = new Category($data);

        $item->save();

        return redirect('/dashboard#categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(empty($category)) {
            return back()
                ->withErrors(['msg' => "Category [{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();
        $category->fill($data)->save();


        return redirect()
            ->route('categories.edit', $category->id)
            ->with(['success' => 'Successfully saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $news = $category->news()->get();
        foreach ($news as $item) {
            $item->category_id = 1;
            $item->save();
        }

        $category->delete($id);

        return redirect('/dashboard#categories');
    }
}
