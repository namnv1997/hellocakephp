<?php

namespace App\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;

class Comment extends Entity
{

    public function getFirstInfo()
    {
        $cmt = TableRegistry::get('Comments');

        $query = $cmt
            ->find()
            ->from('comments')
            ->limit(5)
            ->offset(0);
        return $query;

    }

    public function getCount(){
        $cmt = TableRegistry::get('Comments');
        $count = $cmt
            ->find()
            ->from('comments')
            ->count();
        return $count;
    }

    public function changePagination($page){

        $cmt = TableRegistry::get('Comments');
        $resultSet = $cmt
            ->find()
            ->from('comments')
            ->limit(5)
            ->offset($page);

        return $resultSet;
    }

    public function add(){

    }

    public function confirm(){
        $categories = TableRegistry::get('Comments');

        $categories->query()
            ->update()
            ->set(['status' => $_REQUEST['status']])
            ->where(['cmt_id' => $_REQUEST['cmt_id']])
            ->execute();
        return 1;

    }


}