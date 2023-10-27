<html>

<head>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
</head>

<body>
    <style>
        :root {
            --gap: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
        }

        body {
            background-color: #efefef;
        }

        .box {
            background-color: #ddd;
            padding: var(--gap);
            display: flex;
            gap: var(--gap);
            min-height: 400px;
            flex-direction: row;
        }

        .box.align_right {
            flex-direction: row-reverse;
        }


        .box-sidebar {
            width: 140px;
            flex-shrink: 0;
        }

        #listCat {
            text-align: left;

        }

        .box-contents {
            flex-grow: 1;
            min-width: 0;
        }

        #search {
            position: relative;
            width: 700px;
            display: contents;
        }

        #select {
            position: relative;
            display: contents;
            width: 300px;
        }

        .searching {
            position: relative;
            display: flex;
        }

        input {
            width: 100%;
            border: 1px solid #bbb;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
        }

        img {
            position: absolute;
            width: 17px;
            top: 10px;
            right: 12px;
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .post {
            background - color: #f8f8f8;
            border: 1px solid #ddd;
            border - radius: 5px;
            padding: 20px;
            margin - bottom: 20px;
        }

        .post - title {
            font - size: 24px;
            margin - top: 0;
        }

        .post - date {
            font - size: 14px;
            color: #666;
        }

        .post - content {
            font - size: 16px;
            color: #333;
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-form textarea {
            width: 100%;
            height: 100px;
            resize: none;
        }

        .comment-form input[type="submit"] {
            margin-top: 10px;
        }
    </style>
    <?php
    echo view("template/header");
    ?>
    <div class="container">
        <section class="box">
            <aside class="box-sidebar">
            <span id="listCat">
                    <ul>
                        <a href="<?php echo base_url(); ?>">Hot Topic</a>
                    </ul>
                    <ul>
                        <a href="<?php echo base_url('Assignment'); ?>">Assignment</a>
                    </ul>
                    <ul>
                        <a href="<?php echo base_url('Lecture'); ?>">Lecture</a>
                    </ul>
                    <ul>
                        <a href="<?php echo base_url('Practical'); ?>">Practical</a>
                    </ul>
                    <ul>
                        <a href="<?php echo base_url('Tutorial'); ?>">Tutorial</a>
                    </ul>
                    <ul>
                        <a href="<?php echo base_url('General'); ?>">General</a>
                    </ul>
                </span>
            </aside>
            <aside class="box-sidebar">
                <span id="listCat">
                    <h4>Hot Topic</h4>
                    <div id="scrollArea" style="height: 300px; overflow-y: auto;">
                        <ul>
                            <?php
                            $model = model('App\Models\Post_model');
                            $posts = $model->findAll();
                            foreach ($posts as $post): ?>
                                <li>
                                    <h2>
                                        <?php echo $post['title']; ?>
                                    </h2>
                                    <p>
                                        <?php echo $post['content']; ?>
                                    </p>
                                    <p>
                                        <?php echo $post['name']; ?>
                                    </p>
                                    <p>
                                        <?php echo $post['date']; ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </span>
            </aside>
            <div class="box-contents">
                <div class="searching">
                    <div>
                    </div>
                </div>
                <p>
                <div class="container mt-5">
                    <?php $pidpost = $postdetail['pid']; ?>
                    <div class="post">
                        <?= form_open(base_url() . 'postdetail/like') ?>
                        <input type="hidden" name="hidden_pid" value="<?php echo $pidpost; ?>">
                        <p>like :
                            <?php echo $postdetail['thumbup']; ?>
                        </p>
                        <input type="submit" value="like this post">
                        <?= form_close() ?>
                        <h1>title:
                            <?php echo $postdetail['title']; ?>
                        </h1>
                        <p>content:
                            <?php echo $postdetail['content']; ?>
                        </p>
                        <p>writer:
                            <?php echo $postdetail['name']; ?>
                        </p>
                        <p>category:
                            <?php echo $postdetail['category']; ?>
                        </p>
                        <p>date:
                            <?php echo $postdetail['date']; ?>
                        </p>
                        <?php
                        if (!empty($postdetail['file'])) {
                            $filenames = explode(",", $postdetail['file']);
                            foreach ($filenames as $file) {
                                $file_path = WRITEPATH . 'Post/' . $file;
                                if ($file != null) {
                                    if (file_exists($file_path)) {
                                        echo ('filename: ' . $file);
                                        echo '<a href="' . "/demo/writable/Post/" . $file . '" target="_blank"> open file</a>';
                                        echo '<br><br>';
                                    }
                                }
                            }
                        }
                        ?>
                        <?= form_open(base_url() . 'postdetail/fav') ?>
                        <input type="hidden" name="hidden_pid" value="<?php echo $pidpost; ?>">
                        <input type="submit" value="add to fav">
                        <?= form_close() ?>
                        <hr>
                        <a href="<?php echo base_url(); ?>">back</a>
                    </div>
                </div>

                    <div id="commentList">
                        <h2>Comments</h2>
                        <div id="scrollArea" style="height: 200px; overflow-y: auto;">
                        <ul>
                            <?php
                            $model = model('App\Models\Comment_model');
                            $db = \Config\Database::connect();
                            $query = $db->table('Comment')
                                ->where('pid', $pidpost)
                                ->get();

                            $result = $query->getResultArray();
                            foreach ($result as $comment): ?>
                                <li>
                                    <h2>
                                        <?php echo $comment['username']; ?>
                                    </h2>
                                    <p>
                                        <?php echo $comment['date']; ?>
                                    </p>
                                    <p>
                                        <?php echo $comment['content']; ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="comment-form">
                    <h2>New comments</h2>
                    <?= form_open_multipart(base_url() . '/postdetail/newcomment', 'method="post"') ?>
                    <textarea name="content" placeholder="content"></textarea>
                    <input type="hidden" name="hidden_pid" value="<?php echo $pidpost; ?>">
                    <button type="submit" class="btn btn-primary btn-block">newComment</button>
                    <?= form_close() ?>
                </div>
                </p>
            </div>
        </section>
    </div>
</body>
</html>