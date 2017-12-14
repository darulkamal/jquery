<!DOCTYPE html>
<html>
<head>
	<title>Codeigniter</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/dataTables/dataTables.bootstrap.css');?>">

</head>
<body>

<div class="container">
	<h1>Menggabungkan Bootstrap, jquery pada Framework</h1>
	<h3>Toko Buku</h3>

	<button class="btn btn-success" onclick="tambah()"><i class="glyphicon glyphicon-plus"></i>Tambah Buku</button>
	<br>
	<br>

    
     <div class="table-responsive">

	 <div class="panel-body">
      <div class="table-responsive">           
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
             <thead>
               <tr>
                <th>ID Buku</th>
                <th>ISBN Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang Buku</th>
                <th>Aksi</th>
              </tr>
             </thead>

		<tbody>
            <?php
            foreach($buku as $buku){


            ?>
			<tr>
				<td><?php echo $buku->id;?></td>
				<td><?php echo $buku->isbn;?></td>
				<td><?php echo $buku->judul;?></td>
				<td><?php echo $buku->pengarang;?></td>
				<td>
                    <button class="btn btn-warning" onclick="edit_buku(<?php echo $buku->id; ?>)"><i class="glyphicon glyphicon-pencil"></i></button> 

                     <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>            
                </td>
			</tr>

            <?php
        }
            ?>
		</tbody>
	</table>
</div>
</div>
</div>


<!--link ke js -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/dataTables/dataTables.bootstrap.js'); ?>"></script>
<!--js -->
 <script>
    $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });

    var save_method;
    var table;

    function tambah(){
       save_method = 'add';
       $('#form')[0].reset();
       $('#modal_form').modal('show'); 
    }
    function save(){
        var url;
        if(save_method == 'add'){
            url = '<?php echo site_url('index.php/buku/tambah');?>';
        }else{
            '<?php echo site_url('index.php/buku/update');?>';
        }
        $.ajax({
            url: url,
            type: "POST",
            data:$('#form').serialize(),
            dataType:"JSON",
            success: function(data){
                $('#modal_form').modal('hide');
                location.reload();

            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function edit_buku(id){
        save_method = 'update';
        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo site_url('index.php/buku/ajax_edit/');?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name ="id"]').val(data.id);
                $('[name ="isbn"]').val(data.isbn);
                $('[name ="judul"]').val(data.judul);
                $('[name ="pengarang"]').val(data.pengarang);

                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Buku');
            },
            error: function(jqXHR, textStatus,errorThrown){
                alert('Error Get Data From Ajax');
            }
        });
    }
 </script>

 <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">ISBN Buku</label>
                    <div class="col-md-9">
                        <input type="text" name="isbn" placeholder="ISBN buku" class="form-control">
                    </div>
                </div>
            </div>

              <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Judul Buku</label>
                    <div class="col-md-9">
                        <input type="text" name="judul" placeholder="Judul buku" class="form-control">
                    </div>
                </div>
            </div>

              <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Pengarang Buku</label>
                    <div class="col-md-9">
                        <input type="text" name="pengarang" placeholder="Pengarang buku" class="form-control">
                    </div>
                </div>
            </div>


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="save()" class="btn btn-primary">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 



</body>
</html>