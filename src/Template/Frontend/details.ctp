<?php
echo $this->Html->script('details.js');

use App\Controller\PostsController;
use App\Controller\PostCategoriesController;
use App\Controller\CategoriesController;

$pcc = new PostCategoriesController();
$pc = new PostsController();
$cc = new CategoriesController();

$id_post = $this->request->query('id_post');
$result = $pc->getPostById($id_post);
$resultIdCategory = $pcc->getCategoryByPost($id_post);

$content = "";

$content .= '<div>
            <h3 class="text-center"><b>' . $result['title'] . '</b></h3>
            <div class="text-center">
             <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
             <span class="color808080">' . $result['create_date'] . '</span> <br></div>';

$content .= '<div class="text-center margin10">';
$content .= '<span class="glyphicon glyphicon-tags margin-right10"></span>';
foreach ($resultIdCategory as $row) {
    $resultCategory = $cc->getCategoryById($row['category_id']);
    foreach ($resultCategory as $row_name) {
        $content .= '<span class="border-category"><a href="http://localhost/hello_cakephp/frontend/category-info?category_id=' . $row_name['id'] . '">'
            . $row_name['name'] . ' </a></span>';
    }
}
$content .= '</div>';

$content .= '<div class="text-center">
            <img src="' . $result['image_post'] . '">
            </div>
            <div class="content-detail">' . $result['content'] . '</div></div>';

$slide_component = "";
$resultPost = $pc->getPostSame($id_post);
foreach ($resultPost as $post_same) {
        $slide_component .= '<div class="">
                        <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="http://localhost/hello_cakephp/frontend/details?id_post=' . $post_same['id'] . '"><img src="' . $post_same['image_post'] . '" class="img-responsive center-block img150"></a>
                        <h5 class="text-center">' . $post_same['title'] . '</h5>
                        </div>
                        </div>';
}


echo $content;
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $this->Html->css('slider.css') ?>
</head>
<div id="same_topic" class="bottom50">
    <div>
        <hr class="wid90">
        <h3><b class="margin-title-same-topic">Same Topic</b></h3>
        <div class="container-fluid container-fluid-css">
            <div class="row">
                <!-- Item slider-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                                <div class="carousel-inner">

                                    <?php echo $slide_component ?>

                                </div>
                                <!-- left,right control -->
                                <div id="slider-control">
                                    <a class="left carousel-control" href="#itemslider" data-slide="prev"><img
                                                src="http://localhost/hello_cakephp/img/arrow_left.png" alt="Left"
                                                class="img-responsive"></a>
                                    <a class="right carousel-control" href="#itemslider" data-slide="next"><img
                                                src="http://localhost/hello_cakephp/img/arrow_right.png" alt="Right"
                                                class="img-responsive"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item slider end-->
            </div>
        </div>
    </div>
</div>

