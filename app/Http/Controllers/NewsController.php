<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = Category::all();

        return view('news.add', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCreateRequest $request)
    {
        $data = $request->all();
        if (Auth::user()->isAdmin()) {

        }
        $item = new News($data);
        if (Auth::user()->isAdmin()) {
            if(array_key_exists('published', $data) && $data['published'] === 'on') {
                $item->is_published = 1;
            } else {
                $item->is_published = 0;
            }
        }

        $item->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = News::findOrFail($id);

        if(Auth::user()->can('view', $item)) {
            return view('news.show', compact('item'));
        } return redirect()
            ->route('dashboard')
            ->withErrors(['Msg' => 'You don`t own this post']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = News::findOrFail($id);
        $categoryList = Category::all();
        if(Auth::user()->can('update', $item)) {
            return view('news.edit', compact('item', 'categoryList'));
        } return redirect()
                ->route('dashboard')
                ->withErrors(['Msg' => 'You don`t own this post']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $id)
    {

        $item = News::find($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "News [{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();
        if (Auth::user()->isAdmin()) {
            if(array_key_exists('published', $data) && $data['published'] === 'on') {
                $item->is_published = 1;
            } else {
                $item->is_published = 0;
            }
        }
        $item->fill($data)->save();


            return redirect()
                ->route('news.edit', $item->id)
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
        $item = News::find($id);
        if(Auth::user()->cannot('delete', $item)){
            return redirect()
                ->route('dashboard')
                ->withErrors(['Msg' => 'You don`t own this post']);
        }
        $item->delete($id);

        return redirect('/dashboard');
    }
}
