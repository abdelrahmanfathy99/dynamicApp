<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6"><a href="/notes" class="text-blue-500 underline">Go Back...</a></p>
        <p><?= htmlspecialchars($note['body']); ?></p>

        <div class="flex mt-6">
            <footer class="">
                <a href="/note/edit?id=<?= $note['id'] ?>" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
            </footer>

            <form class="mx-4" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id']; ?>">
                <button class="text-sm text-red-500">Delete</button>
            </form>
        </div>
    </div>
</main>

<?php require base_path("views/partials/footer.php"); ?>