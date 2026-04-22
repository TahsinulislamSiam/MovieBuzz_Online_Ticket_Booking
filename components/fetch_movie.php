<div class="dashboard-movies">
    <div class="heading">
        <h1>active movies</h1>
    </div>

    <div class="box-container">
        <?php
            $select_movies = $conn->prepare("SELECT * FROM `movies`");
            $select_movies->execute();

            if ($select_movies->rowCount() > 0) {
                while ($fetch_movies = $select_movies->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <form action="" method="post" class="box">
            <div class="img-box">
                <img src="../uploaded_files/thumbnails/<?= htmlspecialchars($fetch_movies['thumbnails']); ?>">
            </div>

            <h3><?= $fetch_movies['title']; ?></h3>

            <div>
                <a href="<?= $fetch_movies['trailers_url']; ?>" class="bx bx-play btn"></a>
                <a href="read_movie.php?get_id=<?= $fetch_movies['id']; ?>" class="bx bxs-show btn"></a>
            </div>
        </form>

        <?php
                }
            } else {
                echo '
                <div class="empty">
                    <p>no movie added yet!</p>
                </div>
                ';
            }
        ?>
    </div>
</div>