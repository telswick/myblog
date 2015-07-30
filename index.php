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
<head>
<style type="text/css">
    table.table-style-three {
    font-family: verdana, arial, sans-serif;
		font-size: 11px;
		color: #333333;
		border-width: 1px;
		border-color: #3A3A3A;
		border-collapse: collapse;
	}
	table.table-style-three th {
    border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #FFA6A6;
		background-color: #D56A6A;
		color: #ffffff;
	}
	table.table-style-three tr:hover td {
    cursor: pointer;
}
	table.table-style-three tr:nth-child(even) td{
    background-color: #F7CFCF;
	}
	table.table-style-three td {
    border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #FFA6A6;
		background-color: #ffffff;
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

<table border="1"> <!-- start a table -->
    <tr> <!-- first row -->
        <th>Title</th> <!-- header -->
        <th>Author</th>
        <th>Date Added</th>
        <th>Contents</th>
    </tr> <!-- end first row -->
    <tr> <!-- second row -->
        <?php foreach ($result as $row)  {  ?>
    <tr>
        <td><?php echo ($row['title']);            ?></td>
        <td><?php echo ($row['author']);      ?></td>
        <td><?php echo ($row['date']);      ?></td>
        <td><?php echo ($row['contents']);    }  ?></td>
    </tr> <?php  }  ?>
    <!-- end second row -->
    <tr> <!-- third row -->


    </tr> <!-- end third row -->
</table> <!-- end the table -->


<?php

// echo "<tr><td>$row[item]</td><td>$row[assigndate]</td><td>\n";



//else {
//  echo $db->error;
//}

?>
