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



require_once('db_info.php');


// in the database named blog with tables called posts and tags
// include database connection stuff in db_info.php
// could use require_once instead (but remember parentheses)
// can't include the same file twice if you use require_once

// below, probably don't want "date" to be a user input from the form


?>


<h1>Welcome to Traci's blog</h1>
<br>
<?php


// Going back to the basics, delete option to show alternate form input for edit post


$editid = "NULL";
if (isset($_GET['id']))  {
    $editid = $_GET['id'];
}

echo "edit id = $editid";

// if (isset($_POST['submit']))  {
// if($_GET['id'] == "NULL")  {
// if ($id == "NULL")   {
        // id was NULL
        // it's a new post
        // still new because there is nothing in $_GET['id'] from the index page
        // your existing logic for inserting a new post goes here.
        // hum can't be || above because it does new post even with id not NULL
        //------------------------------------------------------------------//
        // Copying all logic for brand new post here                        //
        // this is the if for submitting a new (not edited) post
        // try moving form section to the end of this if for a new (not edited) post


    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $mydate = date("d F Y H:i:s");
        $contents = $_POST['contents'];
        $editid = $_POST['id'];       // Adding this line fixed my edit/replace problem

        $error = "";

        if ($title == "") {
            $error .= "You forgot to add a title!<br>";

        } else if ($author == "") {
            $error .= "You forgot to put your name!<br>";

        } else if ($contents == "" || $contents == "Write something!") {
            $error .= "So what did you want to write in your blog post...?  Hello, are you still there?<br>";
        }

        // if ANYTHING set an error, don't insert the post

        if ($error != "") {
            // just print out the error and don't make the post
            echo $error;
        } else {
            // We are good to make the post
        }


// do some input validation above here
// use if statements to check if all of the fields are filled out, if not
// display a message on page like "you forgot ..."
// now below check status of $id

        echo "good to make post";

        if ($editid == "NULL") {

            echo "Should be in the if for new post: $editid";

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
            $stmt->bind_param("ssss", $title, $author, $mydate, $contents);
            $stmt->execute();
            header('Location: http://10.10.10.60/myblog/index.php'); /* Redirect browser */

        }  // this closes if for new post

// in below section, instead of having user click on a link
// go straight back to index page using header ??
// and do the same for after editing a post
        // <br>
        // <br>
        // Get rid of this, maybe messing up update post function?
        // Now you can look at all of the posts:
        // <a href="index.php">Go to the index page</a>
        // <br>
        // <br>
        // Above is logic for brand new post
        //------------------------------------------------------------------
        // Below is logic for editing a post


        if ($editid != "NULL") {
            // id was not NULL
            // this is an existing post
            // update it.
            // so there is something in the $_GET['id'] url
            // coming from the index page
            // UPDATE posts SET title = ?, author = ?, contents = ?
            // WHERE id = ?

            echo "should be in the elseif for edit; $editid";

            $update = $db->prepare("UPDATE posts SET title = ?, author = ?,  date = ?, contents = ? WHERE id = ?");
            echo $db->error;

            $update->bind_param("ssssi", $title, $author, $mydate, $contents, $editid);
            $update->execute();

            header('Location: http://10.10.10.60/myblog/index.php'); /* Redirect browser */
            // exit();

        }   // this closes else for editing a post

    }  // closes if for isset($_POST['submit'])


