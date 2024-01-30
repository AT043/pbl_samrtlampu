<?php
//conn/library.php
#isinya adalah fungsi standar untuk pengiriman pesan sukses/error
#fungsi-fungsi kit tambahan lainnya juga bisa sekalian dimasukkan disini

function create_alert($type, $pesan, $header=null){
	$_SESSION['adm-type'] = $type;
	$_SESSION['adm-message'] = $pesan;

	if($header!==null){
		header("location:".$header);
		exit();
	}
}

function show_alert(){
	if(isset($_SESSION['adm-type'])){
		$type = ucfirst($_SESSION['adm-type']);
		unset($_SESSION['adm-type']);
		$message = $_SESSION['adm-message'];
		unset($_SESSION['adm-message']);

		echo "
		<script>alert('$type, <br> $message')</script>
		";
	}
}

function jadi_user(){
	if(isset($_GET['jadiuser_id'])){
        $adminJadiUser = $_GET['jadiuser_id'];

        // Assuming $con is your database connection
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $con->prepare($query);
        $stmt->bindParam(":username", $adminJadiUser);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($currentUser['id'] === 2) {
            $yahJadiUser = $con->prepare("UPDATE users SET permissions = 0 WHERE username = :username");
            $yahJadiUser->bindParam(":username", $adminJadiUser);

            if ($yahJadiUser->execute()) {
                //echo "<script>alert('Yakin mau dihapus?')</script>";
               	echo "<meta http-equiv=Refresh content=0;url=../admin/admin2.php>";
            } else {
                echo "<script>alert('Error Jadikan User Sebagai Admin.')</script>";
            }
        } else {
            echo "<script>alert('Maaf Anda tidak bisa!')</script>";
        }
    }
}

function jadi_admin(){
	if(isset($_GET['jadiadmin_id'])){
        $adminJadiUser = $_GET['jadiadmin_id'];

        // Assuming $con is your database connection
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $con->prepare($query);
        $stmt->bindParam(":username", $adminJadiUser);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($currentUser['id'] == 2) {
            $yahJadiUser = $con->prepare("UPDATE users SET permissions = 1 WHERE username = :username");
            $yahJadiUser->bindParam(":username", $adminJadiUser);

            if ($yahJadiUser->execute()) {
                //echo "<script>alert('Yakin mau dihapus?')</script>";
               	echo "<meta http-equiv=Refresh content=0;url=../admin/admin2.php>";
            } else {
                echo "<script>alert('Error Jadikan User Sebagai Admin.')</script>";
            }
        } else {
            echo "<script>alert('Maaf Anda tidak bisa!')</script>";
        }
    }
}

