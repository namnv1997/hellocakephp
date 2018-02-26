<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class Post extends Entity
{
    public function getPosts()
    {
        $posts = TableRegistry::get('Posts');

        $query = $posts
            ->find()
            ->from('posts');
        return $query;
    }

    public function getInfoPosts($limit, $offset)
    {
        $posts = TableRegistry::get('Posts');

        $query = $posts
            ->find()
            ->from('Posts')
            ->orderDesc('create_date')
            ->limit($limit)
            ->offset($offset);

        return $query;
    }

    public function countPost()
    {
        $posts = TableRegistry::get('Posts');
        $count = $posts
            ->find()
            ->from('posts')
            ->count();
        return $count;
    }

    public function getTitle($id_request)
    {

        $posts = TableRegistry::get('Posts');
        $resultSet = $posts
            ->find()
            ->from('posts')
            ->where(['id !=' => $id_request]);
        return $resultSet;
    }

    public function getInfoPost($id)
    {
        $posts = TableRegistry::get('Posts');
        $query = $posts
            ->find()
            ->from('Posts')
            ->where(['id' => $id]);

        return $query;

    }

    public function add()
    {
        $posts = TableRegistry::get('posts');

        $picProfile = Router::url('/', true) . "img/" . $_REQUEST['name_image'];

        $post = $posts->newEntity();
        $post->title = $_REQUEST['title_post'];
        $post->content = $_REQUEST['content_post'];
        $post->status = $_REQUEST['status_post'];
        $post->summary = $_REQUEST['summary_post'];
        $post->image = $picProfile;
        $posts->save($post);
        return 1;
    }

    public function edit()
    {
        $picEdit = Router::url('/', true) . "img/" . $_REQUEST['name_image_edit'];
        $posts = TableRegistry::get('posts');

        $posts->query()
            ->update()
            ->set(['title' => $_REQUEST['edit_title_post']],
                ['content' => $_REQUEST['edit_content_post']],
                ['status' => $_REQUEST['edit_status_post']])
            ->set(['summary' => $_REQUEST['summary_edit_post']])
            ->set(['image_post' => $picEdit])
            ->where(['id' => $_REQUEST['edit_id_post']])
            ->execute();

        return 1;
    }

    public function delete($id)
    {
        $posts = TableRegistry::get('Posts');
        $posts->query()
            ->delete()
            ->where(['id' => $id])
            ->execute();

        return 1;

    }

    public function getPostLastest()
    {

        $posts = TableRegistry::get('Posts');
        $resultSet = $posts->find()
            ->from('posts')
            ->where(['status' => 1])
            ->orderDesc('create_date')
            ->limit(3);

        return $resultSet;
    }

    public function getMorePost($limit, $offset)
    {
        $posts = TableRegistry::get('Posts');
        $resultSet = $posts->find()
            ->from('posts')
            ->where(['status' => 1])
            ->orderDesc('create_date')
            ->limit($limit)
            ->offset($offset);

        return $resultSet;
    }

    public function getPostById($id)
    {
        $posts = TableRegistry::get('Posts');
        $resultSet = $posts->find()
            ->from('posts')
            ->where(['id' => $id]);
        $re = $resultSet->first();
        return $re;
    }

    public function getPostSame($id)
    {
        $posts = TableRegistry::get('Posts');
        $pc = TableRegistry::get('post_category');
        $list_cate = $pc->find();
        $list_cate->select(['category_id'])
            ->from('post_category')
            ->where(['post_id' => $id]);
        $list_post = $pc->find();
        $list_post->select(['post_id'])
            ->from('post_category')
            ->where(['category_id IN'=> $list_cate]);
        $resultSet = $posts->find()
            ->from('posts')
            ->where(['id IN' => $list_post])
            ->limit(6);
        return $resultSet;
    }

    public function getAllPostAboutCategory($id)
    {
        $posts = TableRegistry::get('Posts');
        $pc = TableRegistry::get('post_category');
        $list_post = $pc->find();
        $list_post->select(['post_id'])
            ->from('post_category')
            ->where(['category_id'=> $id]);
        $resultSet = $posts->find()
            ->from('posts')
            ->where(['id IN' => $list_post]);
        return $resultSet;
    }


}