<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css">
    <title>Search - Diwata Yoga</title>
    <style>
        .search-results {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            width: 96%;
        }

        .pose {
            display: flex;
            align-items: center;
            width: 85%;
            margin: 50px 0 0 0 ;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: background-color 0.6s ease-in-out;
        }

        .pose img {
            padding: 10px;
            width: 500px;
            height: 95%;
            margin: 20px;
            border-radius: 5px;
            transition: margin-right 0.5s ease-in-out, transform 0.6s ease-in-out;
        }

        .pose:hover {
            background-color: #1C2735;
            transition: background-color 0.6s ease-in-out;
            border-radius: 20px;
        }

        .pose:hover img{
            transition: margin-right 0.6s ease-in-out, transform 0.6s ease-in-out;
            margin-right: 40px;
            transform: scale(1.1);
            cursor: pointer;
            border-radius: 20px;
        }

        .pose h2 {
            font-size: 1.5em;
            color: #1C2735;
            margin-bottom: 10px;
        }

        .pose:hover h2 {
            color: #45a049;
        }

        .pose p {
            letter-spacing: 1px;
            text-align: justify;
            font-size: 1em;
            color: #333;
            margin: 25px 5px;
        }

        .pose:hover p {
            color: #4CAF50;
        }

        .pose div {
            flex: 1;
        }
    </style>
</head>
<body>

    <!-- nav bar -->
    <header>
        <nav class="sticky-nav">
            <div class="logo">
                <a href="home.html"><img src="logo_diwata_yoga.png" alt="Diwata Yoga Logo"></a>
            </div>
            <ul>
                <li><a href="home.html">HOME</a></li>
                <li><a href="information.html">INFORMATION</a></li>
                <li><a href="search.php" class="active">SEARCH</a></li>
                <li><a href="gallery.html">GALLERY</a></li>
                <li><a href="aboutus.html">ABOUT US</a></li>
            </ul>
        </nav>
    </header>

    <!-- search intro -->
    <div class="search-intro">
        <h1 class="si-header">Search</h1>
        <p>Discover the Essence: Search Through Our Yoga Sessions and Events.</p>
        <div class="search-button">
            <form action="search.php" method="GET">
                <input type="text" name="search" placeholder="Search for yoga poses...">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="search-results">
        <?php
        if (isset($_GET['search'])) {
            $query = strtolower($_GET['search']);
            $xml = simplexml_load_file('poses.xml');
            $results = [];

            foreach ($xml->pose as $pose) {
                if (strpos(strtolower($pose->name), $query) !== false) {
                    $results[] = $pose;
                }
            }

            if ($results) {
                foreach ($results as $pose) {
                    echo '<div class="pose">';
                    echo '<a href="' . $pose->image . '" target="_blank"><img src="' . $pose->image . '" alt="' . $pose->name . '"></a>';
                    echo '<div class="pose-details">';
                    echo '<h2>' . $pose->name . '</h2>';
                    echo '<p>' . $pose->description . '</p>';
                    echo '<p>Benefits: ' . $pose->benefits . '</p>';
                    echo '<p>Difficulty: ' . $pose->difficulty . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No results found.</p>';
            }
        }
        ?>
    </div>

</body>
</html>
