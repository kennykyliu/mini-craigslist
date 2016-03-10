<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        #results {
            font-size: 16px;

        }
        #img-show {
            padding: 30px;
    	    margin: 0 auto;
        }
        #pre-back-btn {
            padding-left: 100px;
        }
        #back-btn {
            max-width: 210px;
        }
    </style>
    <?php 
        if (isset($_POST['submit'])) {
            header('location:postlists.php');
        }
    ?>
</head>
<body>
    <?php
        session_start();
        $username = $_SESSION['username'];
        $post_id = $_GET['postid'];
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
        $sql = "SELECT * FROM Posts JOIN SubCategory JOIN Category JOIN Location JOIN Region ON Post_ID=" . $post_id . " AND Posts.SubCategory_ID=SubCategory.SubCategory_ID AND SubCategory.Category_ID=Category.Category_ID AND Posts.Location_ID=Location.Location_ID AND Location.Region_ID=Region.Region_ID";
        $rs = $conn->query($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }
        $row = $rs->fetch_assoc();
    ?>  

        <div class="container" id="img-show">
        <div class="row">
            <?php 
                if (isset($row['Image_1'])) {
                    echo '<div class="col-xs-3">';
                    echo '<a href="#" class="thumbnail">';
                    echo "<img height='300' width='300' src='data:image;base64," . $row['Image_1'] . "'>";
                    echo '</a>';
                    echo '</div>';
                }
                if (isset($row['Image_2'])) {
                    echo '<div class="col-xs-3">';
                    echo '<a href="#" class="thumbnail">';
                    echo "<img height='300' width='300' src='data:image;base64," . $row['Image_2'] . "'>";
                    echo '</a>';
                    echo '</div>';
                }
                if (isset($row['Image_3'])) {
                    echo '<div class="col-xs-3">';
                    echo '<a href="#" class="thumbnail">';
                    echo "<img height='300' width='300' src='data:image;base64," . $row['Image_3'] . "'>";
                    echo '</a>';
                    echo '</div>';
                }
                if (isset($row['Image_4'])) {
                    echo '<div class="col-xs-3">';
                    echo '<a href="#" class="thumbnail">';
                    echo "<img height='300' width='300' src='data:image;base64," . $row['Image_4'] . "'>";
                    echo '</a>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>    
        
    <?php
        echo "<div class='container' id='results'>";
        echo '<dl class="dl-horizontal">';
        echo "<dt>Author</dt>";
        echo "<dd>" . $username . "</dd>";
        echo "<dt>Category</dt>";
        echo "<dd>" . $row['CategoryName'] . " / " . $row['SubCategoryName'] . "</dd>";
        echo "<dt>Location</dt>";
        echo "<dd>" . $row['RegionName'] . " / " . $row['LocationName'] . "</dd>";
        echo "<dt>Title</dt>";
        echo "<dd>" . $row['Title'] . "</dd>";
        echo "<dt>Price</dt>";
        echo "<dd>" . $row['Price'] . "</dd>";
        echo "<dt>Email</dt>";
        echo "<dd>" . $row['Email'] . "</dd>";
        echo "<dt>Description</dt>";
        echo "<dd>" . $row['Description'] . "</dd>";
        echo "<dt>Post time</dt>";
        echo "<dd>" . $row['TimeStamp'] . "</dd>";
        echo "</dl>";
        echo "<div id='pre-back-btn'>";
        echo "<form method='POST'>";
        echo "<input type='submit' class='btn btn-primary btn-block' id='back-btn'  value='Back' name='submit'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        
        $conn->close();
    ?>
</body>
</html>