<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 05/02/2018
 * Time: 22:10
 */

namespace App\Model\Entity;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class PostCategory extends Entity
{


    public function getInfoCategoryPost($resultSet){
        $response = array();
        foreach ($resultSet as $row) {
            $post_category = TableRegistry::get('post_category');
            $resultCheck = $post_category
                ->find()
                ->from('post_category')
                ->where(['post_id' => $row['id']]);
            $checkAvailable = array();
            foreach ($resultCheck as $check) {
                array_push($checkAvailable, $check['category_id']);
            }
            $comma_separated = implode(",", $checkAvailable);
            array_push($response, array("id" => $row['id'], "title" => $row['title'], "summary" => $row['summary'], "status" => $row['status'], "list" => $comma_separated));
        }
        return $response;
    }

    public function getCategoryByPostId($id){

        $post_category = TableRegistry::get('post_category');
        $resultCheck = $post_category
            ->find()
            ->from('post_category')
            ->where(['post_id' => $id]);
        return $resultCheck;

    }

}