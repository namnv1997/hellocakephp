<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 05/02/2018
 * Time: 22:10
 */
namespace App\Controller;
use App\Model\Entity\PostCategory;
class PostCategoriesController
{
    public function getInfoCategoryPost($resultSet){
        $pc = new PostCategory();
        $response = $pc->getInfoCategoryPost($resultSet);
        return $response;
    }

    public function getCategoryByPostId($id){
        $pc = new PostCategory();
        $response = $pc->getCategoryByPostId($id);
        return $response;
    }

}