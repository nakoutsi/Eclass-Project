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
    //define the variables
    $userid = "";
    $fname = "";
    $lname = "";
    $email = "";
    ?>

    <?php
    //------------------update xristi----------------------------
    if ((isset($_GET['userid'])) && ($_GET['status'] == 'update')) {
        $userid = $_GET['userid'];

        $sql = "select userid, fname, lname, email
                from users where userid = '$userid'";
        $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));

        $row = mysqli_fetch_array($result);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
    }
    ?>

    <?php
    //------------------update user----------------------------
    if (isset($_POST['submit']) && $_POST['submit'] == "update1") {
        $userid = $_POST['userid'];

        $sql = "select userid, fname, lname, email
                from users where userid = '$userid'";
        $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));

        $row = mysqli_fetch_array($result);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
    }
    ?>

    <?php
    if (isset($_POST['submit']) && $_POST['submit'] == "Update") {
        //get new values to insert

        $userid = $_POST['userid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

        $error = 0;

        //check fname
        if ($fname == "") {
            echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το Όνομα!<br></font>";
            $error = 1;
        }

        //check lname
        if ($lname == "") {
            echo "<font color=\"#FF0000\">Πρέπει να συμπληρώσετε το επώνυμο!<br></font>";
            $error = 1;
        }

        if ($error) {
            echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
        } else {
            //kane eisagogi tis times stin vasi

            mysqli_autocommit($link, false);
            $sql = "update users set
                                            fname = '$fname',
                                            lname = '$lname',
                                            email = '$email'
                    where userid = '$userid'";

            $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));
            if ($result) {
                mysqli_commit($link);
                echo "<font color=\"#3300FF\"><strong><br>Η επεξεργασία ολοκληρώθηκε με επιτυχία!!!<br></strong>";
            } else {
                mysqli_rollback($link);
                echo "<font color=\"#FF0000\"><strong><br>Η επεξεργασία δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
            }
        }
    }
    ?>


    <?php
    $sql = "select userid,
                    fname,
                    lname,
                    email
        from users";

    $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));
    ?>
    <br>
    <table class="view">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Update</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr class="alt">
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td valign="center" align="center">
                    <form name="updateform" method="post" action="update.php">
                        <input type="hidden" name="status" value="update">
                        <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
                        <BUTTON TYPE="submit" name="submit" value="update1" CLASS="image1"></BUTTON>
                    </form>
            </tr>
            <?php
        }
        ?>
    </table>


    <br>
    <form name="contactform" method="post" action="update.php">

        <table width="50%" class=form>
            <tr>
                <td class=form_subheader>First Name: *</td>
                <td><input type="text" name="fname" maxlength="50" size="30" value=<?php echo $fname ?>></td>
            </tr>
            <tr>
                <td class=form_subheader>Last Name: *</td>
                <td><input type="text" name="lname" maxlength="50" size="30" value=<?php echo $lname ?>> </td>
            </tr>
            <tr>
                <td class=form_subheader>Email: </td>
                <td><input type="text" name="email" maxlength="80" size="30" value=<?php echo $email ?>></td>
            </tr>
            </tr>
            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
            <tr>
                <td valign="top" align="right"></td>
                <td align=left><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>

    </form>

</center>
