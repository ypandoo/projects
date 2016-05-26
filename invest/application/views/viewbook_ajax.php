<div class="container" style="width:auto;">
  <div class="row">
    <div class="col-md-12 alert alert-success">
      <?php foreach($bookinfo as $book_info){?>
      <h3>Book Title:<?php echo $book_info['Title']; ?> </h3>
      <strong>Author: <?php echo $book_info['email']; ?></strong>
      <?php } ?>
    </div>
  </div>

</div>
