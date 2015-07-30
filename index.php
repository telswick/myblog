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
            border: 1px solid coral;
        }

        table {
            width: 50%;
        }

        table.center {
            width:50%;
            margin-left:25%;
            margin-right:25%;
        }

        td  {
            padding: 8px;
            height: 10px;
        }

        th {
            font-family: Arial, Helvetica, sans-serif;
            background-color: lightcoral;
            color: white;
            height: 75px;
        }

        tr  {
            font-family: Arial, Helvetica, sans-serif;
            background-color: blanchedalmond;
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

    $sql = "SELECT * FROM posts";
    $result = $db->query($sql);

    if ($result)  {

    //tr starts new row, td for each column in row


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
    <tr> <!-- third row -->


    </tr> <!-- end third row -->
</table> <!-- end the table -->
</body>

<?php

// echo "<tr><td>$row[item]</td><td>$row[assigndate]</td><td>\n";



//else {
//  echo $db->error;
//}

?>
