<?php 

namespace App\Controllers;
use App\Models\ArticleModel;
use App\Entitles\Article;
use CodeIgniter\Exceptions\PageNotFoundException;

class Articles extends BaseController 
{

    private ArticleModel $model;

    public function __construct()
    {
        $this->model = new ArticleModel;
    }


   public function index()
   {
    
        $data = $this->model->findAll();

    return view("Articles/index.php", [
        "articles" => $data
    ]);
   }
   public function show($id)
   {
        $article = $this->getArticle0r404($id);

        return view("Articles/show",[
            "article" => $article
        ]);
   }

    public function new()
   {
        
        return view("Articles/new", [
            "article" => new Article
        ]);

   }
   public function create()
   {
       
      $article = new Article($this->request->getPost());
    
        $id = $this->model->insert($article);


        if ($id === false ) {

            return redirect()->back()
                             ->with("errors", $this->$model->errors())
                             ->withInput();

        }

        return redirect()->to("articles/$id")
                         ->with("message", "Article saved.");
   }
   public function edit($id)
   {

        $article = $this->getArticle0r404($id);

        return view("Articles/edit", [
            "article" => $article
        ]);  
   }

    public function update($id)
    {
 

        $article = $this->getArticle0r404($id);

        $article->fill($this->request->getPost());
        $article->__unset("_method");

        if ( ! $article->hasChanged()) {

            return redirect()->back()
                             ->with("message", "Nothing to update. ");
        }


       if ($this->model->save($article)){

            return redirect()->to("articles/$id")
                             ->with("message", "Article update.");

       }

       return redirect()->back()
                        ->with("errors", $this->$model->errors())
                        ->withInput();
    }

    public function confirmDelete($id)
    {
       $article = $this->getArticle0r404($id);

       return view("Articles/delete", [
            "article" => $article
       ] );
    }

    public function delete($id)
    {
        $article = $this->getArticle0r404($id);  


        $this->model->delete($id);

        return redirect()->to("articles")
                             ->with("message", "Article deleted.");

        
    }

    private function getArticle0r404($id): Article 
    {
        $article = $this->model->find($id);

        if ($article === null) {

            throw new PageNotFoundException("Article with id $id not found");

        }

        return $article;
 
    }
}