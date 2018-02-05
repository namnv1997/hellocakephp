<?php
echo $this->Html->script('comment.js');
?>
<div id="menu" >
    <ul>
        <li><a href="http://localhost/hello_cakephp/admin"> Intro </a></li>
        <li><a href="http://localhost/hello_cakephp/admin/categories"> Category</a></li>
        <li><a href="http://localhost/hello_cakephp/admin/posts"> Post</a></li>
        <li><a href="http://localhost/hello_cakephp/admin/comments">Comment</a></li>
    </ul>
</div>  <!-- menu -->

<div class="container">
    <h2 id="comment" class="title-style">COMMENT MANGAGER</h2>
    <div>
        <h3 class="col-sm-8">COMMENT CONFIRM</h3>
    </div>

    <div class="row" style="float: left; margin-top: 20px">
        <div class="row-table">
            <div class="column-table text-center" style="width:60px;">
                <b>ID</b>
            </div>
            <div class="column-table text-center" style="width:60px;">
                <p><b>User Id</b></p>
            </div>
            <div class="column-table text-center" style="width:60px;">
                <p><b>Post Id</b></p>
            </div>
            <div class="column-table text-center" style="width:550px;">
                <p><b>Comment</b></p>
            </div>
            <div class="column-table text-center" style="width: 80px;">
                <b>Status</b>
            </div>
            <div class="column-table text-center" style="width: 200px;">
                <b>Options</b>
            </div>
        </div>
        <?php
        $comment = new \App\Controller\CommentsController();
        $comment->firstInfoComment();
        ?>
    </div>

</div>


