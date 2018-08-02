<p style="text-align: center">There is <?= $nbNews ?> news at the moment. There is the list : </p>
<table>
    <tr>
        <th>Author</th>
        <th>Title</th>
        <th>Date of post</th>
        <th>Last update</th>
        <th>Action</th>
    </tr>
    <?php
    foreach($listNews as $news) {
        echo '<tr><td>' . $news['author'] . '</td><td>'. $news['title'] . '</td><td>' . $news['dateAdd']->format('d/m/Y \a\t H\hi') .'</td><td>' . $news['dateEdit']->format('d/m/Y \a\t H\hi') . '</td><td><a href="news-update-' . $news['id'] . '.html"><img src="/images/update.png" alt="Edit"></a></td><td><a href="news-delete-' . $news['id'] . '.html"><img src="/images/delete.png" alt="Delete"></a></td></tr><br />';
    }
    ?>
</table>