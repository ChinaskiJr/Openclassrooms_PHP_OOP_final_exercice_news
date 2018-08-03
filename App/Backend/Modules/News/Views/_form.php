<form action="" method="post">
    <p>
        <?= isset($errors) && in_array(\Entity\News::INVALID_AUTHOR, $errors) ? 'The author is not valid.<br/>' : '' ?>
        <label for="author">
            Author
        </label>
        <input type="text" id="author" name="author" value="<?= isset($news) ? $news['author'] : '' ?>" />
        <br />
        <?= isset($errors) && in_array(\Entity\News::INVALID_TITLE, $errors) ? 'The title is not valid.<br />' : '' ?>
        <label for="title">
            Title
        </label>
        <input type="text" id="title" name="title" value="<?= isset($news) ? $news['title'] : '' ?>" />
        <br />
        <?= isset($errors) && in_array(\Entity\News::INVALID_CONTENT, $errors) ? 'The content is not valid.<br />' : '' ?>
        <label for="content">
            Content
        </label>
        <textarea name="content" id="content" cols="60" rows="8"><?= isset($news) ? $news['content'] : '' ?></textarea>
        <br />

        <?php
        if (isset($news) && !$news->isNew()) {
            ?>
            <input type="hidden" name="id" value="<?= $news['id'] ?>"/>
            <input type="submit" value="update" name="update" />
            <?php
        } else {
            ?>
            <input type="submit" value="Post">
            <?php
        }
        ?>
    </p>
</form>