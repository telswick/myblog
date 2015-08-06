<?php
/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/27/2015
 * Time: 9:15 PM
 */

/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/23/2015
 * Time: 7:46 PM
 */

// Implement post insertion
//    - FRONT END:
//    - create edit_post.php
//    - form with a text box for title/author, a huge text box for the post body,
//      and a submit button
//    - a heading "Create Post" or similar
//    - some text describing how to write a post

//    - BACK END:
//    - check if form was submitted
//    - grab values from the text fields
//    - input validation - make sure all fields were filled out
//    - insert a new row into the database



include 'db_info.php';


// in the database named blog with tables called posts and tags
// include database connection stuff in db_info.php
// could use require_once instead (but remember parentheses)
// can't include the same file twice if you use require_once

// below, probably don't want "date" to be a user input from the form


?>


<h1>Welcome to Traci's blog</h1>
<br>
<?php
// do this if the id variable has value, coming from index.php page
if (isset($_GET['id'])) {

    $sql = $db->prepare("SELECT title, author, contents FROM posts WHERE id = ?");
    // How to search both title and contents?


    // $search_term = "%" . $_GET['searchBox'] . "%";
    $editid = $_GET['id'];
    $sql->bind_param("i", $editid);
    $sql->execute();

    $sql->bind_result($title, $author, $contents);
    $sql->fetch();

// have gotten data and filled in variables


    ?>
    <h2>Ok, so you want to edit your blog post</h2>
    <form action="edit_post.php"
          method="POST">
        Edit your blog post....<br>
        <input style="background-color:blanchedalmond" type="text" name="title" placeholder="Title your post"
               value="<?php echo "$title"; ?>"><br><br>
        <input style="background-color:blanchedalmond" type="text" name="author" placeholder="Who are you?"
        value = "<?php echo "$author"; ?>"><br><br>

    <textarea style="background-color:lightblue" name="contents"
              rows="20" cols="80" onclick="this.innerHTML=''">
        <?php echo $contents; ?></textarea><br><br>
        <input type="submit" name="submit" value="Submit Blog Post"><br>

    </form>




<?php
    } else {


    ?>
    <h2>Ok, go ahead and write about anything</h2>
    <form action="edit_post.php"
          method="POST">
        Enter your blog post....<br>
        <input style="background-color:blanchedalmond" type="text" name="title" placeholder="Title your post"><br><br>
        <input style="background-color:blanchedalmond" type="text" name="author" placeholder="Who are you?"><br><br>

    <textarea style="background-color:lightblue" name="contents"
              rows="20" cols="80" onclick="this.innerHTML=''">
        Write something!</textarea><br><br>
        <input type="submit" name="submit" value="Submit Blog Post"><br>

    </form>

<?php

}

// placeholder is like value, but it disappears


    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $mydate = date("d F Y H:i:s");

        //echo $mydate;
        $contents = $_POST['contents'];

        $error = "";

        if ($title == "") {
            $error .= "You forgot to add a title!<br>";
            // echo $error;

        } else if ($author == "") {
            $error .= "You forgot to put your name!<br>";
            // echo $error;
        } else if ($contents == "" || $contents == "Write something!") {
            $error .= "So what did you want to write in your blog post...?  Hello, are you still there?<br>";
            // echo $error;
        }

        // if ANYTHING set an error, don't insert the post

        if ($error != "") {
            // just print out the error and don't make the post
            echo $error;
        } else {
            // We are good to make the post


// do some input validation above here
// use if statements to check if all of the fields are filled out, if not
//  display a message on page like "you forgot ..."
// copying from hw8, todo_list

            $stmt = $db->prepare("INSERT INTO posts (title, author, date, contents) VALUES (?, ?, ?, ?)");
            echo $db->error;

// if (!isset($_SESSION['list'])) {
//     $_SESSION['list'] = array();
// }
// if (isset($_POST['submit'])) {
            // add the text in 'todo'
            // to the SESSION variable 'list'
            // array_push($_SESSION['list'],
            //            $_POST['todo']);
            //$stmt = $db->prepare("INSERT INTO todo_list ('item', 'assigndate') VALUES (?, ?)");
            //$stmt = $db->prepare("INSERT INTO todo_list (item) VALUES (?)");


            // echo "Timestamp = " . $mydate;
            $stmt->bind_param("ssss", $title, $author, $mydate, $contents);
            // $stmt->close();

//actually run statement with the parameters we've substituted, how to add a row

            $stmt->execute();
        }
    }





    ?>

    <br>
    <br>
    You have successfully submitted your post!!!!!!
    <br>
    <br>
    Now you can look at all of the posts:
    <a href="index.php">Go to the index page</a>

    <br>
    <br>

