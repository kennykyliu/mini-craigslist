<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php 
        // Get post data from xml file
        $file = "postdata.xml";
        $xml = simplexml_load_file($file);
        $title = $xml->title;
        $price = $xml->price;
        $desc = $xml->desc;
        $email = $xml->email;
        $subcat = $xml->subcat_id;
        $loc = $xml->loc_id;

        // Connect to MySQL server
        $DBServer = 'localhost';
        $DBUser = 'kenny';
        $DBPasswd = 'ilikemysql';
        $DBName = 'miniCraigsList';
        $conn = new mysqli($DBServer, $DBUser, $DBPasswd, $DBName);
        if ($conn->connect_error) {
            trigger_error('Database connection failed: ' .  $conn->connect_error, E_USER_ERROR);
        }

        // Look up SubCategory_ID by Subcategory name
        $sql = "SELECT SubCategory_ID FROM SubCategory WHERE SubcategoryName = '$subcat'";
        $rs = $conn->query($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }
        $rows_returned = $rs->num_rows;
        $rs->data_seek(0);
        $row = $rs->fetch_row();
        $subcat_id = $row[0];

        // Look up Location_ID by Location name
        $sql = "SELECT Location_ID FROM Location WHERE LocationName = '$loc'";
        $rs = $conn->query($sql);
        if ($rs === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        }
        $rows_returned = $rs->num_rows;
        $rs->data_seek(0);
        $row = $rs->fetch_row();
        $loc_id = $row[0];

        // Insert data
        $price_int = (int)$price;
        $sql = "INSERT INTO Posts (Title, Price, Description, Email, Agreement, SubCategory_ID, Location_ID";
        // Handle images
        if (isset($xml->img1)) {
            $sql .= ", Image_1";
        }
        if (isset($xml->img2)) {
            $sql .= ", Image_2";
        }
        if (isset($xml->img3)) {
            $sql .= ", Image_3";
        }
        if (isset($xml->img4)) {
            $sql .= ", Image_4";
        }
        $sql .= ") VALUES ('$title', $price_int, '$desc', '$email', 1, '$subcat_id', '$loc_id'";
        // Handle images
        if (isset($xml->img1)) {
            $img1 = $xml->img1;
            $sql .= ", '$img1'";
        }
        if (isset($xml->img2)) {
            $img2 = $xml->img2;
            $sql .= ", '$img2'";
        }
        if (isset($xml->img3)) {
            $img3 = $xml->img3;
            $sql .= ", '$img3'";
        }
        if (isset($xml->img4)) {
            $img4 = $xml->img4;
            $sql .= ", '$img4'";
        }        
        $sql .= ");";
        if ($conn->query($sql) === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
        } else {
            $last_inserted_id = $conn->insert_id;
            $affected_rows = $conn->affected_rows;
        }
        
        // Close MySQL connection
        $conn->close();
        
        // Remove data from xml file
        unset($xml->title);
        unset($xml->price);
        unset($xml->desc);
        unset($xml->email);
        unset($xml->subcat_id);
        unset($xml->loc_id);
        if (isset($xml->img1)) {
            unset($xml->img1);
        }
        if (isset($xml->img2)) {
            unset($xml->img2);
        }
        if (isset($xml->img3)) {
            unset($xml->img3);
        }
        if (isset($xml->img4)) {
            unset($xml->img4);
        }
        $xml->asXML('postdata.xml');
        
        // Redirect page to postlists.php
        header('location:postlists.php');
    ?>
</body>
</html>
