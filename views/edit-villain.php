<?php
require_once 'templates/header.tpl.php';

$id = $_GET['id'];
$controller = new villainController;
$villains = $controller->read();

foreach ($villains as $villain_num => $villain_row):
  if ($villain_row['id'] == $id):
    $this_villain = $villain_row['object'];
  endif;
endforeach;
?>
  <div class="container">
    <h2><span class="fa fa-edit"></span> Edit <?php echo $this_villain->name; ?></h2>
    <?php if (isset($_GET['edit']) && $_GET['edit'] == 'error'): ?>
    <div class="error"><span class="fa fa-exclamation-triangle"></span> Sorry, we need more information about this villain!</div>
    <?php endif; ?>
    <!--
    The form in this file will have an action which will point to a separate PHP file which will process editing the villain
    -->
    <form action="../controllers/routes.php?action=update" method="post">
      <input type="hidden" name="id" value="<?php echo $id ?>">

      <label for="name">Name:</label>
      <input type="text" name="name" value="<?php echo $this_villain->name; ?>" id="name">

      <label for="alias">Alias:</label>
      <input type="text" name="alias" value="<?php echo $this_villain->alias; ?>" id="alias">

      <label for="introduction">Introduction:</label>
      <input type="text" name="introduction" value="<?php echo $this_villain->introduction; ?>" id="introduction">

      <label for="image" class="input-group-text">Image:</label>
      <!--
      Check if this villain's image is the same as the select option and if so, set that option to selected
      -->
      <select class="form-control" name="image" id="image">
        <option value="the_joker.jpg" <?php if ('the_joker.jpg' == $this_villain->image): echo 'selected'; endif; ?>>The Joker</option>
        <option value="harley_quinn.jpg" <?php if ('harley_quinn.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Harley Quinn</option>
        <option value="the_riddler.jpg" <?php if ('the_riddler.jpg' == $this_villain->image): echo 'selected'; endif; ?>>The Riddler</option>
        <option value="penguin.jpg" <?php if ('penguin.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Penguin</option>
        <option value="mad_hatter.jpg" <?php if ('mad_hatter.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Mad Hatter</option>
        <option value="killer_croc.jpg" <?php if ('killer_croc.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Killer Croc</option>
        <option value="bane.jpg" <?php if ('bane.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Bane</option>
        <option value="calendar_man.jpg" <?php if ('calendar_man.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Calendar Man</option>
        <option value="mr_freeze.jpg" <?php if ('mr_freeze.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Mr. Freeze</option>
        <option value="deathstroke.jpg" <?php if ('deathstroke.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Deathstroke</option>
        <option value="deadshot.jpg" <?php if ('deadshot.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Deadshot</option>
        <option value="black_mask.jpg" <?php if ('black_mask.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Black Mask</option>
        <option value="copperhead.jpg" <?php if ('copperhead.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Copperhead</option>
        <option value="electrocutioner.jpg" <?php if ('electrocutioner.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Electrocutioner</option>
        <option value="firefly.jpg" <?php if ('firefly.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Firefly</option>
        <option value="shiva.jpg" <?php if ('shiva.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Shiva</option>
        <option value="bird.jpg" <?php if ('bird.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Bird</option>
        <option value="anarky.jpg" <?php if ('anarky.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Anarky</option>
        <option value="scarecrow.jpg" <?php if ('scarecrow.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Scarecrow</option>
        <option value="scarface.jpg" <?php if ('scarface.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Scarface</option>
        <option value="poison_ivy.jpg" <?php if ('poison_ivy.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Poison Ivy</option>
        <option value="victor_zsasz.jpg" <?php if ('victor_zsasz.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Victor Zsasz</option>
        <option value="clayface.jpg" <?php if ('clayface.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Clayface</option>
        <option value="hugo_strange.jpg" <?php if ('hugo_strange.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Hugo Strange</option>
        <option value="two_face.jpg" <?php if ('two_face.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Two-Face</option>
        <option value="ras_al_ghul.jpg" <?php if ('ras_al_ghul.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Ra's al Ghul</option>
        <option value="hush.jpg" <?php if ('hush.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Hush</option>
        <option value="azrael.jpg" <?php if ('azrael.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Azrael</option>
        <option value="solomon_grundy.jpg" <?php if ('solomon_grundy.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Solomon Grundy</option>
        <option value="talia_al_ghul.jpg" <?php if ('talia_al_ghul.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Talia al Ghul</option>
        <option value="professor_pyg.jpg" <?php if ('professor_pyg.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Professor Pyg</option>
        <option value="deacon_blackfire.jpg" <?php if ('deacon_blackfire.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Deacon Blackfire</option>
        <option value="man_bat.jpg" <?php if ('man_bat.jpg' == $this_villain->image): echo 'selected'; endif; ?>>Man-Bat</option>
      </select>
      <button type="submit"><span class="fa fa-edit"></span> Edit villain</button>
    </form>
  </div>
<?php require_once 'templates/footer.tpl.php'; ?>
