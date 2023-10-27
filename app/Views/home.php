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

        .box-sidebar,
        .box-contents {
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
    </style>
    <?php
    echo view("template/header");
    ?>
    <button id="button" onclick="location.href='newThread'">newThread</button>
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
                            foreach ($post as $post): ?>
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
                                        <?php echo $post['date'];
                                        $pid = $post['pid']; ?>
                                    </p>
                                    <?= form_open_multipart(base_url() . 'post/postdetail') ?>
                                    <input type="hidden" name="hidden_pid" value="<?php echo $pid; ?>">
                                    <a href="<?php echo base_url('postdetail/' . $pid); ?>">detail</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#scrollArea').on('scroll', function () {
                                if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0]
                                    .scrollHeight) { }
                            });
                        });
                    </script>
                </span>
            </aside>
            <div class="box-contents">
                <div class="searching">
                    <input type="text" id="searchinput" placeholder="Search by title">
                    <img src="https://s3.ap-northeast-2.amazonaws.com/cdn.wecode.co.kr/icon/search.png">
                </div>
                <br>
                <div id="search-results"></div>
                <script>
                    const searchInput = document.getElementById('searchinput');
                    const searchResults = document.getElementById('search-results');

                    searchInput.addEventListener('keyup', function () {
                        const searchTerm = searchInput.value;
                        $.ajax({
                            url: '<?php echo base_url() . 'searchitems' ?>',
                            method: 'GET',
                            data: { search: searchTerm },
                            dataType: 'json', 
                            success: function (response) {
                                let html = '';
                                response.forEach(function (result) {
                                    html += '<ul> <h2>' + result.title + '</h2> <p>' + result.content +
                                        '</p> <p>' + result.name +
                                        '</p>' + '<a href="' + '<?= base_url() ?>postdetail/' + result.pid + '">detail</a> </li>';
                                    html += '<hr>';
                                });
                                searchResults.innerHTML = html;
                            },
                            error: function () {
                                console.error('Search request failed');
                            }
                        });
                    });
                </script>
            </div>
        </section>
    </div>
</body>

</html>