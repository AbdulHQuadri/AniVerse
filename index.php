<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniVerse</title>
</head>
<body>
    <?php
        require_once('connectdb.php');
        require_once('api_connect.php');

        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $page = $_GET['page'] ?? 1;

        $data = fetchAnimeList($search, $page);
    ?>
    <div class="container">
        <form action="/anime-list" method="get">
            <h1>Anime List</h1>
            <input type="text" placeholder="Please enter a search" name="search">
            <input type="submit" value="Search">
        </form>

        <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="..." alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div> -->
        <?php
            if ($data !== null) {
                $animeList = $data['animeList'];
                $pageInfo = $data['pageInfo'];
            
                // Access the animeList and pageInfo variables here
                // You can perform further processing or render the view
            
                // Example:
                foreach ($animeList as $anime) {
                    // Access anime data
                    $title = $anime['title']['romaji'];
                    $coverImage = $anime['coverImage']['medium'];
            
                    // Perform desired actions with anime data
                    echo "Title: $title<br>";
                    echo "Cover Image: <img src='$coverImage' alt='Cover Image'><br>";
                }
            } else {
                echo 'Failed to retrieve anime data from the API.';
            }
        ?>
        <form method="GET">
            <input type="hidden" name="search" value="<?php echo $variables['search']?>">

            <a href="anime-list.php?search=<?php echo $variables['search']; ?>&page=<?php echo $variables['page'] - 1; ?>" class="btn btn-primary<?php echo ($variables['page'] - 1 < 1) ? ' disabled' : ''; ?>">Previous</a>
            <a href="anime-list.php?search=<?php echo $variables['search']; ?>&page=<?php echo $variables['page'] + 1; ?>" class="btn btn-primary<?php echo ($variables['page'] == $pageInfo['lastPage']) ? ' disabled' : ''; ?>">Next</a>
        </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>