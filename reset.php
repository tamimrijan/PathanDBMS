<?php

include('dbconnection.php');
session_start();
$gd = $_SESSION['gid'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>পাঠান - পাসওয়ার্ড রিকভারি</title>
    <link rel="icon" type="image/x-icon" href="favicon01.png">
    <style>
         @font-face {
            font-family: 'Li Ador Noirrit SemiBold';
            src: url('font/Li Ador Noirrit SemiBold.ttf'); /* Ensure your font path is correct */
        }
        body {
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Li Ador Noirrit SemiBold', sans-serif;
        }
    </style>
</head>

<body>
    <form action="reset.php" method="POST">
        <table border="0px solid" style="margin-left: auto; margin-right:auto; margin-top:70px; font-weight:bold;border-spacing: 50px 30px;">
            <th colspan="3" style="text-align: center;font-size:35px; width: 300px; height: 70px;font-weight:bold;">নতুন পাসওয়ার্ড দিন</th>
            <tr>
                <td colspan="2" style="font-size: 20px;font-weight:bold">New Password</td>
                <td><input type="password" name="pass" placeholder="enter new password" style="font-size: 20px;font-weight:bold" required /></td>
            </tr>

            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="submit" value="Update" style="background-color: red; border-radius: 15px; width: 140px; height: 50px;" />
                </td>
            </tr>
        </table>

    </form>
</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $password = $_POST['pass'];

    $qryd = "UPDATE `login` SET `password` = '$password' WHERE `u_id` = '$gd'";
    $run = mysqli_query($dbcon, $qryd);

    if ($run == true) {
        ?> <script>
            alert('পাসওয়ার্ড সফল ভাবে পরিবর্তন হয়েছে');
            window.open('logout.php', '_self');
            </script>
        <?php
    }
}
?>