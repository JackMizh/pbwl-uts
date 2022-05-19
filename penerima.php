<?php  
    session_start();
    include 'config.php';  
    $data = new Databases; 
    $data->checkLogin();

    if($_SERVER['REQUEST_METHOD']=='POST') {
        if(array_key_exists('button1', $_POST)) {
            $data->addPenerima($_POST['namapenerima'], $_POST['alamatpenerima']);
        }
        else if(array_key_exists('button2', $_POST))
        {
            $data->deletePenerima($_POST['idpenerima']);
        }
        else if(array_key_exists('button3', $_POST)){
            $data->editPenerima($_POST['idpenerima'], $_POST['namapenerima'], $_POST['alamatpenerima'], $_POST['statuspenerima']);
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Penerima</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        header{ background-color: black; color: white; text-align:center; padding-top: 30px; padding-bottom: 30px; }
        .navbar { background-color: #333;  top: 0; width: 100%; }
        .navbar a { float: left; display: block; color: #f2f2f2; text-align: center; padding: 14px 16px; text-decoration: none; font-size: 17px; }
        .navbar a:hover { background: #ddd; color: black; }
    </style>
</head>                 
<body>
    <header style="background-color: black; color: white; background-image:url(zakat.jpg); background-repeat: no-repeat;background-size: 100% 100%; height: 300px;"></header>

    <nav class="navbar">
        <a href="index.php">Zakat</a>
        <a href="pemberi.php">Pemberi</a>
        <a href="panitia.php">Panitia</a>
        <a href="penerima.php">Penerima</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div>
        <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Penerima</h4>
                    </div>
                    
                    <form role="form" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputName">Nama Penerima</label>
                                    <input type="text" class="form-control" id="namapenerima" name="namapenerima" placeholder="Nama Penerima"/>
                                    <br><br>
                                    <label for="inputName">Alamat Penerima</label>
                                    <input type="text" class="form-control" id="alamatpenerima" name="alamatpenerima" placeholder="Alamat Penerima"/>
                                </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="button1" class="btn default button" value="Submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalForm2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Penerima</h4>
                    </div>
                    
                    <form role="form" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputName">Nama Penerima</label>
                                    <input type="hidden" class="form-control"  name="idpenerima" id="idpenerima"/>
                                    <input type="text" class="form-control" id="namapenerima" name="namapenerima"/>
                                    <br><br>
                                    <label for="inputName">Alamat Penerima</label>
                                    <input type="text" class="form-control" id="alamatpenerima" name="alamatpenerima"/>
                                    <br><br>
                                    <label for="inputName">Status Penerima</label>
                                    <select id="statuspenerima" name="statuspenerima">
                                        <option value="0">Belum Menerima</option>
                                        <option value="1">Sudah Menerima</option>
                                    </select>
                                </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="button3" class="btn default button" value="Submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalForm">Tambah Penerima!</button>
        </div>
        <div class="container" style="margin-top: 20px">
            <section class="home-section">
                <div class="home-content">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Penerima</th>
                                <th>Nama Penerima</th>
                                <th>Alamat Penerima</th>
                                <th>Status Penerima</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data->getPenerima() as $value): ?>
                            <tr>
                                <td><?= $value['id_penerima'] ?></td>
                                <td><?= $value['nama_penerima'] ?></td>
                                <td><?= $value['alamat_penerima'] ?></td>
                                <td><?php if($value['status_penerima'] == 0) 
                                    {
                                        echo "Belum Menerima";
                                    } else{
                                        echo "Sudah Menerima";
                                    } ?></td>
                                <td>
                                    <button class="button edit" data-toggle="modal" data-target="#modalForm2" 
                                        data-id="<?php echo $value['id_penerima'] ?>"
                                        data-nama="<?php echo $value['nama_penerima'] ?>"
                                        data-alamat="<?php echo $value['alamat_penerima'] ?>"
                                        data-status="<?php echo $value['status_penerima'] ?>">Edit Penerima
                                    </button>

                                    <form method="post">
                                        <input type="hidden" name="idpenerima" value="<?php echo $value['id_penerima'] ?>"/>
                                        <input type="submit" name="button2" class="button" value="Hapus Penerima"/>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).on("click", ".edit", function () {
        var Id = $(this).data('id');
        var Nama = $(this).data('nama');
        var Alamat = $(this).data('alamat');
        var Status = $(this).data('status');
        $(".modal-body #namapenerima").val( Nama );
        $(".modal-body #idpenerima").val( Id );
        $(".modal-body #alamatpenerima").val( Alamat );
        $(".modal-body #statuspenerima").val( Status );
    });
</script>
</html> 