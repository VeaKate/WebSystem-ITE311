<?= $this->include('templates/header') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
</head>
<body>
    <?php $announcements = session('announcements'); ?>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Date Posted</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($announcements && count($announcements) > 0): ?>
                <?php foreach ($announcements as $announcement): ?>
                    <tr>
                        <td><?= esc($announcement['title']) ?></td>
                        <td><?= esc($announcement['content']) ?></td>
                        <td><?= esc($announcement['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No announcements found.</td>
                </tr>
            <?php endif; ?>

           <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

        </tbody>
    </table>
</body>
</html>