<!DOCTYPE html>
<html lang="en">
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
        #submitbtn {
            padding-left: 100px;
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

    <form action="preview.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
        <p><label class="control-label"><strong>Sub-Category:&nbsp;&nbsp;</strong></label>
        <select name="subcat">
                <option>Please select</option>
                <optgroup label="Housing">
                    <option>apts / housing</option>
                    <option>parking / storage</option>
                    <option>rooms wanted</option>
                </optgroup>
                <optgroup label="For sale">
                    <option>appliances</option>
                    <option>books</option>
                    <option>household</option>
                </optgroup>
                <optgroup label="Jobs">
                    <option>education</option>
                    <option>human resources</option>
                    <option>web / info design</option>
                </optgroup>
                </div>
        </select></p>
        </div>
        <div class="form-group">
        <p><label class="control-label"><strong>Location:&nbsp;&nbsp;</strong></label>
        <select name="loc">
            <option>Please select</option>
            <optgroup label="US">
                <option>New York City</option>
                <option>San Jose</option>
                <option>Seattle</option>
            </optgroup>
            <optgroup label="Canada">
                <option>New Brunswick</option>
                <option>Toronto</option>
                <option>Vancouver</option>
            </optgroup>    
            <optgroup label="Europe">
                <option>Frankfurt</option>
                <option>London</option>
                <option>Paris</option>
            </optgroup>
        </select></p>
        </div>
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Title:&nbsp;&nbsp;</strong></label>
                <input type="text" name="title">
            </p>
        </div>
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Price:&nbsp;&nbsp;</strong></label>
                <input type="text" name="price">
            </p>
        </div>    
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Description:&nbsp;&nbsp;</strong></label>
                <textarea rows="4" cols="50" name="desc"></textarea>
            </p>
        </div>  
        <div class="form-group">
            <p>
                <label class="control-label"><strong>I agree with terms and conditions&nbsp;&nbsp;</strong></label>
                <input type="checkbox" name="agree">
            </p>
        </div>    
        </br></br>
        <p>Optional fields:</p>
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Image 1 (max 5 MB):&nbsp;&nbsp;</strong></label>
                <input type="file" name="img1">
            </p>
        </div>
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Image 2 (max 5 MB):&nbsp;&nbsp;</strong></label>
                <input type="file" name="img2">
            </p>
        </div>
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Image 3 (max 5 MB):&nbsp;&nbsp;</strong></label>
                <input type="file" name="img3">
            </p>
        </div>
        <div class="form-group">
            <p>
                <label class="control-label"><strong>Image 4 (max 5 MB):&nbsp;&nbsp;</strong></label>
                <input type="file" name="img4">
            </p>
        </div>
        <br>
        <p  id="submitbtn"><input class="btn btn-primary" type="submit" value="Submit" name="submit">
        <input class="btn btn-default" type="Reset" value="Reset"></p>
    </form>
</body>
</html>
