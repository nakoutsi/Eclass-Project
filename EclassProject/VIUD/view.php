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
    $sql = "select  fname,
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
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr class="alt">
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</center>
