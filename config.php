<?php   
    class Databases{  
        public $con;  
        public function __construct(){  
            $this->con = mysqli_connect("localhost", "root", "", "utszaki");  
            if(!$this->con)  
            {  
                    echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
            }  
        }

        public function checkLoginPage(){
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                header("location: index.php");
                exit;
            }
        }

        public function checkLogin(){
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
                header("location: login.php");
                exit;
            }
        }
        
        public function login($username, $password){
            if($username == "admin"){           
                if($password == "12345"){
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;                                   
                    header("location: index.php");
                } else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        public function getPemberi()
        {
            $array = array();  
            $query = "SELECT tb_pemberi.id_pemberi, tb_pemberi.panitia_pemberi, tb_panitia.nama_panitia, tb_pemberi.nama_pemberi, tb_pemberi.alamat_pemberi, tb_pemberi.type_pemberi, tb_pemberi.beras_pemberi, tb_pemberi.uang_pemberi FROM tb_pemberi JOIN tb_panitia ON tb_panitia.id_panitia = tb_pemberi.panitia_pemberi";  
            $result = mysqli_query($this->con, $query);  
            while($row = mysqli_fetch_assoc($result))  
            {  
                    $array[] = $row;  
            }  
            return $array;
        }

        public function addPemberi($panitiapemberi, $namapemberi, $alamatpemberi, $typepemberi, $beraspemberi, $uangpemberi)
        {
            $query = "INSERT INTO tb_pemberi (panitia_pemberi, nama_pemberi, alamat_pemberi, type_pemberi, beras_pemberi, uang_pemberi) VALUES ('$panitiapemberi', '$namapemberi', '$alamatpemberi', '$typepemberi', '$beraspemberi', '$uangpemberi')";  
            if(mysqli_query($this->con, $query))  
            {  
                    return true;  
            }  
            else  
            {  
                    echo mysqli_error($this->con);  
            }  
        }

        public function editPemberi($idpemberi,$panitiapemberi,$namapemberi,$alamatpemberi, $typepemberi, $beraspemberi, $uangpemberi)
        {
            $query = "UPDATE tb_pemberi SET panitia_pemberi='$panitiapemberi', nama_pemberi='$namapemberi', alamat_pemberi='$alamatpemberi', type_pemberi='$typepemberi', beras_pemberi='$beraspemberi', uang_pemberi='$uangpemberi' WHERE id_pemberi='$idpemberi'";  
            if(mysqli_query($this->con, $query))  
            {  
                    return true;  
            }  
            else  
            {  
                    echo mysqli_error($this->con);  
            }  
        }

        public function deletePemberi($idpemberi)
        {
            $query = "DELETE FROM tb_pemberi WHERE id_pemberi=$idpemberi";  
            $result = mysqli_query($this->con, $query);   
            return true;
        }

        public function getPanitia()
        {
            $array = array();  
            $query = "SELECT * FROM tb_panitia";  
            $result = mysqli_query($this->con, $query);  
            while($row = mysqli_fetch_assoc($result))  
            {  
                    $array[] = $row;  
            }  
            return $array;
        }

        public function addPanitia($namapanitia ,$alamatpanitia)
        {
            $query = "INSERT INTO tb_panitia (nama_panitia, alamat_panitia) VALUES ('$namapanitia' ,'$alamatpanitia')";  
            if(mysqli_query($this->con, $query))  
            {  
                    return true;  
            }  
            else  
            {  
                    echo mysqli_error($this->con);  
            }  
        }

        public function editPanitia($idpanitia, $namapanitia, $alamatpanitia)
        {
            $query = "UPDATE tb_panitia SET nama_panitia='$namapanitia', alamat_panitia='$alamatpanitia' WHERE id_panitia='$idpanitia'";  
            if(mysqli_query($this->con, $query))  
            {  
                    return true;  
            }  
            else  
            {  
                    echo mysqli_error($this->con);  
            }  
        }

        public function deletePanitia($idpanitia)
        {
            $query = "DELETE FROM tb_panitia WHERE id_panitia=$idpanitia";  
            $result = mysqli_query($this->con, $query);   
            return true;
        }

        public function getPenerima()
        {
            $array = array();  
            $query = "SELECT * FROM tb_penerima";  
            $result = mysqli_query($this->con, $query);  
            while($row = mysqli_fetch_assoc($result))  
            {  
                    $array[] = $row;  
            }  
            return $array;
        }

        public function addPenerima($namapenerima ,$alamatpenerima)
        {
            $query = "INSERT INTO tb_penerima (nama_penerima, alamat_penerima) VALUES ('$namapenerima' ,'$alamatpenerima')";  
            if(mysqli_query($this->con, $query))  
            {  
                    return true;  
            }  
            else  
            {  
                    echo mysqli_error($this->con);  
            }  
        }

        public function editPenerima($idpenerima, $namapenerima, $alamatpenerima, $statuspenerima)
        {
            $query = "UPDATE tb_penerima SET nama_penerima='$namapenerima', alamat_penerima='$alamatpenerima', status_penerima='$statuspenerima' WHERE id_penerima='$idpenerima'";  
            if(mysqli_query($this->con, $query))  
            {  
                    return true;  
            }  
            else  
            {  
                    echo mysqli_error($this->con);  
            }  
        }

        public function deletePenerima($idpenerima)
        {
            $query = "DELETE FROM tb_penerima WHERE id_penerima=$idpenerima";  
            $result = mysqli_query($this->con, $query);   
            return true;
        }

        public function logout()
        {
            session_start();
            $_SESSION = array();
            session_destroy();
            header("location: login.php");
            exit;
        }
    }  
?>