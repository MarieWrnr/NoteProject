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
            <?= htmlspecialchars($note->getBody())?>
          </p>
        <br>
        <form action="" method="post" class="mt-6">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note->getId() ?>">
            <button class="text-sm text-red-500">Delete Note</button>
        </form>

        <footer class="mt-6">
            <a href="/note/edit?id=<?=$note->getId()?>"  class="rounded-md bg-gray-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
        </footer>
    </div>
  </main>
<?php
require  base_path("views/partials/footer.php"); ?>

