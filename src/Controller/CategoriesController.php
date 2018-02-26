<?php

namespace App\Controller;

use App\Model\Entity\Category;

class CategoriesController extends AppController
{

    public function categories()
    {
    }

    public function createInfoCategories()
    {
        $category = new Category();
        $resultSet = $category->createFirstInformation();
        return $resultSet;

    }

    public function getCountCategories()
    {
        $category = new Category();
        return $count = $category->getCount();

    }

    public function getNameCategory()
    {
        $this->autoRender = false;
        $category = new Category();
        $array_name = $category->getName();

        echo implode(",", $array_name);
    }

    public function add()
    {
        $this->autoRender = false;
        $category = new Category();
        $category->add();
        echo 1;
    }

    public function edit()
    {
        $this->autoRender = false;
        $category = new Category();
        $category->edit();
        echo 1;
    }

    public function delete()
    {
        $this->autoRender = false;
        $category = new Category();
        $category->delete();
        echo 1;
    }

    public function paginationCallData()
    {

        $response = array();
        $category = new Category();
        $resultSet = $category->paginationCallData();

        foreach ($resultSet as $row) {
            array_push($response, array("id" => $row['id'], "name" => $row['name']));
        }

        echo json_encode($response);
        exit();
    }

    public function getCategoryById($id){
        $category = new Category();
        return $category->getCategoryById($id);
    }

}