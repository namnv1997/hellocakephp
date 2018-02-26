<?php


namespace App\Controller;

use App\Model\Entity\Post;
use App\Model\Entity\Category;
use App\Model\Entity\PostCategory;


class FrontendController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout('frontend');
        $this->set('title', 'Nvn blog');
    }

    public function createContentPage()
    {
        $postControl = new PostsController();
        return $resultSet = $postControl->getPostLastest();
    }

   public function details(){
        $this->viewBuilder()->setLayout('frontend');
        $this->set('title', 'Details');
   }

   public function categoryOInfo(){
       $this->viewBuilder()->setLayout('frontend');
       $this->set('title', 'Category-info');
   }

   public function login(){
       $this->viewBuilder()->setLayout('frontend');
       $this->set('title', 'Login');
   }

   public function signUp(){
       $this->viewBuilder()->setLayout('frontend');
       $this->set('title', 'Sign Up');
   }

}