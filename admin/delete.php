<?php
    // Assuming you have a valid database connection
    include('../connection.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $table = $_GET['type'];

        //Delete record
        $query = "DELETE FROM ".$table." WHERE ".$table."_id = ?";
        $stmt = mysqli_prepare($condb, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //Update subsequent record IDs if any
        $query = "UPDATE ".$table." SET ".$table."_id = ".$table."_id - 1 WHERE ".$table."_id > ?";
        $stmt = mysqli_prepare($condb, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        mysqli_close($condb);
    }
?>