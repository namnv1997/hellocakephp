<?php
echo $this->Html->script('category-info.js');

use App\Controller\PostsController;
use App\Controller\CategoriesController;

$content_area = "";
$pc = new PostsController();
$cc = new CategoriesController();

$category_id = $this->request->query('category_id');
$resultSet = $pc->getAllPostAboutCategory($category_id);
$category_name = $cc->getCategoryById($category_id);

$content_area .= '<div id="content_area" class="col-md-9">';
$content_area .= '<h3 class="color-category">Post list</h3><hr class="bottom50">';

foreach ($resultSet as $row) {
    $content_area .= '<div class="div-post row" >
                    <div class="col-md-4">
                    <img src="' . $row['image_post'] . '" class="imgPost"/>
                    </div>
                    <div class="col-md-8">
                    <p class="title-post"> ' . $row['title'] . ' </p>
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    <span class="span-time">' . $row['create_date'] . '</span>
                    <input type="hidden" id="id_post" name="id_post">
                    <p class="text-summary"> ' . $row['summary'] . '</p>                 
                    <button type="button" class="btn btn-info btn-read-more margin-top8"  data-id="' . $row['id'] . '">Read More</button>
                    </div>
                    </div>';
}
$content_area .= '</div>';
echo $content_area;