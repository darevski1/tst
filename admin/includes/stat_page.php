
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
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c1" value="0" onKeyUp="CalculateRowTable_1(1, 1, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c2" value="0" onKeyUp="CalculateRowTable_1(1, 1, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c3" value="0" onKeyUp="CalculateRowTable_1(1, 1, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c4" value="0" onKeyUp="CalculateRowTable_1(1, 1, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c5" value="0" onKeyUp="CalculateRowTable_1(1, 1, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c6" value="0" onKeyUp="CalculateRowTable_1(1, 1, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r1" id="t1r1c7" value="0" onKeyUp="CalculateRowTable_1(1, 1, 7, this)"/></td>
            <td id="t1r1c8">$0</td>

        </tr>
        <tr>
            <td style="font-weight:bold">Actual (Total)</td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c1" value="0" onKeyUp="CalculateRowTable_1(1, 2, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c2" value="0" onKeyUp="CalculateRowTable_1(1, 2, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c3" value="0" onKeyUp="CalculateRowTable_1(1, 2, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c4" value="0" onKeyUp="CalculateRowTable_1(1, 2, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c5" value="0" onKeyUp="CalculateRowTable_1(1, 2, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c6" value="0" onKeyUp="CalculateRowTable_1(1, 2, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t1r2" id="t1r2c7" value="0" onKeyUp="CalculateRowTable_1(1, 2, 7, this)"/></td>
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
                <th colspan="10" style="text-align:center; font-weight:bold">WEEKLY COGS</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="text-align:left; font-weight:bold">Purchase Allotment</td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c1" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c2" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c3" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c4" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c5" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c6" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td><input  type="text" class="form-controler-sm" name="t2r1" id="t2r1c7" value="0" 
                            onKeyUp="limitIntegerReal(this, 0); CalculateTotalTable_2()"/></td>
                <td id="t2r1c8" style="background: #91c9d5">Budget</td>
                <td id="t2r1c9" style="background: #bbddf9">Variance</td>
                
            </tr>
            <tr>
                <td style="text-align:left; font-weight:bold">LITERATURE </td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c1" value="0" onKeyUp="CalculateRowTable_2(2, 2, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c2" value="0" onKeyUp="CalculateRowTable_2(2, 2, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c3" value="0" onKeyUp="CalculateRowTable_2(2, 2, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c4" value="0" onKeyUp="CalculateRowTable_2(2, 2, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c5" value="0" onKeyUp="CalculateRowTable_2(2, 2, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c6" value="0" onKeyUp="CalculateRowTable_2(2, 2, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r2" id="t2r2c7" value="0" onKeyUp="CalculateRowTable_2(2, 2, 7, this)"/></td>
                <td id="t2r2c8" style="background: #91c9d5"></td>
                <td id="t2r2c9" style="background: #bbddf9"></td>
            </tr>
        
            <tr>
                <td style="  font-weight:bold">MARKETING</td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c1" value="0" onKeyUp="CalculateRowTable_2(2, 3, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c2" value="0" onKeyUp="CalculateRowTable_2(2, 3, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c3" value="0" onKeyUp="CalculateRowTable_2(2, 3, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c4" value="0" onKeyUp="CalculateRowTable_2(2, 3, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c5" value="0" onKeyUp="CalculateRowTable_2(2, 3, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c6" value="0" onKeyUp="CalculateRowTable_2(2, 3, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r3" id="t2r3c7" value="0" onKeyUp="CalculateRowTable_2(2, 3, 7, this)"/></td>
                <td id="t2r3c8" style="background: #91c9d5"></td>
                <td id="t2r3c9" style="background: #bbddf9"></td>

            </tr>
            <tr>
                <td style="  font-weight:bold">BROWN BAG LUNCH</td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c1" value="0" onKeyUp="CalculateRowTable_2(2, 4, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c2" value="0" onKeyUp="CalculateRowTable_2(2, 4, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c3" value="0" onKeyUp="CalculateRowTable_2(2, 4, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c4" value="0" onKeyUp="CalculateRowTable_2(2, 4, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c5" value="0" onKeyUp="CalculateRowTable_2(2, 4, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c6" value="0" onKeyUp="CalculateRowTable_2(2, 4, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r4" id="t2r4c7" value="0" onKeyUp="CalculateRowTable_2(2, 4, 7, this)"/></td>
                <td id="t2r4c8" style="background: #91c9d5"></td>
                <td id="t2r4c9" style="background: #bbddf9"></td>
            </tr>
            <tr>
                <td style="font-weight:bold">OFFICE SUPPLY</td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c1" value="0" onKeyUp="CalculateRowTable_2(2, 5, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c2" value="0" onKeyUp="CalculateRowTable_2(2, 5, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c3" value="0" onKeyUp="CalculateRowTable_2(2, 5, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c4" value="0" onKeyUp="CalculateRowTable_2(2, 5, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c5" value="0" onKeyUp="CalculateRowTable_2(2, 5, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c6" value="0" onKeyUp="CalculateRowTable_2(2, 5, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r5" id="t2r5c7" value="0" onKeyUp="CalculateRowTable_2(2, 5, 7, this)"/></td>
                <td id="t2r5c8" style="background: #91c9d5"></td>
                <td id="t2r5c9" style="background: #bbddf9"></td>
            </tr>
            <tr>
                <td style="font-weight:bold">OPERATIONS</td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c1" value="13" onKeyUp="CalculateRowTable_2(2, 6, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c2" value="13" onKeyUp="CalculateRowTable_2(2, 6, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c3" value="13" onKeyUp="CalculateRowTable_2(2, 6, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c4" value="13" onKeyUp="CalculateRowTable_2(2, 6, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c5" value="13" onKeyUp="CalculateRowTable_2(2, 6, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c6" value="13" onKeyUp="CalculateRowTable_2(2, 6, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r6" id="t2r6c7" value="13" onKeyUp="CalculateRowTable_2(2, 6, 7, this)"/></td>
                <td id="t2r6c8" style="background: #91c9d5"></td>
                <td id="t2r6c9" style="background: #bbddf9"></td>
            </tr>
            <tr>
                <td style="font-weight:bold">MISC</td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c1" value="0" onKeyUp="CalculateRowTable_2(2, 7, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c2" value="0" onKeyUp="CalculateRowTable_2(2, 7, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c3" value="0" onKeyUp="CalculateRowTable_2(2, 7, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c4" value="0" onKeyUp="CalculateRowTable_2(2, 7, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c5" value="0" onKeyUp="CalculateRowTable_2(2, 7, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c6" value="0" onKeyUp="CalculateRowTable_2(2, 7, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t2r7" id="t2r7c7" value="0" onKeyUp="CalculateRowTable_2(2, 7, 7, this)"/></td>
                <td id="t2r7c8" style="background: #91c9d5"></td>
                <td id="t2r7c9" style="background: #bbddf9"></td>
            </tr>
            <tr style="background: #91c9d5">
                <td style="font-weight:bold">Actual</td>
                <td id="t2r8c1">$0</td>
                <td id="t2r8c2">$0</td>
                <td id="t2r8c3">$0</td>
                <td id="t2r8c4">$0</td>
                <td id="t2r8c5">$0</td>
                <td id="t2r8c6">$0</td>
                <td id="t2r8c7">$0</td>
                <td id="t2r8c8">$0</td>
                <td id="t2r8c9" style="background: #bbddf9">$0</td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="background: #bbddf9; font-weight:bold">
                <td style="text-align:left">Variance</td>
                <td id="t2r9c1">$0</td>
                <td id="t2r9c2">$0</td>
                <td id="t2r9c3">$0</td>
                <td id="t2r9c4">$0</td>
                <td id="t2r9c5">$0</td>
                <td id="t2r9c6">$0</td>
                <td id="t2r9c7">$0</td>
                <td id="t2r9c8">$0</td>
                <td id="t2r9c9">$0</td>

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
                <td style="text-align:center; font-weight:bold">Labor </td>
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
                <td style="font-weight:normal" id="t3r0c1"> $0</td>
                <td style="font-weight:normal" id="t3r0c2"> $0</td>
                <td style="font-weight:normal" id="t3r0c3"> $0</td>
                <td style="font-weight:normal" id="t3r0c4"> $0</td>
                <td style="font-weight:normal" id="t3r0c5"> $0</td>
                <td style="font-weight:normal" id="t3r0c6"> $0</td>
                <td style="font-weight:normal" id="t3r0c7"> $0</td>
                <td style="font-weight:normal" id="t3r0c8"> $0</td>

            </tr>
            <tr>
                <td style="text-align:center; font-style:italic">Office Assistant</td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c1" value="0" onKeyUp="CalculateRowTable_1(3, 1, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c2" value="0" onKeyUp="CalculateRowTable_1(3, 1, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c3" value="0" onKeyUp="CalculateRowTable_1(3, 1, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c4" value="0" onKeyUp="CalculateRowTable_1(3, 1, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c5" value="0" onKeyUp="CalculateRowTable_1(3, 1, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c6" value="0" onKeyUp="CalculateRowTable_1(3, 1, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r1" id="t3r1c7" value="0" onKeyUp="CalculateRowTable_1(3, 1, 7, this)"/></td>
                <td id="t3r1c8">$0</td>
            </tr>
            <tr>
                <td style="text-align:center; font-style:italic">Other</td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c1" value="0" onKeyUp="CalculateRowTable_1(3, 2, 1, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c2" value="0" onKeyUp="CalculateRowTable_1(3, 2, 2, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c3" value="0" onKeyUp="CalculateRowTable_1(3, 2, 3, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c4" value="0" onKeyUp="CalculateRowTable_1(3, 2, 4, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c5" value="0" onKeyUp="CalculateRowTable_1(3, 2, 5, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c6" value="0" onKeyUp="CalculateRowTable_1(3, 2, 6, this)"/></td>
                <td><input type="text" class="form-controler-sm" name="t3r2" id="t3r2c7" value="0" onKeyUp="CalculateRowTable_1(3, 2, 7, this)"/></td>
                <td id="t3r2c8">$0</td>
            </tr>
            <tr style="background: #91c9d5">
                <td style="text-align:left; ">Actual</td>
                <td id="t3r3c1">$0</td>
                <td id="t3r3c2">$0</td>
                <td id="t3r3c3">$0</td>
                <td id="t3r3c4">$0</td>
                <td id="t3r3c5">$0</td>
                <td id="t3r3c6">$0</td>
                <td id="t3r3c7">$0</td>
                <td id="t3r3c8">$0</td>
            </tr>
            <tr style="background: #bbddf9; ">
                <td style="text-align:center; ">Variance</td>
                <td id="t3r4c1">$0</td>
                <td id="t3r4c2">$0</td>
                <td id="t3r4c3">$0</td>
                <td id="t3r4c4">$0</td>
                <td id="t3r4c5">$0</td>
                <td id="t3r4c6">$0</td>
                <td id="t3r4c7">$0</td>
                <td id="t3r4c8">$0</td>
            </tr>
        </tbody>
        <tfoot  style="background: #ffffff;">
            <tr>
                <td style="text-align:left; ">Actual % of Actual Sales</td>
                <td id="t3r5c1">$0</td>
                <td id="t3r5c2">$0</td>
                <td id="t3r5c3">$0</td>
                <td id="t3r5c4">$0</td>
                <td id="t3r5c5">$0</td>
                <td id="t3r5c6">$0</td>
                <td id="t3r5c7">$0</td>
                <td id="t3r5c8">$0</td>

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
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c1" value="175" onKeyUp="CalculateRowTable_1(4, 1, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c2" value="175" onKeyUp="CalculateRowTable_1(4, 1, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c3" value="175" onKeyUp="CalculateRowTable_1(4, 1, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c4" value="175" onKeyUp="CalculateRowTable_1(4, 1, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c5" value="175" onKeyUp="CalculateRowTable_1(4, 1, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c6" value="175" onKeyUp="CalculateRowTable_1(4, 1, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r1" id="t4r1c7" value="175" onKeyUp="CalculateRowTable_1(4, 1, 7, this)"/></td>
            <td id="t4r1c8">$0</td>

        </tr>

        <tr>
            <td style="text-align:center; font-style:italic">Counselor</td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c1" value="0" onKeyUp="CalculateRowTable_1(4, 2, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c2" value="0" onKeyUp="CalculateRowTable_1(4, 2, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c3" value="0" onKeyUp="CalculateRowTable_1(4, 2, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c4" value="0" onKeyUp="CalculateRowTable_1(4, 2, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c5" value="0" onKeyUp="CalculateRowTable_1(4, 2, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c6" value="0" onKeyUp="CalculateRowTable_1(4, 2, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t4r2" id="t4r2c7" value="0" onKeyUp="CalculateRowTable_1(4, 2, 7, this)"/></td>
            <td id="t4r2c8">$0</td>

        </tr>
        
        <tr style="background: #91c9d5">
            <td style="text-align:left;">Actual</td>
            <td id="t4r3c1">$0</td>
            <td id="t4r3c2">$0</td>
            <td id="t4r3c3">$0</td>
            <td id="t4r3c4">$0</td>
            <td id="t4r3c5">$0</td>
            <td id="t4r3c6">$0</td>
            <td id="t4r3c7">$0</td>
            <td id="t4r3c8">$0</td>
        </tr>
        <tr style="background: #bbddf9; ">
            <td style="text-align:center;">Variance</td>
            <td style="font-weight:normal" id="t4r4c1">$0</td>
            <td style="font-weight:normal" id="t4r4c2">$0</td>
            <td style="font-weight:normal" id="t4r4c3">$0</td>
            <td style="font-weight:normal" id="t4r4c4">$0</td>
            <td style="font-weight:normal" id="t4r4c5">$0</td>
            <td style="font-weight:normal" id="t4r4c6">$0</td>
            <td style="font-weight:normal" id="t4r4c7">$0</td>
            <td style="font-weight:normal" id="t4r4c8">$0</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:left; font-weight:bold">Actual % of Actual Sales</td>
            <td id="t4r5c1">$0</td>
            <td id="t4r5c2">$0</td>
            <td id="t4r5c3">$0</td>
            <td id="t4r5c4">$0</td>
            <td id="t4r5c5">$0</td>
            <td id="t4r5c6">$0</td>
            <td id="t4r5c7">$0</td>
            <td id="t4r5c8">$0</td>

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
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c1" value="175" onKeyUp="CalculateRowTable_1(5, 1, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c2" value="175" onKeyUp="CalculateRowTable_1(5, 1, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c3" value="175" onKeyUp="CalculateRowTable_1(5, 1, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c4" value="175" onKeyUp="CalculateRowTable_1(5, 1, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c5" value="175" onKeyUp="CalculateRowTable_1(5, 1, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c6" value="175" onKeyUp="CalculateRowTable_1(5, 1, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r1" id="t5r1c7" value="175" onKeyUp="CalculateRowTable_1(5, 1, 7, this)"/></td>
            <td style="font-weight:normal" id="t5r1c8"> $0</td>

        </tr>

        <tr>
            <td style="text-align:center; font-style:italic">Management</td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c1" value="0" onKeyUp="CalculateRowTable_1(5, 2, 1, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c2" value="0" onKeyUp="CalculateRowTable_1(5, 2, 2, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c3" value="0" onKeyUp="CalculateRowTable_1(5, 2, 3, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c4" value="0" onKeyUp="CalculateRowTable_1(5, 2, 4, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c5" value="0" onKeyUp="CalculateRowTable_1(5, 2, 5, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c6" value="0" onKeyUp="CalculateRowTable_1(5, 2, 6, this)"/></td>
            <td><input type="text" class="form-controler-sm" name="t5r2" id="t5r2c7" value="0" onKeyUp="CalculateRowTable_1(5, 2, 7, this)"/></td>
            <td id="t5r2c8">$0</td>
        </tr>
     
        <tr style="background: #91c9d5">
            <td style="text-align:left;">Actual</td>
            <td id="t5r3c1">$0</td>
            <td id="t5r3c2">$0</td>
            <td id="t5r3c3">$0</td>
            <td id="t5r3c4">$0</td>
            <td id="t5r3c5">$0</td>
            <td id="t5r3c6">$0</td>
            <td id="t5r3c7">$0</td>
            <td id="t5r3c8">$0</td>
        </tr>
        <tr style="background: #bbddf9;">
            <td style="text-align:center; ">Variance</td>
            <td id="t5r4c1">$0</td>
            <td id="t5r4c2">$0</td>
            <td id="t5r4c3">$0</td>
            <td id="t5r4c4">$0</td>
            <td id="t5r4c5">$0</td>
            <td id="t5r4c6">$0</td>
            <td id="t5r4c7">$0</td>
            <td id="t5r4c8">$0</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align:left; ">Actual % of Actual Sales</td>
            <td id="t5r5c1">$0</td>
            <td id="t5r5c2">$0</td>
            <td id="t5r5c3">$0</td>
            <td id="t5r5c4">$0</td>
            <td id="t5r5c5">$0</td>
            <td id="t5r5c6">$0</td>
            <td id="t5r5c7">$0</td>
            <td id="t5r5c8">$0</td>

        </tr>
        <tr>
         <td colspan="7" style="border-bottom: 1px solid #F8F9FC; border-left: 1px solid #F8F9FC; background: #F8F9FC"> </td>
            <td style="font-weight:bold;">Total Labor</td>
            <td style="font-weight:bold;" id="t5r6c1">$0</td>

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
            <td style="background: #bbddf9;">$0</td>
        </tr>
        <tr>
            <td style="text-align:left; font-weight:bold">Total Labor</td>
            <td>$0</td>
            <td>$0</td>
            <td style="background: #bbddf9;">$0</td>
        </tr>
        <tr>
            <td> </td>
            <td>$    -</td>
            <td>$    -</td>
            <td style="background: #bbddf9;">$    -</td>
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