?>
    <h2>Ok, go ahead and write about anything</h2>
    <form action="edit_post.php"
          method="POST">
        Enter your blog post....<br>
        <input style="background-color:blanchedalmond" type="text" name="title" placeholder="Title your post"><br><br>
        <input style="background-color:blanchedalmond" type="text" name="author" placeholder="Who are you?"><br><br>

        <input type="hidden" name="id" value="<?php   echo $editid;  ?>">

            <textarea style="background-color:lightblue" name="contents"
                      rows="20" cols="80" onclick="this.innerHTML=''">
                      Write something!
            </textarea><br><br>
        <input type="submit" name="submit" value="Submit Blog Post"><br>

    </form>



    <?php

    // Everything below commented out

    //------------------------------------------------------------------//
    // Copying all logic for doing an edit post with alternate submit button//
    // called editsubmit and different form text
    // need to bring the variables in the post to be edited from the index page

    // Why is the stuff below even there at all? comment out next 6 lines

    // echo "id is $id";

    // $sql = $db->prepare("SELECT title, author, contents FROM posts WHERE id = ?");
    // $id = $_GET['id'];
    // $sql->bind_param("i", $id);
    // $sql->execute();

    // maybe I need to reference the carried over variables from index, with the _GET
    // instead of bind_result and fetch
    // hmmmm, now title, author and contents are undefined
    // $edittitle = $_GET['title'];
    // $editauthor = $_GET['author'];
    // $editcontents = $_GET['contents'];
    // just doing below so I can change form to edit version
    // and show the user what they are editing

    // $sql->bind_result($edittitle, $editauthor, $editcontents);
    // $sql->fetch();
    // $sql->close();


    // header("Location: http://10.10.10.60/myblog/index.php"); /* Redirect browser */
    // exit();
    // removing form section below to end of file
    // removing form section above to end of file
    // $url = "http://10.10.10.60/myblog/index.php";
    // echo
    // header("Location: http://10.10.10.60/myblog/index.php"); /* Redirect browser */
    // exit();
    // Insert copy of php code that stores blog posts, except use Update instead and only change the
    // one post with id selected
    // add code to redirect to index page after post editsubmit but

    // echo "id is still: $id";

    // ????? getting to this point even when $id is NULL, and showing edit post form again after submitedit clicked

    // not getting the following if to execute
    // now we're just circling back to another editpost form after clicking editsubmit button and id becomes NULL
    // and if id is NULL shouldn't even be in edit section

    // if (isset($_POST['editsubmit'])  && $id != "NULL" ) {
    //     $postedittitle = $_POST['edittitle'];
    //     $posteditauthor = $_POST['editauthor'];
    //     $mydate = date("d F Y H:i:s");
    //     $posteditcontents = $_POST['editcontents'];

    //     echo $postedittitle;
    //     echo $posteditauthor;
    //     echo $posteditcontents;

    //     echo "id is: $id after editsubmit, before input val";

        // input validation next

    //     $error = "";

    //     if ($postedittitle == "") {
    //         $error .= "You forgot to add a title!<br>";
            // echo $error;
    //         }
    //     else if ($posteditauthor == "") {
    //         $error .= "You forgot to put your name!<br>";
            // echo $error;
    //         }
    //     else if ($posteditcontents == "" || $posteditcontents == "Write something!") {
    //         $error .= "So what did you want to write in your blog post...?  Hello, are you still there?<br>";
            // echo $error;
    //         }

        // if ANYTHING set an error, don't insert the post

    //     if ($error != "") {
            // just print out the error and don't make the post
    //         echo $error;
    //     } else {
            // We are good to make the post


            // do some input validation above here
            // use if statements to check if all of the fields are filled out, if not
            // display a message on page like "you forgot ..."
            // copying from hw8, todo_list
            // Here we are working on submitting an edited blog post, update only the post whose id has
            // come over in the url from the index.php page when VIEW/EDIT button is clicked
            //$stmt = $db->prepare("UPDATE posts  WHERE ");
            //OK try what Matt suggests to make it easier than using UPDATE
            //plug in from the get variable
            //go back to using UPDATE posts
            // header("Location: http://10.10.10.60/myblog/index.php"); /* Redirect browser */
            // exit();
            // header("Location: http://10.10.10.60/myblog/index.php"); /* Redirect browser */

    //         echo "id is now: $id after postedit submit and input val";   // doesn't seem to be getting to this point

    //         $update = $db->prepare("UPDATE posts SET title = ?, author = ?,  date = ?, contents = ?
    //                 WHERE id = ?");
    //         echo $db->error;

    //         $update->bind_param("ssssi", $postedittitle, $posteditauthor, $mydate, $posteditcontents, $id);
    //         $update->execute();

    //         header('Location: http://10.10.10.60/myblog/index.php'); /* Redirect browser */
    //         exit();

            // above code is still not working to submit an edited post and go to index immediately
            // maybe problem is in my index.php and not showing differing values in the table
            // i.e. postedit variables, no that shouldn't matter because it's going
            // through the sql database
            // exit();
            // $url = "http://10.10.10.60/myblog/ndex.php";
            // desperate so try javascript


    //     }   // closes else for we are ready to make an edited post

    // }       // closes if isset $_POST['editpost'] submit


    // Try putting form stuff here to see if using header works to redirect
    // to index.php before refreshing and going back to new post edit page


    //

    //

    // <h2>Ok, so you want to edit your blog post</h2>
    // <form action="edit_post.php"
    //      method="POST">
    //    Edit your blog post....<br>
    //    <input style="background-color:blanchedalmond" type="text" name="edittitle" placeholder="Title your post"
    //           value="<?php echo "$edittitle"; "><br><br>
    //    <input style="background-color:blanchedalmond" type="text" name="editauthor" placeholder="Who are you?"
    //           value="<?php echo "$editauthor"; "><br><br>

    //    <input type="hidden" name="id" value="<?php echo $id; "><br>

    //    <textarea style="background-color:lightblue" name="editcontents"
    //              rows="20" cols="80" onclick="this.innerHTML=''">
    //              <?php echo $editcontents;
    //    </textarea><br><br>
    //    <input type="submit" name="editsubmit" value="Submit Edited Blog Post"><br>
    //    <?php echo $id;
    // </form>

// <?php


//    }    // this closes else statement for doing update post, meaning there is an id in $_GET['id']



        // Above is logic for editing an existing post
        //------------------------------------------------------------------//



// below is my old way
//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//    $sql = $db->prepare("SELECT title, author, contents FROM posts WHERE id = ?");
    // How to search both title and contents?
    // $search_term = "%" . $_GET['searchBox'] . "%";
//    $editid = $_GET['id'];
//    $sql->bind_param("i", $editid);
//    $sql->execute();
//    $sql->bind_result($title, $author, $contents);
//    $sql->fetch();
// have gotten data and filled in variables



?>