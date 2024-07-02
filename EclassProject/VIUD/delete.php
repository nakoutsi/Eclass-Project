<center>

    <?php
    include ("connect.php");
    ?>
    <?php
    include ("includes/header.php");
    ?>
    <?php
    include ("includes/menu.php");
    ?>


    <?php
    //------------------delete xristi----------------------------
    if ((isset($_GET['userid'])) && ($_GET['status'] == 'delete')) {
        $userid = $_GET['userid'];
        mysqli_autocommit($link, false);
        $sql = "delete FROM users
									WHERE
						userid = '$userid'";

        $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));
        if ($result) {
            mysqli_commit($link);
            echo "<font color=\"#3300FF\"><strong><br>Η διαγραφή του χρήστη ολοκληρώθηκε με επιτυχία!!!<br></strong>";
        } else {
            mysqli_rollback($link);
        }
    }
    ?>



    <?php
    $sql = "select userid, fname, lname, email from users";

    $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));
    ?>
    <br>
    <table class="view">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Delete</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr class="alt">
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td align="center"><a onClick="return confirm('Είσαι σίγουρος ότι θες να διαγράψεις τον χρήστη <?php echo $row['fname'] . " " . $row['lname']; ?> ?')" href="delete.php?status=delete&userid=<?php echo $row['userid']; ?>"><img src="icons/delete.png"></a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</center>
