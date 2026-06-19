<?php
if(isset($_POST['joketext'])){
    try{
        include 'includes/DatabaseConnection.php';

        //fallback img
        $filename = 'default.png';
        //img upload
        if (isset($_FILES['jokeimg']) && $_FILES['jokeimg']['error'] == 0) {
            $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png'];
            $file_name = $_FILES['jokeimg']['name'];
            $file_type = $_FILES['jokeimg']['type'];
            
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            if (array_key_exists(strtolower($ext), $allowed)) {
                // Generate a unique name to avoid duplicate collisions
                $unique_filename = time() . '_' . $file_name;
                
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                if (move_uploaded_file($_FILES['jokeimg']['tmp_name'], $upload_dir . $unique_filename)) {
                    // User uploaded a valid image, override the preloaded default
                    $filename = $unique_filename; 
                }
            }
        }


        $sql = 'INSERT INTO joke SET
        joketext = :joketext,
        jokedate = CURDATE(),
        jokeimg = :jokeimg,
        authorid = :authorid';
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':jokeimg', $filename);
        $stmt->bindValue(':authorid', $_POST['authorid']);
        $stmt->execute();
        header('Location: jokes.php');
    }catch(PDOException $e){
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}else{
    $title = 'Add a new joke';
    ob_start();
    include 'templates/addjoke.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';