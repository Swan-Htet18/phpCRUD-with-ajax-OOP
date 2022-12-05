<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5 py-4 shadow border">
                <h1 class="text-center mb-3">CRUD with Ajax,jQuery and Php</h1>
                <input class="id">
                <input type="text" class="name form-control my-2" placeholder="Enter Username" >
                <input type="text" class="email form-control my-2" placeholder="Enter Email" >
                <button class=" cbtn btn btn-dark" onclick="insertData()">Create</button>
                <button class="ubtn btn btn-dark" style="display:none;" onclick="updateData()">Update</button>
               
            </div>
        </div>

        <div class="row mt-3">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created_Date</th>
                    <th>Modified_Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <tbody class="table_here">
                 
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        selectData();
    })
  
    
    function insertData() {
        var name=$('.name').val();
        var email=$('.email').val();
        $.ajax({
            url:"crud.php" ,
            method: "POST",
            data:{name,email},
            success:function()
            {
                $('.name,.email').val("")
                selectData()
            }

        })
    }
    function selectData()
    {
        $.ajax({
            url:"crud.php",
            method:"POST",
            data:{select:1},
            success:function(result)
            {
                $('.table_here').html(result)
            }
        })
    }

    function deleteData(id)
    {
        $.ajax({
            url:"crud.php",
            method:"POST",
            data:{id},
            success:function()
            {
                selectData()
            }
        })
    }

    function editData(eid)
    {
        $.ajax({
            url:"crud.php",
            method:"POST",
            data:{eid},
            dataType:'json',
            success:function(result)
            {
                $('.id').val(result.id)
                $('.name').val(result.name)
                $('.email').val(result.email)
                $('.cbtn').hide()
                $('.ubtn').show()
            }
        })
    }
      
    function updateData() {
        var uid=$('.id').val();
        var uname=$('.name').val();
        var uemail=$('.email').val();
        $.ajax({
            url:"crud.php" ,
            method: "POST",
            data:{uid,uname,uemail},
            success:function()
            {
                $('.name,.email').val("")
                selectData()
                $('.cbtn').show()
                $('.ubtn').hide()
            }

        })
    }


</script>
</html>
