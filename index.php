<?php
/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/27/2015
 * Time: 9:22 PM
 */

// Reading
//    - create index.php that includes the db_info.php from above
//    - select all blog posts from mysql
//    - iterate through the result with `foreach` and display each post
//            - title, date, author, and post body
//    - create HTML tags for the page layout but no styling yet

// FYI var_dump($_POST) is a good debug tool with echo <pre>  </pre> around it
// look for style formats in bootstrap, or from twitter

?>

<!-- You can insert the CSS to either the document Head or link it as an external resource -->

<!DOCTYPE html>
<html>
<head>
    <style>
        table, td, th, tr {
            border: 1px solid darkslateblue;
        }

        table {
            width: 50%;
        }

        table.center {
            width:70%;
            margin-left:15%;
            margin-right:15%;
        }

        td  {
            padding: 8px;
            height: 10px;
        }

        th {
            font-family: Arial, Helvetica, sans-serif;
            background-color: cadetblue;
            color: white;
            height: 75px;
        }

        tr  {
            font-family: Arial, Helvetica, sans-serif;
            background-color: lightsteelblue;
            color: black;
        }

        tbody tr:nth-child(odd) {
            background-color: #ccc;
        }

    </style>
</head>



<?php


include 'db_info.php';


// here is where to add the stuff to display all of the blog posts (like in todo_list)
    // $sql = "SELECT * FROM posts";
    // $result = $db->query($sql);
    // if ($result)  {
    //tr starts new row, td for each column in row


// in class, put search box on index page
// Select * from posts
// WHERE contents LIKE
// "%    "
// "     %"
// "%    %"   will search for key anywhere in the column
// use single quotes so don't have to worry about escaping them

$delid = "NULL";
if (isset($_GET['id']))  {
    $delid = $_GET['id'];
}

echo "delete id = $delid";

// The following executes if the user clicks the Search button
// NO DELETE AND YES SEARCH

if ($delid == "NULL" && isset($_GET['cool']))   {
        // set up the SELECT query
        // $term = $_GET['term'];
    // $title = $_GET['title'];
    // $author = $_GET['author'];
    // $contents = $_GET['contents'];
    // $id = $_POST['id'];

    $sql = $db->prepare("SELECT title, author, contents, date FROM posts WHERE contents LIKE ? ");
    // How to search both title and contents?

    $search_term = "%" . $_GET['searchBox'] . "%";

    $sql->bind_param("s", $search_term);
    $sql->execute();

    $sql->bind_result($title, $author, $contents, $date);

    // table below will only show the rows where the search_term has been found in the contents
    // but it's missing links for edit and delete

    // Now adding tags, new column to tables

    ?>

    <body>
    <table border="1" class="center"> <!-- start a table -->
    <tr> <!-- first row -->
        <th>Title</th> <!-- header -->
        <th>Author</th>
        <th>Date Added</th>
        <th>Contents</th>
        <th>Tags</th>
        <th>Link to edit</th>
        <th>Delete</th>
    </tr> i<!-- end first row -->
    <tr> <!-- second row -->
        <?php while ($sql->fetch())  {  ?>
        <tr>
        <td><?php echo $title;          ?></td>
        <td><?php echo $author;         ?></td>
        <td><?php echo $date;           ?></td>
        <td><?php echo $contents;    }   ?></td>


        </tr> <?php   ?>
<!-- end second row -->
<tr> <!-- third row -->


</tr> <!-- end third row -->
</table> <!-- end the table -->
</body>

<?php  }  // closing the search option

    //while($sql->fetch())   {
    //    echo $title;
    //    echo $contents;
    //}
    // bind result, you choose names where to store a row into name variables
    // variables don't have to exist already
    // $statement->bind_result($title, $author, $contents, $date);
    // then need to get the data with while loop
    // each fetch per each row in matching posts
    // continues while there are more matching
    // and stops when no more matches
    // go through every row
    // while ($statement->fetch())  {
    //    echo $title;
    //    echo $contents;
    // $result = $db->query($search);
    // bind_param
    // then use '%   %'
    // execute
    // when you get to this point it changes to we'll talk more

    // The following executes if the user does not click Search box, prints entire index
    // and we are not deleting
    // Try changing else  below to an elseif, so we don't show table twice
    // Try adding an AND condition about the search button, AND not searching
    // This table should also show the edited post as well, why isn't it?

