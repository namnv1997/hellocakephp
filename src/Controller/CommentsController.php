<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 06/02/2018
 * Time: 00:37
 */

namespace App\Controller;
use App\Model\Entity\Comment;

class CommentsController extends AppController
{
    public function comments(){}

    public function firstInfoComment(){
        $comment = new Comment();
        $resultSet = $comment->getFirstInfo();

        echo '<div id="comment_display">';
        foreach ($resultSet as $row) {
            if ($row['status'] == 0) {
                $stt = 'Disable';
                $btn_option = '<button class="btn btn-primary cmt-option" value="1" data-id="' . $row['cmt_id'] . '">Enable</button>';
            } else {
                $stt = 'Enable';
                $btn_option = '<button class="btn btn-danger cmt-option" value="0" data-id="' . $row['cmt_id'] . '">Disable</button>';
            }
            echo '<div class="row-table">
                <div class="column-table text-center" style="width:60px;">
                    <p>' . $row['cmt_id'] . '</p>
                </div>
                <div class="column-table text-center" style="width:60px;">
                    <p>' . $row['user_id'] . '</p>
                </div>
                <div class="column-table text-center" style="width:60px;">
                    <p>' . $row['post_id'] . '</p>
                </div>
                <div class="column-table text-center" style="width:550px;">
                    <p>' . $row['comment'] . '</p>
                </div>
                <div class="column-table text-center" style="width: 80px;">
                    <p>' . $stt . '</p>
                </div>
                <div class="column-table text-center" style="width: 200px;">
                    ' . $btn_option . ' 
                </div>
            </div>';
        }
        echo '</div>';

        $count = $comment->getCount();
        $number_of_pagination = ceil($count / 5);

        echo '<ul class="pagination comment-previous">';
        echo '<li class="page-item previous-li-comment" style="display: none" ><a class="page-link">Previous</a></li>';
        echo '</ul>';
        echo '<ul class="pagination pagination-comment">';
        for ($i = 1; $i <= $number_of_pagination; $i++) {
            if ($i == 1) {
                echo '<li><a class="active-me-comment" id="pagi-comment-1" data-max-page="' . $number_of_pagination . '"  data-page="' . $i . '">' . $i . '</a></li>';
            } else {
                echo '<li><a data-page=" ' . $i . '" id="pagi-comment-' . $i . '" data-max-page=" ' . $number_of_pagination . '" >' . $i . '</a></li>';
            }
        }
        echo '</ul>';
        echo '<ul class="pagination comment-next">';
        if ($number_of_pagination > 1) {
            echo '<li class="page-item next-li-comment" ><a class="page-link">Next</a></li>';
        }
        echo '</ul>';
    }

    public function changePaginationComment()
    {
        $response = array();

        $comment = new Comment();
        $page = ($_REQUEST['comment_pagination'] - 1) * 5;
        $resultSet = $comment->changePagination($page);
        foreach ($resultSet as $row) {
            array_push($response, array("cmt_id" => $row['cmt_id'], "post_id" => $row['post_id'], "user_id" => $row['user_id'], "comment" => $row['comment'], "status" => $row['status']));
        }
        echo json_encode($response);
        exit();
    }

    public function sendComment()
    {
        $comment = new Comment();
        $comment->add();
        echo 1;
        exit();
    }

    public function confirmComment()
    {
        $comment = new Comment();
        $comment->confirm();
        echo 1;
        exit();
    }

}