<?php
	
	
    
    function GetMessages($renovation_estimate_id, $home_user_id = 0){

        $query = "SELECT user_id_from, message, time_sent 
                  FROM messages
                  WHERE renovation_id = $renovation_estimate_id
                  ORDER BY time_sent ASC";

        $rows = QuerySelect($query);

        $html = '';

        $dot = GetDot();

        for($i = 0; $i < count($rows); $i++)
            if(intval($rows[$i]['user_id_from']) == $home_user_id)
                $html .= '<div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    ' . $rows[$i]['message'] . ' 
                                    <span class="msg_time_send">' . ConvertDB_DateTimeToUSFormat($rows[$i]['time_sent']) . '</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="' . $dot . '../assets/user_images/user_two.png"
                                        class="rounded-circle user_img_msg">
                                </div>
                            </div>';
            else
                $html .= '<div class="d-flex justify-content-start mb-4">
                                    <div class="img_cont_msg">
                                        <img src="' . $dot . '../assets/user_images/user_one.png"
                                            class="rounded-circle user_img_msg">
                                    </div>
                                    <div class="msg_cotainer">
                                        ' . $rows[$i]['message'] . '
                                        <span class="msg_time">' . ConvertDB_DateTimeToUSFormat($rows[$i]['time_sent']) . '</span>
                                    </div>
                                </div>';


        return $html;
        

    }


    function GetDot(){

        $dot = '';

        $url_path = $_SERVER['REQUEST_URI'];

        if(strpos($url_path, 'admin/') !== false)
            $dot = '../';

        return $dot;

    }

    
    function CreateNewHomeUserMessage($message){

        $dot = GetDot();

        $html = '<div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                        ' . $message . ' 
                        <span class="msg_time_send">now</span>
                    </div>
                    <div class="img_cont_msg">
                        <img src="' . $dot . '../assets/user_images/user_two.png"
                            class="rounded-circle user_img_msg">
                    </div>
                </div>';
        
        return $html;
    }

?>