// NO DELETE AND NO SEARCH, JUST FULL TABLE

elseif($delid == "NULL" && !isset($_GET['cool']))   {
        // your existing SELECT logic here
        $sql = "SELECT * FROM posts";
        $result = $db->query($sql);

        if ($result)  {

    ?>

    <body>
    <table border="1" class="center"> <!-- start a table -->
    <tr> <!-- first row -->
        <th>Title</th> <!-- header -->
        <th>Author</th>
        <th>Date Added</th>
        <th>Contents</th>
        <th>Tags</th>
        <th>Link to edit</th>
        <th>Delete</th>
    </tr> <!-- end first row -->
    <tr> <!-- second row -->
        <?php foreach ($result as $row)  {  ?>
        <tr>
        <td><?php echo ($row['title']);          ?></td>
        <td><?php echo ($row['author']);         ?></td>
        <td><?php echo ($row['date']);           ?></td>
        <td><?php echo ($row['contents']);       ?></td>
        <td>  <a href="edit_post.php?id=<?php echo $row['id']; ?>">View/Edit</a></td>
        <td>  <a href="index.php?id=<?php echo $row['id']; ?>">Delete</a></td>  <?php } ?>
        </tr> <?php      ?>
        <!-- end second row -->
    </table> <!-- end the table -->
    </body>


    <?php  } } // closing the if result and closing no delete option



    // Add new stuff here to make the delete function

    // $delid = $row['id'];
    // echo "Delete id = $delid";

// DELETE AND NO SEARCH
// still having problem with only being able to delete once before id is undefined, should be getting new delid

elseif($delid != "NULL" && !isset($_GET['cool'])) {
        // $id = $_POST['id'];
        $delStatement = $db->prepare("DELETE FROM posts WHERE id = ?");

        $delStatement->bind_param("i", $delid);

        $delStatement->execute();


    // and then need to repeat showing the whole index minus post with delete id
    // fixed delete only once problem by changing following line to SELECT *

        $sql = "SELECT * FROM posts";

        // $sql->bind_result($title, $author, $contents, $date);
        // try changing from after search table to regular all index table
        // PROBLEM: going to index page shows both tables, first for no delete and second for delete
        // ok fixed that, not showing both tables anymore BUT
        // PROBLEM:  now can only delete one time and then get error second time trying to delete
        // maybe lost $row['id'] on second delete attempt and also
        // PROBLEM: can't go back to edit page to edit a post after deleting one post
        // PROBLEM: search function messed up, showing both tables and not including links (edit & delete)
        // on the search results table

        $result = $db->query($sql);

        if ($result)  {

        ?>

        <body>
        <table border="1" class="center"> <!-- start a table -->
        <tr> <!-- first row -->
            <th>Title</th> <!-- header -->
            <th>Author</th>
            <th>Date Added</th>
            <th>Contents</th>
            <th>Tags</th>
            <th>Link to edit</th>
            <th>Delete</th>
        </tr> <!-- end first row -->
        <tr> <!-- second row -->
        <?php foreach ($result as $row)  {  ?>
            <tr>
            <td><?php echo ($row['title']);          ?></td>
            <td><?php echo ($row['author']);         ?></td>
            <td><?php echo ($row['date']);           ?></td>
            <td><?php echo ($row['contents']);       ?></td>
            <td>  <a href="edit_post.php?id=<?php echo $row['id']; ?>">View/Edit</a></td>
            <td>  <a href="index.php?id=<?php echo $row['id']; ?>">Delete</a></td>  <?php  ?>
            </tr> <?php  }  ?>
            <!-- end second row -->
        </table> <!-- end the table -->
        </body>






        <?php }  }  // closing the if result and closing the delete option (else)
                    // New stuff above for delete function

?>


    <form action="index.php" method="GET">
    <!--  search form ... -->
    <br>
    Search blog index by keyword: <br>
    <input type="text" name="searchBox" >
    <input type="submit" name="cool" value="Search" >
    </form>

<?php          ?>