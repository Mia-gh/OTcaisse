<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



class CategoryController extends Controller
{
    public function rules(): array
    {
        return [
            // 'name' => 'required |unique:categories,name',
            'name' => 'required',
            'color' => 'nullable |string',
            'description' => 'nullable |string',
            'status' => 'required| in:actif,inactif',
        ];
    }
    /**
     * Display a listing of the resource. Method GET
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $categories = Category::all();
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $categories = Category::all();
        $articles = Article::all();
        return response()->view('categories.create', compact('categories', 'articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validData = $request->validate([
        'name' => 'required',
        'color' => 'nullable',
        'description' => 'nullable',
        'status' => 'required| in:actif,inactif'
        
    ]);
            
       Category::create($validData);
        return redirect()->route('categories.index')
            ->with('success','Catégorie créée avec succès !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(category $category)
    // {
    //     return view('categories.show',compact('category'));
    // }
    public function show(Category $category)
    {
        // $category = Category::find($id);
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validData = $request->validate($this->rules());
    
        $category->update($request->all());
    
        return redirect()->route('categories.index')
                        ->with('success','La catégorie a été modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    
        return redirect()->route('categories.index')
                        ->with('success','La catégorie a été supprimée.');
    }
}
