<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo base_url('res/css/dataTable.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('res/css/bootstrap.min.css')?>" rel="stylesheet">
  <title> Bootbox Ajax Demo </title>
  <style>
    html{
      padding-top: 50px;
    }
  </style>
</head>
<body>

<div class="container">

        <div id="addbookmodal" class="modal fade" role="dialog">
           <div class="modal-dialog">
     
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add new book</h4>
                          </div>
                          <form action="" method="POST">
                          <div class="modal-body">
                            <label>Book Name: </label>
                            <input type="text" name="txtBookname" id="txtBookname" class="form-control" required />
                            <label> Author Email:</label>
                            <input type="email" name="txtEmail" id="txtEmail" class="form-control" required /> 
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn_savebook" data-dismiss="modal">Save</button>
                           </form>
                          </div>
                        </div>
                    
                      </div>
      </div>

  <div class="col-md-12 well" id="#addbook">
    <a href="#addbook" id="addbook" data-toggle="modal" data-target="#addbookmodal" class="btn btn-success">Add new book</a>
    <a href="#" id="logout" class="btn btn-warning">Logout <?php echo $_SESSION['username'];?></a>
  </div>
<div class="col-md-12">
  <div class="row">
      <div class="table-responsive">
          <table id="book_tbl" class="table table-striped table-hover">
            <thead>

              <tr>
                <th> #   </th>
                <th> Title   </th>
                  <th> Options   </th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($books as $items){ ?>
                  <tr>
                      <td><?php echo $items['bookID']; ?></td>
                      <td><?php echo $items['Tittle']; ?></td>
                      <td><a href="#" data-id="<?php echo $items['bookID']; ?>" class="btn btn-success viewbook">View</a>
                          <a href="#" data-id="<?php echo $items['bookID']; ?>" class="btn btn-danger deletebook">Delete</a>
                      </td>
                  </tr>
                <?php }?>
          </tbody>

          </table>
      </div>
  </div>
</div>
</div>


<script src="<?php echo base_url('res/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('res/js/bootstrap.js')?>"></script>
<script src="<?php echo base_url('res/js/bootbox.js')?>"></script>
<script src="<?php echo base_url('res/js/popup.js')?>"></script>
<script src="<?php echo base_url('res/js/dataTables.js')?>"></script>
<script>
  $(document).ready(function(){
      $("#book_tbl").DataTable();
      
  });
</script>
</body>
</html>
