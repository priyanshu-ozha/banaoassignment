{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>

    <h1>Hello {{ Auth::user()['name']}}</h1>

    <p><a href="logout">Logout</a></p>


<div class="container table-responsive py-5">
    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
         <tr>
          <th scope="row">4</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
        <tr>
          <th scope="row">5</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
    </div>


</body>
</html> --}}


<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        h1{
            font-size:30px;
        }
        /*Table Style One*/
        .table .table-header{
            background:#FEC107;
            color:#333;
        }
        .table .table-header .cell{
            padding:20px;
        }
        @media screen and (max-width: 640px){
            table {
                overflow-x: auto;
                display: block;
            }
            .table .table-header .cell{
                padding:20px 5px;
            }
        }
    </style>
</head>
<body>
    <h1>Hello {{ Auth::user()['name']}}</h1>



    <p><a href="logout">Logout</a></p>
<div class="container">
    <h1>Task <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addTask">
       Add Task
      </button>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr class="table-header">
                    <th class="cell">ID</th>
                    <th class="cell">Task</th>
                    <th class="cell">Status</th>
                    <th class="cell">Action</th>
                </tr>
                @foreach ($tasks as $task)
                <tr  class="active">
                    <td>
                        {{$task->id}}
                    </td>
                    <td>  {{$task->task}}</td>
                    <td>  {{$task->status}}</td>
                  <td><button type="button" class="btn btn-primary edit_task" value="{{$task->id}}">
                    Update Task Status
                  </button>
                  </td>

                </tr>
                @endforeach



            </table>
        </div>
    </div>
</div>
<!-- ADD Task Modal -->
<div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul id="saveform_errList"></ul>
            <div id="saveform"></div>
               <form class="form">

                <div class="mb-3">
                  <label for="task-name" class="col-form-label">Task:</label>
                  <input type="text" class="form-control" name="taskname" value="" id="task_name">
                </div>

                {{-- <div class="mb-3"> --}}
                  {{-- <label for="user-id" class="col-form-label">User Id:</label> --}}
                  <input type="text" hidden class="form-control" value="{{Auth::id();}}" name="user-id" value="" id="user_id">
                {{-- </div> --}}

              </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add">Add</button>
        </div>
      </div>
    </div>
  </div>
<!-- Update Task -->
<div class="modal fade" id="updateTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="editform"></div>
            <ul id="updateform_errList"></ul>
            <div id="updateform"></div>
            <form class="form">
                <input type="text" hidden name="update-id" value="" class="form-control" id="task_id">
                <div class="mb-3">
                  <label for="task" class="col-form-label">Task:</label>
                  <input type="text" name="task" value="" class="form-control" id="task">
                </div>
                <div class="mb-3">
                  <label for="update-status" class="col-form-label">Update Status:</label>
                  <input type="text" name="update-status" value="" class="form-control" id="task_status">
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_task">Update</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // $('#add').click(function(){
        //     console.log("Hello From Add");
        // })
        $(document).on('click','.add',function(e){
            e.preventDefault();
            // console.log("Hello From Add");
            var data = {
                'task' : $('#task_name').val(),
                'user_id' : $('#user_id').val(),
            };
            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
              type: "POST",
              url: "/addtasks",
              data: data,
              dataType: "json",
              success: function( response ) {
                // console.log(response);
                if(response.status==0){

                    $('#saveform_errList').html("");
                    $('#saveform_errList').addClass("alert alert-danger");
                    // $.each(response.errors, function(key,err_values){
                    //     $('#saveform_errList').append('<li>' + err_values + '</li>');
                    // } );
                    $('#saveform_errList').append('<li>' + response.errors + '</li>');




                }else{
                    $('#saveform').html("");
                    $('#saveform').addClass("alert alert-success");
                    // $.each(response.errors, function(key,err_values){
                    //     $('#saveform_errList').append('<li>' + err_values + '</li>');
                    // } );
                    $('#saveform').append('<li>' + response.message + '</li>');
                }
               }
             });

        });

        $(document).on('click','.edit_task',function(e){
            e.preventDefault();
            var id= $(this).val();
            $('#updateTask').modal("show");
            $('#task_id').val(id);
            console.log(id);

            $.ajax({
              type: "GET",
              url: "/edit-tasks/"+id,
              success: function( response ) {

                if(response.status==200){
                    $('#task_status').val(response.task.status);
                    $('#task').val(response.task.task);
                }else{
                    $('#editform').html("");
                    $('#editform').addClass("alert alert-danger");
                    // $.each(response.errors, function(key,err_values){
                    //     $('#saveform_errList').append('<li>' + err_values + '</li>');
                    // } );
                    $('#editform').append('<li>' + response.message + '</li>');
                }

               }
             });

        });
        $(document).on('click','.update_task',function(e){
            e.preventDefault();

            var data = {
                'id': $('#task_id').val(),
                'task':$('#task').val(),
                'status': $('#task_status').val(),
            }

            $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
              type: "POST",
              url: "/updatetask",
              data: data,
              dataType: "json",
              success: function( response ) {
                console.log(response);
                if(response.status==0){

                    $('#updateform_errList').html("");
                    $('#updateform_errList').addClass("alert alert-danger");
                    // $.each(response.errors, function(key,err_values){
                    //     $('#saveform_errList').append('<li>' + err_values + '</li>');
                    // } );
                    $('#updateform_errList').append('<li>' + response.msg + '</li>');


                }else{
                    $('#updateform').html("");
                    $('#updateform').addClass("alert alert-success");
                    // $.each(response.errors, function(key,err_values){
                    //     $('#saveform_errList').append('<li>' + err_values + '</li>');
                    // } );
                    $('#updateform').append('<li>' + response.message + '</li>');
                }
               }
             });

        });



});
</script>
