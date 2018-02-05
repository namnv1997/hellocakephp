<?php
echo $this->Html->script('jquery.multiselect.js');
echo $this->Html->script('post.js');
echo $this->Html->script('gallery.js');
?>

<div>
    <div class="container">
        <div id="menu" class="col-2">
            <ul>
                <li><a href="http://localhost/hello_cakephp/admin"> Intro </a></li>
                <li><a href="http://localhost/hello_cakephp/admin/categories"> Category</a></li>
                <li><a href="http://localhost/hello_cakephp/admin/posts"> Post</a></li>
                <li><a href="http://localhost/hello_cakephp/admin/comments">Comment</a></li>
            </ul>
        </div>  <!-- menu -->
        <h2 id="post" class="title-style">POST MANGAGER</h2>
        <div>
            <h3 class="col-sm-8">POST AVAILABLE</h3>
            <div class="col-sm-3" style="float:right; margin-right:5%; ">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-lg btn-primary btn_create_new" data-toggle="modal"
                        data-target="#exampleModal">
                    Create a new post
                </button>
            </div>
        </div>

        <div class="row" style="float: left;">
            <div class="row-table">
                <div class="column-table text-center minw30">
                    <b>ID</b>
                </div>
                <div class="column-table text-center minw200">
                    <b>Title</b>
                </div>
                <div class="column-table text-center minw400">
                    <p><b>Content</b></p>
                </div>
                <div class="column-table text-center" style="width: 80px;">
                    <b>Status</b>
                </div>
                <div class="column-table text-center" style="width: 200px;">
                    <b>Options</b>
                </div>
            </div>

            <?php
            $post = new \App\Controller\PostsController();
            $resultSet = $post->firstDisplayInfoPost();

            echo '<div id="post_display">';
            foreach ($resultSet as $row) {
                echo '<div class="row-table">';
                echo '<div class="column-table text-right minw30">' . $row['id'] . '</div>';
                echo '<div class="column-table padding10 minw200">' . $row['title'] . '</div>';
                echo '<div class="column-table padding10 text-summary minw400">' . $row['summary'] . '</div>';
                if ($row['status'] == 1) {
                    echo '<div class="column-table text-center">Enabled</div>';
                } else {
                    echo '<div class="column-table text-center">Disabled</div>';
                }
                echo '<div class="column-table text-center" data-id="' . $row['id'] . '" >';
                echo '<button type="button" class="btn btn-primary btnUD edit-post"  data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target=".edit-post-modal"> &nbsp Edit &nbsp </button>';
                echo '<button class="btn btn-danger btnUD delete-post" data-toggle="modal" data-target=".delete-post-modal">Delete</button>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';

            $count = $post->getCount();
            $number_of_pagination = ceil($count / 5);
            echo '<ul class="pagination post-previous">';
            echo '<li class="page-item previous-li-post" style="display: none" ><a class="page-link">Previous</a></li>';
            echo '</ul>';
            echo '<ul class="pagination pagination-post">';
            for ($i = 1; $i <= $number_of_pagination; $i++) {
                if ($i == 1) {
                    echo '<li><a class="active-me-post"  id="post-' . $i . '" data-page="' . $i . '" data-max-page="' . $number_of_pagination . '">' . $i . '</a></li>';
                } else {
                    echo '<li><a data-page="' . $i . '" id="post-' . $i . '" data-max-page="' . $number_of_pagination . '">' . $i . '</a></li>';
                }
            }
            echo '</ul>';
            echo '<ul class="pagination post-next">';
            echo '<li class="page-item next-li-post" ><a class="page-link" style="margin-left: 1px" >Next</a></li>';
            echo '</ul>';

            ?>
        </div>

    </div>


    <!-- Modal add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center text-primary" id="exampleModalLabel">Create New Post</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body"> <!-- modal body -->
                    <form id="post_submit" method="post"
                          action="http://localhost/CoffeWebsite/app/controllers/admin/PostController.php?fnc=addPost">
                        <div class="form-group">
                            <input type="file" class="bottom10" id="uploadfiles" accept="image/*"/>
                            <input type="hidden" id="name_image" name="name_image" accept="image/*"/>
                            <div id="gallery" class="gallery"></div>
                            <label for="title_post">Title</label>
                            <input type="text" class="form-control bottom10" id="title_post" name="title_post"
                                   placeholder="Title Post">
                            <label for="title_post">Summary description</label>
                            <input type="text" class="form-control" id="summary_post" name="summary_post"
                                   placeholder="Summary description">
                        </div>
                        <input type="hidden" name="id_category_post" id="id_category_post">
                        <div class="form-group">
                            <label>Content</label>
                            <?php
                            $f = new \App\View\Froala();
                            $f->froalaAdd();
                            ?>
                        </div>

                        <div class="form-group ">
                            <div class="bottom10">
                                <label for="status_post" class="text-justify control-label"> Status </label>
                                <select class="form-control" name="status_post_select" id="status_post_select">
                                    <option value="1">Enable</option>
                                    <option value="12">Disable</option>
                                </select>
                                <input type="hidden" id="status_post" name="status_post">
                            </div>

                            <div>
                                <label for="status_post" class="text-justify control-label"> Category </label>
                                <?php
                                $post = new \App\Controller\PostsController();
                                $resultSet = $post->addCategoryCheck(null);

                                echo ' <select id="myselect"  name="basic[]" multiple="multiple" class="3col active">';
                                foreach ($resultSet as $row) {
                                    if (in_array($row['id'], $selected)) {
                                        echo '<option value="' . $row['id'] . '" selected>' . $row['name'] . '</option>';
                                    } else {
                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                }
                                echo '</select>';
                                ?>
                            </div>
                        </div>
                    </form>
                </div> <!-- modal body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button submit" id="btn_post" class="btn btn-primary">Post on website</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal add -->


    <!-- modal edit -->
    <div id="edit_post_modal" class="modal fade edit-post-modal" tabindex="-1" role="dialog"
         aria-labelledby="mySmallModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <h3 class="modal-title text-center text-primary ">Edit Post</h3>
                <div class="modal-body"> <!-- modal body -->
                    <form id="edit_post_submit" method="post"
                          action="http://localhost/CoffeWebsite/app/controllers/admin/PostController.php?fnc=editPost">
                        <div class="form-group">
                            <input class="bottom10" type="file" id="uploadfiles_edit" accept="image/*"/>
                            <input type="hidden" id="name_image_edit" name="name_image_edit"/>
                            <div id="gallery_edit" class="gallery bottom10"></div>
                            <label for="title_post">Title</label>
                            <input type="text" class="form-control bottom10" id="edit_title_post" name="edit_title_post"
                                   placeholder="Title Post">
                            <label for="title_post">Summary description</label>
                            <input type="text" class="form-control" id="summary_edit_post" name="summary_edit_post"
                                   placeholder="Summary description">
                        </div>
                        <input type="hidden" name="edit_id_category_post" id="edit_id_category_post">
                        <input type="hidden" name="edit_id_post" id="edit_id_post">
                        <div class="form-group">
                            <label>Content</label>
                            <?php
                            $f = new \App\View\Froala();
                            $f->froalaEdit();
                            ?>
                        </div>

                        <div class="form-group ">
                            <div class="div-select bottom10">
                                <label for="status_post" class="text-justify control-label"> Status </label>
                                <select class="form-control" name="status_post_select" id="edit_status_post_select">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                                <input type="hidden" id="edit_status_post" name="edit_status_post">
                            </div>
                            <div class="edit_check">
                            </div>
                        </div>
                    </form>
                </div> <!-- modal body -->

                <div class="modal-footer">
                    <button type="button" id="btn_edit_close" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="button" id="btn_edit_post" class="btn btn-primary">Edit Post</button>
                </div>

            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div id="delete_post_modal" class="modal fade delete-post-modal" tabindex="1" role="dialog"
         aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="delete_post" class="margin10" method="post"
                      action="http://localhost/CoffeWebsite/app/controllers/admin/PostController.php?fnc=deletePost">
                    <h3 id="tip_delete_post" class="hidden-me"> Are you sure delete category?</h3>
                    <input type="hidden" name="askDeletePost" value=1>
                    <input type="hidden" id="post_id_delete" name="post_id_delete" value=2>
                    <div class="btn btn-group margin10 ">
                        <button type="submit" id="btn_delete_post" class="btn  btn-danger ">
                            Delete
                        </button>
                        <button type="submit" id="btn_delete_post_cancel" class="btn btn-info center-block"> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal delete -->
</div>

