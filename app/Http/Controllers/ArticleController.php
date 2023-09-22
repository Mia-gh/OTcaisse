<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;



class ArticleController extends Controller
{

    public function rules(): array
    {
        return [
            'title'=>'required |string',
            'price'=>'nullable |decimal:2',
            'quantity'=>'required | integer | min:0',
            'quantity_alert'=>'required | integer | min:0',
            'category_id'=>'required',
            'image'=>'nullable | image | mimes:jpeg,png,jpg,gif,webp,heif,heic,heif-sequence,heic-sequence',
            'description'=>'nullable |string',
            'reference'=>'nullable',
            'status'=>'required | integer',
        ];
    }

    public function index()
    {
        $articles = Article::all();

        return view('articles.index',compact('articles'));
    }
    //Créer le formulaire pour créer une nouvelle ressource

    public function create()
    {
        $categories = Category::all();
        $articles = Article::all();
        return view('articles.create', compact('categories','articles'));

    }

    //Stocker une nouvelle ressource
    public function store(Request $request)
    {
       $validData = $request->validated();
    //    $validData = $request->validate($this->rules);


       Article::create($validData);
        return redirect()->route('articles.index')
            ->with('success','Article créé avec succès !');

    }

    //Afficher la ressource spécifiée
    public function show(Article $article)
    {
        return view('articles.show',compact('article'));
    }

    //Montrer le formulaire pour éditer la ressource spécifiée
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.edit',compact('article','categories'));
    }

    //Mettre à jour la ressource spécifiée dans le stockage
    public function update(Request $request, Article $article)
    {
        $validData = $request->validate();

        $article->update($validData);

        return redirect()->route('articles.index')
            ->with('success','Article mis à jour avec succès !');
    }
    
    //Supprimer la ressource spécifiée du stockage
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success','Article supprimé avec succès !');
    }
}