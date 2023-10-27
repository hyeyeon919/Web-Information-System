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

        .write {
            width: 700px;
            margin: 0 auto;
            border-top: 3px solid gray;
            border-bottom: 3px solid gray;
        }

        .write input {
            width: 670px;
            padding: 10px;
            margin: 12px auto 0;
        }

        .write .text {
            table-layout: fixed;
            height: 300px;
            white-space: pre-line;
            word-break: break-all;
        }

        .write .button {
            padding: 0 200px;
            margin: 15px auto;
        }

        .write .button a {
            border: 1px solid black;
            background: gainsboro;
            margin: 10px;
            padding: 5px;
            text-decoration: none;
            color: black;
        }

        .write .button a:hover {
            color: blueviolet;
        }

        .write p {
            text-align: center;
        }

        #dropzone {
            width: 670px;
            border: 2px dashed gray;
            text-align: center;
            padding-top: 10px;
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
            <div class="box-contents" style="display: block;">
                <div class="write">
                    <?= form_open_multipart(base_url() . 'post/upload_post', array('id' => 'fileupload')) ?>
                    <span id="select">
                        <select name="category">
                            <option value="Assignment"> Assignment
                            <option value="Lecture"> Lecture
                            <option value="Practical"> Practical
                            <option value="Tutorial"> Tutorial
                            <option value="General"> General
                        </select>
                    </span>
                    <input type="text" name="title" placeholder="title" required>
                    <input type="text" name="content" placeholder="content" class="text" required>
                    <div id="dropzone">
                        <p>Drag and drop files here or click to select files</p>
                        <input type="file" name="postfile[]" id="fileinput" multiple>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Post</button>
                    </div>
                    </form>
                </div>
            </div>
            <script>
                function handleDrop(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (e.dataTransfer.files.length > 0) {
                        for (var i = 0; i < e.dataTransfer.files.length; i++) {
                            formData.append('postfile[]', e.dataTransfer.files[i]);
                        }
                        fileInput.style.display = 'none';
                    }

                    dropzone.classList.remove('dragover');
                }

                function handleFileInput(e) {
                    if (e.target.files.length > 0) {
                        for (var i = 0; i < e.target.files.length; i++) {
                            formData.append('postfile[]', e.target.files[i]);
                        }
                        e.target.value = '';
                    }
                }
            </script>
        </section>
    </div>
</body>

</html>