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
                        Assignment
                    </ul>
                    <ul>
                        Lecture
                    </ul>
                    <ul>
                        Practical
                    </ul>
                    <ul>
                        Tutorial
                    </ul>
                    <ul>
                        General
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
                <p>
                <div class="container mt-5">
                    <hr>
                    <span id="listCat">
                        <h4>Fav List</h4>
                        <div id="scrollArea" style="height: 300px; overflow-y: auto;">
                            <ul>
                                <?php foreach ($results as $post): ?>
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
                                        <?= form_open_multipart(base_url() . 'post/postdetail') ?>
                                        <input type="hidden" name="hidden_pid" value="<?php echo $post['pid']; ?>">
                                        <a href="<?php echo base_url('postdetail/' . $post['pid']); ?>">detail</a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $('#scrollArea').on('scroll', function () {
                                    if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                                    }
                                });
                            });
                        </script>
                    </span>
                    </ul>
                </div>
            </div>
            </p>
    </div>
    </section>
    </div>
</body>

</html>