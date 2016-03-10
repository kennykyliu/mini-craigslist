<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mini Craigslist</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            padding-top: 60px;
            padding-left: 60px;
        }
        #graph {
            border: solid black 1px;
        }
        #intro {
            color: white;
        }
    </style>
</head>
<body>
    <?php 
        session_start();
        if (!$_SESSION['auth']) {
            header('location:signin.php');
        }
        $username = $_SESSION['username'];
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="newpost.php">Mini Craigslist</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="newpost.php">New</a></li>
                        <li><a href="postlists.php">Posts</a></li>
                    </ul>
                </div>
                <form class="navbar-form pull-right" action="logout.php">
                    <div class="form-group" id="intro">
                            <?php echo "Hi $username&nbsp;&nbsp;"; ?>
                        <button type="submit" class="btn btn-success">Log out</button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="row">
       <?php 
            // Connect to MySQL server
            $DBServer = 'localhost';
            $DBUser = 'lamp';
            $DBPasswd = '1';
            $DBName = 'lamp_final_project';
            $conn = new mysqli($DBServer, $DBUser, $DBPasswd, $DBName);
            if ($conn->connect_error) {
                trigger_error('Database connection failed: ' .  $conn->connect_error, E_USER_ERROR);
            }
            // Look up all posts
            $sql = "SELECT * FROM Posts";
            $rs = $conn->query($sql);
            if ($rs === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            }
            while ($row = $rs->fetch_assoc()) {
                echo "<div class='media'>";
                echo "<div class='media-left'>";
                if (isset($row['Image_1'])) {
                    echo "<img height='100' width='100' src='data:image;base64," . $row['Image_1'] . "'>";
                } elseif (isset($row['Image_2'])) {
                    echo "<img height='100' width='100' src='data:image;base64," . $row['Image_2'] . "'>";
                } elseif (isset($row['Image_3'])) {
                    echo "<img height='100' width='100' src='data:image;base64," . $row['Image_3'] . "'>";
                } elseif (isset($row['Image_4'])) {
                    echo "<img height='100' width='100' src='data:image;base64," . $row['Image_4'] . "'>";
                } else {
                    echo "<img height='100' width='100' src='no_img.png'";
                }
                echo "</div>";
                echo "<div class='media-body'>";
                echo "<h4 class='media-heading'>" . $row['Title'] . "</h4>";
                echo $row['Description'];
                $post_id = $row['Post_ID'];
                echo "<p><a href='postdetails.php?postid=$post_id' class='btn btn-primary' role='button'>View details &raquo;</a></p>";
                echo "</div>";
                echo "</div>";
                echo "<hr color='#eee'>";
            }
            $conn->close();
       ?>
    </div>
</body>
</html>