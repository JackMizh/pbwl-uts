<?php  
    session_start();
    include 'config.php';  
    $data = new Databases; 
    $data->checkLogin();

    $beras = 0;
    $uang = 0;
    $pemberi = 0;
    $berasfitrah = 0;
    $uangfitrah = 0;
    $berasmal = 0;
    $uangmal = 0;
    $berassedekah = 0;
    $uangsedekah = 0;
    $berasfidyah = 0;
    $uangfidyah = 0;
    $penerima = 0;
    $beraspenerima = 0;
    $uangpenerima = 0;

    foreach($data->getPemberi() as $value): 
        $beras = $beras + (int)$value['beras_pemberi'];
        $uang = $uang + (int)$value['uang_pemberi'];
        $pemberi = $pemberi + 1;

        if($value['type_pemberi'] == "Zakat Fitrah")
        {
            $berasfitrah = $berasfitrah + (int)$value['beras_pemberi'];
            $uangfitrah = $uangfitrah + (int)$value['uang_pemberi'];
        }
        else{
            if($value['type_pemberi'] == "Zakat Mal")
            {
                $berasmal = $berasmal + (int)$value['beras_pemberi'];
                $uangmal = $uangmal + (int)$value['uang_pemberi'];
            }
            else{
                if($value['type_pemberi'] == "Sedekah")
                {
                    $berassedekah = $berassedekah + (int)$value['beras_pemberi'];
                    $uangsedekah = $uangsedekah + (int)$value['uang_pemberi'];
                }
                else{
                    $berasfidyah = $berasfidyah + (int)$value['beras_pemberi'];
                    $uangfidyah = $uangfidyah + (int)$value['uang_pemberi'];
                }
            }
        }
    endforeach;

    foreach($data->getPenerima() as $value):
        if($value['status_penerima'] == "0")
        {
            $penerima = $penerima + 1;
        }
    endforeach;

    if($beras == 0)
    {
        $beraspenerima = 0;
    }
    else{
        $beraspenerima = $beras / $penerima;
    }

    if($uang == 0)
    {
        $uangpenerima = 0;
    }
    else{
        $uangpenerima = $uang / $penerima;
    }
    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index Page</title>
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
        .btn{ margin-left:110px; }
    </style>
</head>                 
<body>
    <header style="background-color: black; color: white; background-image:url(zakat.jpg); background-repeat: no-repeat;background-size: 100% 100%; height: 300px;">
    </header>

    <nav class="navbar">
        <a href="index.php">Zakat</a>
        <a href="pemberi.php">Pemberi</a>
        <a href="panitia.php">Panitia</a>
        <a href="penerima.php">Penerima</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div>

        <div class="container" style="margin-top: 40px">
            <section class="home-section">
                <div class="home-content">
                    <h1 style="text-align:center; font-weight:bold;">TOTAL YANG DITERIMA :</h1>
                    <div class="row" style="text-align:center;margin-top:30px">
                        <div class="col-sm-4">
                            <h2>Pemberi :</h2>
                            <h3 style="font-weight:bold"><?php echo $pemberi; ?> Orang</h3>
                        </div>
                        <div class="col-sm-4">
                            <h2>Beras :</h2>
                            <h3 style="font-weight:bold"><?php echo $beras; ?> Kg</h3>
                        </div>
                        <div class="col-sm-4">
                            <h2>Uang :</h2>
                            <h3 style="font-weight:bold">Rp. <?php echo $uang; ?></h3>
                        </div>
                    </div>

                    <div class="row" style="text-align:center;margin-top:50px">
                        <div class="col-sm-3">
                            <h3>Zakat Fitrah</h3>
                            <h4>Uang : Rp. <?php echo $uangfitrah; ?></h4>
                            <h4>Beras : <?php echo $berasfitrah; ?> Kg</h4>
                        </div>
                        <div class="col-sm-3">
                            <h3>Zakat Mal</h3>
                            <h4>Uang : Rp. <?php echo $uangmal; ?></h4>
                            <h4>Beras : <?php echo $berasmal; ?> Kg</h4>
                        </div>
                        <div class="col-sm-3">
                            <h3>Sedekah</h3>
                            <h4>Uang : Rp. <?php echo $uangsedekah; ?></h4>
                            <h4>Beras : <?php echo $berassedekah; ?> Kg</h4>
                        </div>
                        <div class="col-sm-3">
                            <h3>Fidyah</h3>
                            <h4>Uang : Rp. <?php echo $uangfidyah; ?></h4>
                            <h4>Beras : <?php echo $berasfidyah; ?> Kg</h4>
                        </div>
                    </div>

                    <h1 style="text-align:center; margin-top:100px">Total Penerima Zakat : <b><?php echo $penerima; ?> Orang</b></h1>
                    <h2 style="text-align:center; margin-top:20px">Setiap Penerima Berhak Mendapat : <b><?php echo $beraspenerima; ?> Kg Beras</b> dan <b>Rp. <?php echo $uangpenerima; ?> Uang Tunai</b></h2>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
</html> 