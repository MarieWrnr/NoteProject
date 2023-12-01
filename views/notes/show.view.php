<?php
 require base_path("views/partials/head.php");
 require base_path("views/partials/nav.php");
 require base_path("views/partials/banner.php");
 ?>
<main xmlns="http://www.w3.org/1999/html">
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 underline ">Back</a>
        </p>
          <p>
            <?= htmlspecialchars($note['body'])?>
          </p>
        <br>

        <form action="" method="post" class="mt-6">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['noteid'] ?>">
            <button class="text-sm text-red-500">Delete Note</button>
        </form>
    </div>
  </main>
<?php
require  base_path("views/partials/footer.php"); ?>

