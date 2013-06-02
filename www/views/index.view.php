<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>SmtpCatcher</title>
  </head>
  <body>
    <?php foreach ($emails as $timestamp => $data): ?>
    <div>
        <h3><?php echo date('l jS \of F Y h:i:s A', $timestamp); ?> - To: <?php echo $data['to']; ?>, Subject: <?php echo $data['subject']; ?></h3>
        <p>
        <?php echo $data['message']; ?>
        </p>
            <p><a href="raw.php?id=<?php echo $timestamp; ?>">View Raw</a></p>
    </div>
    <?php endforeach; ?>
  </body>
</html>
