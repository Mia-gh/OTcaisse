<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



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
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp,heif,heic,heif-sequence,heic-sequence',
            'description'=>'nullable |string',
            'reference'=>'nullable',
            'status' => 'required| in:actif,inactif',
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
        $articles = Article::all();
        $categories = Category::all();
        return view('articles.create', compact('categories','articles'));

    }

    //Stocker une nouvelle ressource
    public function store(Request $request)
    {
        $validData = $request->validate($this->rules());
            
        if ($request->image != null) {
            $path = Storage::putFileAs('img', $request->image, Str::slug($validData['title'], '_').'.'.$request->image->extension());
            $validData["image"] = $path;
        }

        Article::create($validData);
        return redirect()->route('articles.index')->with('success','Article créé avec succès !');
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
        $validData = $request->validate($this->rules());

        if ($request->image != null) {
            $path = Storage::putFileAs('img', $request->image, Str::slug($validData['title'], '_').'.'.$request->image->extension());
            $validData["image"] = $path;
        }

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


// -- Public function update : Mettre à jour l'article spécifique avec les données validées
// UPDATE articles SET
//     title = {validData_title},
//     price = {validData_price},
//     quantity = {validData_quantity},
//     quantity_alert = {validData_quantity_alert},
//     category_id = {validData_category_id},
//     image = {validData_image},
//     description = {validData_description},
//     reference = {validData_reference},
//     status = {validData_status},
//     updated_at = {current_timestamp}
// WHERE id = {article_id};

//     public function Edit mais traduite en sql:
//     -- Récupérer un article spécifique
// SELECT * FROM articles WHERE id = {article_id};

// -- Récupérer toutes les catégories
// SELECT * FROM categories;