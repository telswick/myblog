<?php
/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/27/2015
 * Time: 9:38 PM
 */


/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/27/2015
 * Time: 9:30 PM
 */

// Searching
//    - create a search form with 1 text box and a submit button
//    - when form is submitted, run a SELECT query with a WHERE that checks
//      for posts matching the search box
//    - displaying the posts is the same as above

// in class, change to putting search box on index.php page

include 'db_info.php';

?>

<form action="search.php"
      method="POST">

    <input type="text" name="posts">
    <input type="submit" name="submit">

</form>

<ul>
    <?php
    $search = "SELECT * FROM posts";    // need to add WHERE to match search box
    $result = $db->query($search);

    if ($result)  {



    ?>

    <table border="1"> <!-- start a table -->
        <tr> <!-- first row -->
            <th>To Do Item</th> <!-- header -->
            <th>Date Added</th>
        </tr> <!-- end first row -->
        <tr> <!-- second row -->
            <?php foreach ($result as $row)  {  ?>
        <tr>
            <td><?php echo ($row['item']);            ?></td>
            <td><?php echo ($row['assigndate']);   }  ?></td>
        </tr> <?php  }  ?>
        <!-- end second row -->
        <tr> <!-- third row -->


        </tr> <!-- end third row -->
    </table> <!-- end the table -->

