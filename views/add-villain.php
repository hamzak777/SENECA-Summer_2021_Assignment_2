<?php require_once 'templates/header.tpl.php'; ?>
  <div class="container">
    <h2><span class="fa fa-plus"></span> Add Villain</a></h2>
    <?php if (isset($_GET['add']) && $_GET['add'] == 'error'): ?>
    <div class="error"><span class="fa fa-exclamation-triangle"></span> Sorry, we need more information about this Villain!</div>
    <?php endif; ?>
    <!--
    First we will set up the ability to create new Villains by making a form which will accept new Villain data
    Our action will point to a separate PHP file which will process adding the Villain
    -->
    <form action="../controllers/routes.php?action=create" method="post">
      <label for="name">Name:</label>
      <input type="text" name="name" value="" id="name">

      <label for="alias">Alias:</label>
      <input type="text" name="alias" value="" id="alias">

      <label for="introduction">Introduction:</label>
      <input type="text" name="introduction" value="" id="introduction">

      <label for="image">Image:</label>
      <select name="image" id="image">
        <option value="the_joker.jpg">The Joker</option>
        <option value="harley_quinn.jpg">Harley Quinn</option>
        <option value="the_riddler.jpg">The Riddler</option>
        <option value="penguin.jpg">Penguin</option>
        <option value="mad_hatter.jpg">Mad Hatter</option>
        <option value="killer_croc.jpg">Killer Croc</option>
        <option value="bane.jpg">Bane</option>
        <option value="calendar_man.jpg">Calendar Man</option>
        <option value="mr_freeze.jpg">Mr. Freeze</option>
        <option value="deathstroke.jpg">Deathstroke</option>
        <option value="deadshot.jpg">Deadshot</option>
        <option value="black_mask.jpg">Black Mask</option>
        <option value="copperhead.jpg">Copperhead</option>
        <option value="electrocutioner.jpg">Electrocutioner</option>
        <option value="firefly.jpg">Firefly</option>
        <option value="shiva.jpg">Shiva</option>
        <option value="bird.jpg">Bird</option>
        <option value="anarky.jpg">Anarky</option>
        <option value="scarecrow.jpg">Scarecrow</option>
        <option value="scarface.jpg">Scarface</option>
        <option value="poison_ivy.jpg">Poison Ivy</option>
        <option value="victor_zsasz.jpg">Victor Zsasz</option>
        <option value="clayface.jpg">Clayface</option>
        <option value="hugo_strange.jpg">Hugo Strange</option>
        <option value="two_face.jpg">Two-Face</option>
        <option value="ras_al_ghul.jpg">Ra's al Ghul</option>
        <option value="hush.jpg">Hush</option>
        <option value="azrael.jpg">Azrael</option>
        <option value="solomon_grundy.jpg">Solomon Grundy</option>
        <option value="talia_al_ghul.jpg">Talia al Ghul</option>
        <option value="professor_pyg.jpg">Professor Pyg</option>
        <option value="deacon_blackfire.jpg">Deacon Blackfire</option>
        <option value="man_bat.jpg">Man-Bat</option>
      </select>

      <button type="submit"><span class="fa fa-plus"></span> Add Villain</button>
    </form>
  </div>
<?php require_once 'templates/footer.tpl.php'; ?>
