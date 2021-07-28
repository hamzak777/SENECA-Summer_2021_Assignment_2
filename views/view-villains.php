<?php 
  require 'templates/header.tpl.php'; 
  //require '../utilities/Sanitizer.php';
?>
  <div class="container">
    <h2 class="text-center"><span class="fa fa-eye"></span> View Villains</h2>
    <?php if (isset($_GET['add']) && $_GET['add'] == 'success'): ?>
    <div class="success"><span class="fa fa-check"></span> Villain successfullly added! [ Not hard in a place like Gotham ]</div>
    <?php elseif (isset($_GET['edit']) && $_GET['edit'] == 'success'): ?>
    <div class="success"><span class="fa fa-check"></span> Villain successfullly edited! [ Is the asylum actualy working? ]</div>
    <?php elseif (isset($_GET['delete']) && $_GET['delete'] == 'success'): ?>
    <div class="success"><span class="fa fa-check"></span> Villain successfullly deleted! [ If only it was this easy ]</div>
    <?php elseif (isset($_GET['delete']) && $_GET['delete'] == 'error'): ?>
    <div class="error"><span class="fa fa-alert"></span> Problem deleting Villain! [ What a surprise :| ]</div>
    <?php endif; ?>
    
    <div class="grid">
      <?php
      $controller = new villainController;
      $villains = $controller->read();

      foreach ($villains as $villain_num => $villain_row):
        $villain = $villain_row['object'];
        $id = $villain_row['id'];
        $intro =Sanitizer::escape_html($villain->introduction);
        ?>
        <div class="villain">
          <h2><?php echo $villain->name; ?></h2>
          <h3>Alias: <?php echo $villain->alias; ?></h3>
          <h3>Introduction: <?php echo $intro; ?></h3>
          <p><img src="../views/img/<?php echo $villain->image; ?>" alt="<?php echo $villain->name; ?>"></p>
          <!-- 
          Finally in order to delete villains, it is necessary to create a form in our loop.
          This form's action will point to our routes file which will call the delete() method of the controller.
          -->
          <form action="../controllers/routes.php?action=delete" method="post">
            <!--
            We also want the user to be able to update villain data.
            In order to do this we will link to edit-villain.php and add a $_GET key for the villain ID.

            This link is only in the form, for CSS styling purposes. For functional purposes, it could be outside of the form.
            -->
            <a href="edit-villain.php?id=<?php echo $id; ?>" class="button"><span class="fa fa-edit"></span> Edit</a>
            <!-- 
            Inside of this form, we need to inside a hidden input to send our villain ID to the delete method.
            -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- 
            We also need a button with type="submit" to submit the form and delete our villain.
            -->
            <button type="submit"><span class="fa fa-trash"></span> Delete</button>
          </form>
        </div>
        <?php
      endforeach;
      ?>
    </div>
  </div>
<?php require 'templates/footer.tpl.php'; ?>
