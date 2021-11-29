<div class="tab-pane fade" id="v_pills_my_courses" role="tabpanel" aria-labelledby="v_pills_my_courses_tab">
    <div class="d-flex justify-content-between  mb-3 mt-5">

        <div class="p-2 ">
            <h4 class="text-center">
                <button type="button" class="btn black_btn mt-3 w-300 btn-lg" onclick="PrintDocument()">Print your document</button>
            </h4>
        </div>
        <div class="p-2">
            <h5 class="text-center">Total number of courses</h5>

            <h4 class="text-center" id="number_of_courses_stat"></h4>
        </div>
        <div class="p-2">
            <h5 class="text-center">Total time read</h5>
            <h4 class="text-center" id="total_time_stat"></h4>
        </div>
        <div class="p-2">
            <h5 class="text-center">Remaining Hours Needed</h5>
            <h4 class="text-center" id="remaining_hours_stat"></h4>
        </div>
        <div class="p-2 ">
            <h5 class="text-center">Hours paid</h5>
            <h4 class="text-center" id="hours_paid_stat"></h4>
        </div>
    </div>
    <h3 class="mb-3">Courses Taken</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Print</th>
                <th scope="col">Section</th>
                <th scope="col">Course Name</th>
                <th scope="col">Time</th>
                <th scope="col">Open Course</th>
            </tr>
        </thead>
        <tbody id="my_courses_table">
        </tbody>
    </table>

    <h3 class="mt-5 mb-3">Printed documents</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Document Number</th>
                <th scope="col">Number of Courses</th>
                <th scope="col">Total Time</th>
                <th scope="col">Print date</th>
                <th scope="col">Official Document</th>
                <th scope="col">Service Log</th>
            </tr>
        </thead>
        <tbody id="my_printed_documents_table">
        </tbody>
        
    </table>
</div>