<?php
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userRank = $_POST["Rank"];
    $userGender = $_POST["gender"]; // Ensure it matches the form input name

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM college WHERE Rank BETWEEN :minRank AND :maxRank AND GENDER = :Gender";
        $stmt = $pdo->prepare($query);
        $minRank = $userRank - 2000;
        $maxRank = $userRank + 3000;
        $stmt->bindParam(":minRank", $minRank, PDO::PARAM_INT);
        $stmt->bindParam(":maxRank", $maxRank, PDO::PARAM_INT);
        $stmt->bindParam(":Gender", $userGender, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>replit</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li>
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">Blogs</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            More College Predictor
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">JEE MAINS College Predictor</a></li>
                            <li><a class="dropdown-item" href="#">JEE Advance College Predictor</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="#">Neet-UG College Predictor</a></li>
                            <li><a class="dropdown-item" href="#">Neet-PG College Predictor</a></li>
                            <li><a class="dropdown-item" href="#">Neet-BDS College Predictor</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="#">CAT College Predictor</a></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="#">BBA College Predictor</a></li>
                            <li><a class="dropdown-item" href="#">BBA-LLB College Predictor</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container row m-auto justify-content-center">
        <div id="banner" class="banner" data-ride="carousel">
            <img class="d-block w-100" src="p3.jpg" alt="First slide">
        </div>

        <h1 id="heading">2023 JoSAA Cutoffs DATA</h1>

        <form id="inp" method="post" action="">
            <div class="inpu">
                <label for="Rank">Rank:</label>
                <input type="text" id="Rank" name="Rank"><br>
            </div>

            <div class="inpu">
                <label for="Gender">Gender:</label>
                <input type="radio" id="neutral" name="gender" value="Neutral">
                <label for="neutral">Neutral</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label><br>
            </div>

            <div class="inpu" id="subButton">
                <br><br>
                <button type="submit" class="btn btn-primary btn-lg" style="float: right;">submit</button>
            </div>
        </form>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table class="table" style="text-align: center;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">college</th>
                <th scope="col">branch</th>
                <th scope="col">last year cut-off rank</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($results)) {
                echo "<p>No results!</p>";
            } else {
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["College"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Branch"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Rank"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["GENDER"]) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>