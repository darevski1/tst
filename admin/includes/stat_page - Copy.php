
<?php 
 
function GetStatPage(){
	
	$return_string = '';
	
	$return_string .= '<div id="content_stat_page" class="container-fluid" style="display:none" >'; 
	$return_string .= '		<h1 class="h3 mb-4 text-gray-800">Documents</h1>';
	$return_string .= 	getTableOne();
	$return_string .= 	getTableTwo();
	$return_string .= 	getTableThree();
	$return_string .= 	getTableFour();
	$return_string .= 	getTableFive();
	$return_string .= 	getTableSix();
		
 
	$return_string .= '</div>';
	
	return $return_string;	
}





 
function getTableOne(){
    
    $return_string = '';
    $return_string .= '

    <table class="table calcs">
    <thead>
        <tr>
            <th></th>
            <th>MON</th>
            <th>TUE</th>
            <th>WED</th>
            <th>THUR</th>
            <th>FRI</th>
            <th>SAT</th>
            <th>SUN</th>
            <th> </th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td style="font-weight:bold">DATE: </td>
            <td>24-May</td>
            <td>25-May</td>
            <td>26-May</td>
            <td>27-May</td>
            <td>28-May</td>
            <td>29-May</td>
            <td>30-May</td>
            <td>WTD</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align:center; font-weight:bold">Sales </td>


        </tr>
        <tr>
            <td style=" font-weight:bold">Forecasted (Total)</td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c1" value="0" onKeyUp="CalculateRow(1, 1, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c2" value="0" onKeyUp="CalculateRow(1, 1, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c3" value="0" onKeyUp="CalculateRow(1, 1, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c4" value="0" onKeyUp="CalculateRow(1, 1, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c5" value="0" onKeyUp="CalculateRow(1, 1, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c6" value="0" onKeyUp="CalculateRow(1, 1, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c7" value="0" onKeyUp="CalculateRow(1, 1, 7, this)"/></td>
            <td id="t1r1c8">$0</td>

        </tr>
        <tr>
            <td style="font-weight:bold">Actual (Total)</td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c1" value="0" onKeyUp="CalculateRow(1, 2, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c2" value="0" onKeyUp="CalculateRow(1, 2, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c3" value="0" onKeyUp="CalculateRow(1, 2, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c4" value="0" onKeyUp="CalculateRow(1, 2, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c5" value="0" onKeyUp="CalculateRow(1, 2, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c6" value="0" onKeyUp="CalculateRow(1, 2, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c7" value="0" onKeyUp="CalculateRow(1, 2, 7, this)"/></td>
            <td id="t1r2c8">$0</td>
        </tr>
        <tr>
            <td style="font-weight:bold">Counseling</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
        <tr>
            <td style="font-weight:bold">Community service</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
            <td style="font-weight:bold">Donations</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
    </tbody>
    <tfoot style="background: #bbddf9;">
        <tr>
            <td style="font-weight:bold">Variance Forecast vs Actual</td>
            <td id="t1r6c1">$0</td>
            <td id="t1r6c2">$0</td>
            <td id="t1r6c3">$0</td>
            <td id="t1r6c4">$0</td>
            <td id="t1r6c5">$0</td>
            <td id="t1r6c6">$0</td>
            <td id="t1r6c7">$0</td>
            <td id="t1r6c8">$0</td>

        </tr>
    </tfoot>
</table>
        ';


    return $return_string;	

}
 
function getTableTwo(){
    
    $return_string = '';
    $return_string .= '

    <table class="table calcs m2">
        <thead>
       
            <tr>
                <th colspan="9">WEEKLY COGS</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="text-align:left; font-weight:bold">Purchase Allotment </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Budget</td>
                <td>Variance</td>
                
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">LITERATURE </td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
        
            <tr>
                <td style="  font-weight:bold">SOCIAL MEDIA</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>

            </tr>
            <tr>
                <td style="  font-weight:bold">PHONE</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr>
                <td style="font-weight:bold">OFFICE SUPPLY</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr>
                <td style="font-weight:bold">ACCOUNTING</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr>
                <td style="font-weight:bold">MISC</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr style="background: #91c9d5">
                <td style="font-weight:bold">Actual</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="background: #bbddf9; font-weight:bold">
                <td style="text-align:left">Variance</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>
                <td style="font-weight:normal">$0</td>

            </tr>
        </tfoot>
    </table>

        ';


    return $return_string;	

}
 
function getTableThree(){
    
    $return_string = '';
    $return_string .= '

    <table class="table  calcs">
 

        <tbody>
            <tr>
                <td style="text-align:left; font-weight:bold">Labor </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
 
            </tr>

            <tr>
                <td style="text-align:left; font-weight:bold">Budget</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>
                <td style="font-weight:normal"> $0</td>

            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Office Assistant</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Other</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Actual</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">Variance</td>
                <td style="background: #bbddf9;">$0</td>
                <td style="background: #bbddf9; ">$0</td>
                <td style="background: #bbddf9; ">$0</td>
                <td style="background: #bbddf9; ">$0</td>
                <td style="background: #bbddf9; ">$0</td>
                <td style="background: #bbddf9; ">$0</td>
                <td style="background: #bbddf9; ">$0</td>
                <td style="background: #bbddf9; ">$0</td>
            </tr>
            </td>
            </tr>
        </tbody>
        <tfoot  style="background: #ffffff;">
            <tr>
                <td style="text-align:left; font-weight:bold">Actual % of Actual Sales</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>
                <td>$0</td>

            </tr>
        </tfoot>
    </table>

        ';


    return $return_string;	

}
 
function getTableFour(){
    
    $return_string = '';
    $return_string .= '
    <table class="table  calcs">
 

    <tbody>
        <tr>
            <td style="text-align:left; font-weight:bold">Budget </td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>

        </tr>

        <tr>
            <td style="text-align:left; font-weight:bold">Counselor</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>

        </tr>
        <tr>
            <td></td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Actual</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Variance</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
            <td style="font-weight:normal">$0</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Actual % of Actual Sales</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
        </tr>
        </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:left; font-weight:bold">Actual % of Actual Sales</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>

        </tr>
    </tfoot>
</table>

        ';


    return $return_string;	

}
function getTableFive(){
    
    $return_string = '';
    $return_string .= '
    <table class="table  calcs">
 

    <tbody>
        <tr>
            <td style="text-align:left; font-weight:bold">Budget </td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>

        </tr>

        <tr>
            <td style="text-align:left; font-weight:bold">Management</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>

        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Management</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
            <td style="font-weight:normal"> $0</td>
     
        <tr>
            <td style="text-align:left; font-weight:bold">Actual</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Variance</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
            <td style="background: #bbddf9; ">$0</td>
        </tr>

        </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:left; font-weight:bold">Actual % of Actual Sales</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>

        </tr>
        <tr>
         <td colspan="7" style="border-bottom: 1px solid #F8F9FC; border-left: 1px solid #F8F9FC; background: #F8F9FC"> </td>
            <td>$0</td>
            <td>$0</td>

        </tr>
    </tfoot>
</table>

        ';


    return $return_string;	

}
function getTableSix(){
    
    $return_string = '';
    $return_string .= '

    <table class="table  calcs">
    <tbody>
        <tr>
            <td style="text-align:left; font-weight:bold">Next Week Budget  </td>
            <td>5/31-6/6</td>
            <td>$ </td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td>Budget</td>
            <td>Actual</td>
            <td>Variance</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Total Purchases</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Total Labor</td>
            <td>$0</td>
            <td>$0</td>
            <td>$0</td>
        </tr>
        <tr>
            <td> </td>
            <td>$    -</td>
            <td>$    -</td>
            <td>$    -</td>
        </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style="border-bottom: 1px solid #F8F9FC; border-left: 1px solid #F8F9FC; background: #F8F9FC; font-weight:bold"> </td>
            <td colspan="2" style="text-align:center; font-weight:bold">Weekly Prime</td>
            <td>#DIV</td>
     

        </tr>
    </tfoot>
</table>
        ';


    return $return_string;	

}
    ?>