<?php session_start(); ?>
<?php

	include('../../../includes/db.php');
	include('../../../includes/config.php');
	include('../../../my-account/my_photos_videos/generators.php');

	ConnectToDatabase();

	$table   = 'users';
	$user_id = 'user_id';

	$loged_in = isLogedIn($table, $user_id);

	if($loged_in == false){
	    exit("1");
	}
	
    if(	isset($_FILES) 		  && count($_FILES) > 0 &&
    	isset($_GET['reuid']) && $_GET['reuid'] != "" &&
    	isset($_GET['t']) 	  && $_GET['t'] 	!= "" &&
    	isset($_GET['type'])  && $_GET['type'] 	!= ""){

        $renovation_unique_id 	= check_input($_GET['reuid']);
        $table 					= check_input($_GET['t']);
        $type 					= check_input($_GET['type']);

        $files_photos = "files_$type";

        $mime_type = "image/";
        if(strpos($type, "video") !== false)
        	$mime_type = "video/";

        $user_id = $_SESSION['user_id'];

        $user_unique_id = GetUniqueID_FromID($user_id, 'users');
        $renovation_id = GetID_FromUniqueID($renovation_unique_id, 'renovation_estimate_reports');

        $user_folder = "$table/$user_unique_id/";
        $renovation_folder = $user_folder . "$renovation_unique_id/";

        CreateFolder("../../../my-account/my_photos_videos/" . $user_folder);
        CreateFolder("../../../my-account/my_photos_videos/" . $renovation_folder);
        
        $count_files = count($_FILES[$files_photos]['name']);

        for($i = 0; $i < $count_files; $i++){

            $file = $_FILES[$files_photos]['tmp_name'][$i];

            $filename  = basename($_FILES[$files_photos]['name'][$i]);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            
            $mime = mime_content_type($file);

            // echo "mime:" . $mime;
            // echo 'type: ' . $_FILES[$files_photos]['type'][$i] . '<br />';
            // echo 'name: ' . $_FILES[$files_photos]['name'][$i] . '<br />';

            if(strstr($mime, $mime_type)){

                $file_path = $renovation_folder . uniqid() . "." . $extension;

                move_uploaded_file($file, "../../../my-account/my_photos_videos/" . $file_path);

                $file_path = "my_photos_videos/" . $file_path;

                $query = "INSERT INTO $table(id, renovation_estimate_id, user_id, file_path, upload_date)
                                VALUES(NULL, $renovation_id, $user_id, '$file_path', NOW())";

                QueryInsert($query);
            }
        }

        $html = GetRenovationPhotosVideos($renovation_id, $table, "../../my-account/");
	
		exit($html);

    }else
    	exit("2");


