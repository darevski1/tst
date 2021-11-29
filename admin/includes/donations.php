<?php 

function GetDonationPage(){

    $return_string = '';
	$return_string .= '<div id="content_donations" class="container-fluid" style="display:none" >'; 
	$return_string .= '    <h1 class="h3 mb-4 text-gray-800">Donations</h1>'; 

    $return_string .= '     <button type="button" class="btn btn-primary mb-3" onClick="$(\'#create_donation_div\').toggle()">Create New Donation</button>'; 
    $return_string .= CreateDonationsForm();
    

    $return_string .= '     <div id="donations_table_div" class="d-flex justify-content-center row">';
    $return_string .= 	         GetDonationsTable();
    $return_string .= '     </div>';
	$return_string .= '</div>';
	
 
	return $return_string;	
    

}

function CreateDonationsForm(){

    $return_string = '';

    $return_string .= '<div class="col-sm-12 br border-style p-3" id="create_donation_div" style="display:none">';
    $return_string .= '     <h2 class=" text-gray-800">Create new donation</h2>'; 
    $return_string .= '     <label for="donation name" class="text-gray-800">Donation Name</label>';
    $return_string .= '     <input type="text" name="donation_name" id="donation_name" class="form-control">';
    $return_string .= '     <button class="btn btn-dark mt-3" type="button" onClick="SaveDonation()">Save</button>';
    $return_string .= ' </div>';
 
	return $return_string;
}
 

function GetNewRowDonationsTable($rows){

        $return_string = '';

        $return_string .= '<tr>';
        $return_string .= '<td>' . $rows['donation_name'] . '</td>';
        $return_string .= '<td>' . GetDonationStaticPagesCombo($rows['id'], $rows['static_page_id']) . '</td>'; 
        $return_string .= '<td>' . GetDonationStatusCombobox($rows['id'], $rows['donation_status']) . '</td>'; 
        $return_string .= '<td>' . ChangeDateFormatPublicAmerican($rows['created_at']) . '</td>';
        $return_string .= '<td><a href="./edit_pages/edit_donation.php?cuid=' . $rows['unique_id'] . '" 
                                  class="btn btn-primary" target="_blank">Edit</a></td>'; 
   
        $return_string .= '</tr>';
  
    return $return_string;     
}



function GetDonationsRowsFromDB(){

    $query = "SELECT donation_name, donation_status, DATE(created_at) AS created_at, unique_id, static_page_id, id
              FROM donations 
              ORDER BY donation_name";

    $rows = QuerySelect($query);
        
    return $rows;
}


function GetDonationsTable(){
    echo "GetDonationsTable";
    $rows = GetDonationsRowsFromDB(); 

    $return_string = '';
    
    $return_string .= '<table class="table mt-5">';
    $return_string .= '     <thead>';
    $return_string .= '         <tr>';
    $return_string .= '             <th scope="col">Donation Name</th>';
    $return_string .= '             <th scope="col">Static Page</th>';
    $return_string .= '             <th scope="col">Status</th>';
    $return_string .= '             <th scope="col">Created</th>';
    $return_string .= '             <th scope="col">Edit</th>';
    $return_string .= '         </tr>';
    $return_string .= '     </thead>';
    $return_string .= '<tbody>';

    for($i = 0; $i < count($rows);  $i++)
	$return_string .= GetNewRowDonationsTable($rows[$i], false);


    $return_string .= ' </tbody>';
    $return_string .= '</table>';

    return $return_string;	
}
 

function GetDonationStatusCombobox($donation_id, $status){

	$html = '<select class="form-control" id="donation_status_combo_' . $donation_id . '" 
					 onchange="ChangeDonationStatus(' . $donation_id . ')">';

    if($status == "Active"){
        $html .= '<option value="Active" selected>Active</option>';
        $html .= '<option value="Inactive">Inactive</option>';
    }else{
        $html .= '<option value="Active">Active</option>';
        $html .= '<option value="Inactive" selected>Inactive</option>';
    }

    $html .= '</select>';

    return $html;
}



function GetDonationStaticPagesDB($static_page_id = 0){

    $where = "";

    if($static_page_id != 0)
        $where = " OR id = $static_page_id";

    $query = "SELECT id, page_name
              FROM static_pages
              WHERE id NOT IN (SELECT static_page_id FROM donations WHERE static_page_id IS NOT NULL) $where
              ORDER BY page_name ASC";

    $rows = QuerySelect($query);

    return $rows;
}




function GetDonationStaticPagesCombo($donation_id, $static_page_id){

    $rows = GetDonationStaticPagesDB($static_page_id);

    $html = '<select class="form-control" id="donation_static_page_combo_' . $donation_id . '" 
                     onChange="ChangeDonationStaticPage(' . $donation_id . ')">';
    
    $html .= '<option value="0">Select Static Page</option>';

    for($i = 0; $i < count($rows); $i++)
        if($rows[$i]["id"] == $static_page_id)
            $html .= '<option value="' . $rows[$i]["id"] . '" selected>' . $rows[$i]["page_name"] . '</option>';
        else
            $html .= '<option value="' . $rows[$i]["id"] . '">' . $rows[$i]["page_name"] . '</option>';
    
    $html .= '</select>';

    return $html;
}

?>

 