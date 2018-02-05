<?php

namespace App\Controller;

use App\Model\Entity\Category;
use App\Model\Entity\Post;
use App\Model\Entity\PostCategory;

class PostsController extends AppController
{
    public function posts()
    {
    }

    public function firstDisplayInfoPost()
    {
        $post = new Post();
        $resultSet = $post->getInfoPosts(5,0);
        return $resultSet;

    }

    public function getCount()
    {
        $post = new Post();
        $count = $post->countPost();
        return $count;
    }

    public function paginationCallData()
    {
        $post = new Post();
        $pcc = new PostCategoriesController();

        $response = array();
        $page = ($_REQUEST['post_pagination'] - 1) * 5;

        $resultSet = $post->getInfoPosts(5, $page);
        $response = $pcc->getInfoCategoryPost($resultSet);

        echo json_encode($response);
        exit();
    }

    public function addCategoryCheck($selected = array())
    {
        $cate = new Category();
        $resultSet = $cate->getCategories();
        return $resultSet;
    }

    public function getTitlePost()
    {
        $post = new Post();
        $resultSet = $post->getTitle($_REQUEST['id_request']);
        $response = array();
        foreach ($resultSet as $row) {
            array_push($response, array("title" => $row['title']));
        }
        echo json_encode($response);
        exit();
    }

    public function getInfoPost()
    {
        $post = new Post();
        $category = new Category();
        $pc = new PostCategory();

        $resultSet = $post->getInfoPost($_REQUEST['post_id']);
        $list = array();
        $resultList = $category->getCategories();
        foreach ($resultList as $row) {
            array_push($list, array("id" => $row['id'], "name" => $row['name']));
        }

        $response = array();
        foreach ($resultSet as $row) {
            $resultCheck = $pc ->getCategoryByPostId($row['id']);
            $checkAvailable = array();
            foreach ($resultCheck as $check) {
                array_push($checkAvailable, $check['category_id']);
            }
            array_push($response, array("id" => $row['id'], "title" => $row['title'], "summary" => $row['summary'], "content" => $row['content'], "status" => $row['status'], "list_active" => $checkAvailable, "list" => $list, "image" => $row['image_post']));
        }

        echo json_encode($response);
        exit();
    }


    public function add()
    {
        $post = new Post();
        $post->add();
        echo 1;
        exit();
    }

    public function edit()
    {
        $post = new Post();
        $post->edit();
        echo 1;
        exit();
    }

    public function delete()
    {
        $post = new Post();
        $post->delete($_REQUEST['post_id']);
        echo 1;
        exit();
    }

}