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
    $fname = "";
    $lname = "";
    $email = "";
    ?>

    <?php
    if (isset($_POST['submit']) && $_POST['submit'] == "Insert") {
        //get new values to insert
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
            $sql = "insert into users
                                    (fname,
                                     lname,
                                     email
                                    )
                                    values
                                    ('$fname',
                                     '$lname',
                                     '$email'
                                    )";

            $result = mysqli_query($link, $sql) or die(header("Location: error.php?msg=dat_er"));
            if ($result) {
                mysqli_commit($link);
                echo "<font color=\"#3300FF\"><strong><br>Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!<br></strong>";
                header('Location: view.php');
                exit;
            } else {
                mysqli_rollback($link);
                echo "<font color=\"#FF0000\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
            }
        }
    }
    ?>

    <br>
    <form name="contactform" method="post" action="insert.php">

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
                <td class=form_subheader>Email: *</td>
                <td><input type="text" name="email" maxlength="80" size="30" value=<?php echo $email ?>></td>
            </tr>
            </tr>
            <tr>
                <td valign="top" align="right"></td>
                <td align=left><input type="submit" name="submit" value="Insert"></td>
            </tr>
        </table>

    </form>

</center>
