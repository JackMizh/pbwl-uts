<?php  
    session_start();
    include 'config.php';  
    $data = new Databases; 
    $data->checkLogin();

    if($_SERVER['REQUEST_METHOD']=='POST') {
        if(array_key_exists('button1', $_POST)) {
            $data->addPemberi($_POST['panitiapemberi'], $_POST['namapemberi'], $_POST['alamatpemberi'], $_POST['typepemberi'], $_POST['beraspemberi'], $_POST['uangpemberi']);
        }
        else if(array_key_exists('button2', $_POST))
        {
            $data->deletePemberi($_POST['idpemberi'], $_POST['namapemberi']);
        }
        else if(array_key_exists('button3', $_POST)){
            $data->editPemberi($_POST['idpemberi'], $_POST['panitiapemberi'], $_POST['namapemberi'], $_POST['alamatpemberi'], $_POST['typepemberi'], $_POST['beraspemberi'], $_POST['uangpemberi']);
        }
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Pemberi</title>
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
                        <h4 class="modal-title" id="myModalLabel">Tambah Pemberi</h4>
                    </div>
                    
                    <form role="form" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputName">Panitia Pemberi</label>
                                    <select class="form-control" id="panitiapemberi" name="panitiapemberi">
                                    <?php foreach($data->getPanitia() as $value): ?>
                                        <option value="<?= $value['id_panitia'] ?>"><?= $value['nama_panitia'] ?></option>
                                    <?php endforeach ?>
                                    </select>
                                    <br><br>
                                    <label for="inputName">Nama Pemberi</label>
                                    <input type="text" class="form-control" id="namapemberi" name="namapemberi" placeholder="Masukkan Nama Pemberi"/>
                                    <br><br>
                                    <label for="inputName">Alamat Pemberi</label>
                                    <input type="text" class="form-control" id="alamatpemberi" name="alamatpemberi" placeholder="Masukkan Alamat Pemberi"/>
                                    <br><br>
                                    <label for="inputName">Type Pemberi</label>
                                    <select class="form-control" id="typepemberi" name="typepemberi">
                                        <option value="Zakat Fitrah">Zakat Fitrah</option>
                                        <option value="Zakat Mal">Zakat Mal</option>
                                        <option value="Sedekah">Sedekah</option>
                                        <option value="Fidyah">Fidyah</option>
                                    </select>
                                    <br><br>
                                    <label for="inputName">Beras Pemberi (Kg)</label>
                                    <input type="number" class="form-control" id="beraspemberi" name="beraspemberi" placeholder="Masukkan Beras Pemberi"/>
                                    <br><br>
                                    <label for="inputName">Uang Pemberi (Rp.)</label>
                                    <input type="number" class="form-control" id="uangpemberi" name="uangpemberi" placeholder="Masukkan Uang Pemberi"/>
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
                        <h4 class="modal-title" id="myModalLabel">Edit Pemberi</h4>
                    </div>
                    
                    <form role="form" method="post">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputName">Panitia Pemberi</label>
                                    <select class="form-control" id="panitiapemberi" name="panitiapemberi">
                                    <?php foreach($data->getPanitia() as $value): ?>
                                        <option value="<?= $value['id_panitia'] ?>"><?= $value['nama_panitia'] ?></option>
                                    <?php endforeach ?>
                                    </select>
                                    <br><br>
                                    <label for="inputName">Nama Pemberi</label>
                                    <input type="hidden" class="form-control"  name="idpemberi" id="idpemberi"/>
                                    <input type="text" class="form-control" id="namapemberi" name="namapemberi"/>
                                    <br><br>
                                    <label for="inputName">Alamat Pemberi</label>
                                    <input type="text" class="form-control" id="alamatpemberi" name="alamatpemberi"/>
                                    <br><br>
                                    <label for="inputName">Type Pemberi</label>
                                    <select class="form-control" id="typepemberi" name="typepemberi">
                                        <option value="Zakat Fitrah">Zakat Fitrah</option>
                                        <option value="Zakat Mal">Zakat Mal</option>
                                        <option value="Sedekah">Sedekah</option>
                                        <option value="Fidyah">Fidyah</option>
                                    </select>
                                    <br><br>
                                    <label for="inputName">Beras Pemberi (Kg)</label>
                                    <input type="number" class="form-control" id="beraspemberi" name="beraspemberi"/>
                                    <br><br>
                                    <label for="inputName">Uang Pemberi (Rp.)</label>
                                    <input type="number" class="form-control" id="uangpemberi" name="uangpemberi"/>
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
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalForm">Tambah Pemberi!</button>
        </div>
        <div class="container" style="margin-top: 20px">
            <section class="home-section">
                <div class="home-content">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Pemberi</th>
                                <th>Panitia Pemberi</th>
                                <th>Nama Pemberi</th>
                                <th>Alamat Pemberi</th>
                                <th>Type Pemberian</th>
                                <th>Beras Pemberian</th>
                                <th>Uang Pemberian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data->getPemberi() as $value): ?>
                            <tr>
                                <td><?= $value['id_pemberi'] ?></td>
                                <td><?= $value['nama_panitia'] ?></td>
                                <td><?= $value['nama_pemberi'] ?></td>
                                <td><?= $value['alamat_pemberi'] ?></td>
                                <td><?= $value['type_pemberi'] ?></td>
                                <td><?= $value['beras_pemberi'] ?></td>
                                <td><?= $value['uang_pemberi'] ?></td>
                                <td>
                                    <button class="button edit" data-toggle="modal" data-target="#modalForm2" 
                                        data-id="<?php echo $value['id_pemberi'] ?>"
                                        data-panitia="<?php echo $value['panitia_pemberi'] ?>"
                                        data-nama="<?php echo $value['nama_pemberi'] ?>"
                                        data-alamat="<?php echo $value['alamat_pemberi'] ?>"
                                        data-type="<?php echo $value['type_pemberi'] ?>"
                                        data-beras="<?php echo $value['beras_pemberi'] ?>"
                                        data-uang="<?php echo $value['uang_pemberi'] ?>">Edit Pemberi
                                    </button>

                                    <form method="post">
                                        <input type="hidden" name="idpemberi" value="<?php echo $value['id_pemberi'] ?>"/>
                                        <input type="hidden" name="namapemberi" value="<?php echo $value['nama_pemberi'] ?>"/>
                                        <input type="submit" name="button2" class="button" value="Hapus Pemberi"/>
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
        var Panitia = $(this).data('panitia');
        var Nama = $(this).data('nama');
        var Alamat = $(this).data('alamat');
        var Type = $(this).data('type');
        var Beras = $(this).data('beras');
        var Uang = $(this).data('uang');
        $(".modal-body #panitiapemberi").val( Panitia );
        $(".modal-body #namapemberi").val( Nama );
        $(".modal-body #idpemberi").val( Id );
        $(".modal-body #alamatpemberi").val( Alamat );
        $(".modal-body #typepemberi").val( Type );
        $(".modal-body #beraspemberi").val( Beras );
        $(".modal-body #uangpemberi").val( Uang );
    });
</script>
</html> 