<?php 

function GetDonationPage(){

    $return_string = '';
	$return_string .= '<div id="content_donation_page" class="container-fluid" style="display:none" >'; 
	$return_string .= '<h1 class="h3 mb-4 text-gray-800">Donations</h1>'; 
    $return_string .= 	creteDonation();
    

    $return_string .= 	getTable();
	$return_string .= '</div>';
	
 
	return $return_string;	
    

}

function creteDonation(){

    $return_string = '';

        $return_string .= ' <button type="button" class="btn btn-primary mb-3">Create New Donation</button>'; 

        $return_string .= '<div class="col-sm-12 br border-style p-3">';
        $return_string .= ' <h2 class=" text-gray-800">Create new donation</h2>'; 
    
        $return_string .= ' <form action="" method="POST">';
        $return_string .= ' <label for="donation name" class="text-gray-800">Donation Name</label>';
        $return_string .= ' <input type="text" name="donation_name" id="donation_name" class="form-control">';
        $return_string .= ' <button class="btn btn-dark mt-3" type="button" onClick="SaveDonation()">Save</button>';

        $return_string .= ' </div>';
 
	return $return_string;	

}
function getTable(){

    $rows = getTableData(); 
    $return_string = '';
    
        $return_string .= '<table class="table mt-5">';
        $return_string .= '<thead>';
        $return_string .= '<tr>';
        $return_string .= '<th scope="col">Id</th>';
        $return_string .= '<th scope="col">Donataion Name</th>';
        $return_string .= '<th scope="col">Created</th>';
        $return_string .= '<th scope="col">Status</th>';
        $return_string .= '<th scope="col">Edit</th>';
        $return_string .= '</tr>';
        $return_string .= '</thead>';
        $return_string .= '<tbody>';

        for($i = 0; $i < count($rows);  $i++)
		$return_string .= getTableRows($rows[$i], false);
   
    
        $return_string .= ' </tbody>';
    $return_string .= '</table>';
    return $return_string;	

}
 
function getTableRows($rows){

        $return_string = '';


     
        $return_string .= '<tr>';
        $return_string .= '<th scope="row">' . $rows['id'] . '</th>';
        $return_string .= '<td>' . $rows['donataion_name'] . '</td>';
        $return_string .= '<td>' . $rows['created_at'] . '</td>';
        $return_string .= '<td>' . GetDonationStatusCombobox($rows['id'], $rows['donation_status']) . '</td>'; 
        $return_string .= '<td><a href="./edit_pages/edit_donation.php?cuid=' . $rows['unique_id'] . '" class="btn btn-primary" target="_blank">Edit</a></td>'; 
   
       
        $return_string .= '</tr>';
  
    return $return_string;	

    
}

function getTableData(){
    $query = "SELECT * from donations";

    $rows = QuerySelect($query);

    if(is_array($rows))
        return $rows;
    
    return [];

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

    ?>

 