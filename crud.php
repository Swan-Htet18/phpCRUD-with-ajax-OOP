<?php
    $conn=mysqli_connect("localhost","root","","register");
    if(isset($_POST["name"]) && isset( $_POST["email"]))
        {
            $name = $_POST["name"];
            $email = $_POST["email"];
            mysqli_query($conn, "INSERT INTO user(name,email,created_date,modified_date)
                            VALUES ('$name','$email',now(),now())");
        }

    if(isset($_POST['select']))
    {
        $query=mysqli_query($conn,"SELECT * FROM user");
        while($row=mysqli_fetch_assoc($query))
        {
            echo '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['created_date'].'</td>
                        <td>'.$row['modified_date'].'</td>
                        <td>
                            <button class="btn btn-warning"
                                onclick="editData('.$row['id'].')"
                                >
                                Edit
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-warning"
                                onclick="deleteData('.$row['id'].')"
                                >
                                Delete
                            </button>
                        </td>
                </tr>';
        }
    }

    if(isset($_POST['id']))
    {
        $id=$_POST['id'];
        $query=mysqli_query($conn,"DELETE FROM user
                    WHERE id='$id' ");
    }

    if(isset($_POST['eid']))
    {
        $id=$_POST['eid'];
        $query=mysqli_query($conn,"SELECT * FROM user
                    WHERE id='$id' ");
        $row=mysqli_fetch_assoc($query);
        echo json_encode($row);
    }
    if(isset($_POST["uname"]) && isset($_POST["uemail"]) 
        && isset($_POST["uid"]))
        {
            $id=$_POST["uid"];
            $name=$_POST["uname"];
            $email=$_POST["uemail"];
            mysqli_query($conn, "UPDATE user SET name='$name',
                        email='$email',modified_date=now() WHERE id='$id'");
        }
?>