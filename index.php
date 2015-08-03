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


if (isset($_GET['cool']))   {
        // set up the SELECT query
        // $term = $_GET['term'];
    $sql = $db->prepare("SELECT title, author, contents, date FROM posts WHERE contents LIKE ?");

    $search_term = "%" . $_GET['searchBox'] . "%";

    $sql->bind_param("s", $search_term);
    $sql->execute();

    $sql->bind_result($title, $author, $contents, $date);

    ?>

    <body>
    <table border="1" class="center"> <!-- start a table -->
    <tr> <!-- first row -->
        <th>Title</th> <!-- header -->
        <th>Author</th>
        <th>Date Added</th>
        <th>Contents</th>
    </tr> <!-- end first row -->
    <tr> <!-- second row -->
        <?php while ($sql->fetch())  {  ?>
        <tr>
        <td><?php echo ($title);          ?></td>
        <td><?php echo ($author);         ?></td>
        <td><?php echo ($date);           ?></td>
        <td><?php echo ($contents);    }  ?></td>
    </tr> <?php    ?>
<!-- end second row -->
<tr> <!-- third row -->


</tr> <!-- end third row -->
</table> <!-- end the table -->
</body>

<?php

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

}   else   {
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
    </tr> <!-- end first row -->
    <tr> <!-- second row -->
        <?php foreach ($result as $row)  {  ?>
        <tr>
        <td><?php echo ($row['title']);          ?></td>
        <td><?php echo ($row['author']);         ?></td>
        <td><?php echo ($row['date']);           ?></td>
        <td><?php echo ($row['contents']);    }  ?></td>
    </tr> <?php  }  ?>
<!-- end second row -->

</table> <!-- end the table -->
</body>







<form action="index.php" method="GET">
    <!--  search form ... -->
    <input type="text" name="searchBox" >
    <input type="submit" name="cool" value="Search" >

</form>



<?php  }  ?>