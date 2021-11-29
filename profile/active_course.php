<div class="tab-pane fade" id="v_pills_active_course" role="tabpanel" aria-labelledby="v_pills_active_course_tab">

    <h3 class="nopd" id="no_active_course_text">
        No course is selected. Please go to the section <b>All Courses</b> to select which course you want to take.
    </h3>

    <div id="active_course_content" style="display: none">
        <div class="d-flex justify-content-between align-items-center fixedpos mt-4 mb-4">
            <h3 class="nopd"><b  id="course_name">The Three Branches of Government Part 2</b></h3>
            <div class="d-flex justify-content-between align-items-center">

                <button type="button" class="btn black_btn w-300 btn-lg mr-20" onclick="SubmitCourse()">Submit</button>

                <div class="pause d-flex justify-content-center align-items-center cp-shadow" 
                    id="pause_button" onclick="PauseTime();"><i class="fas fa-pause"></i></div>
                <div class="start d-flex justify-content-center align-items-center cp-shadow" 
                    id="play_button"  onclick="PlayTime()"><i class="fas fa-play" ></i></div>

                <div class="timer" id="course_timer" style="width: 160px">HH:MM:SS </div>
            </div>


        </div>
        <div class="book-reader">
            <div id="course_text" style="maring-bottom: 30px"></div>
            <div class="col-sm-12">
                <hr>
            </div>
                
            <div class="col-md-6 offset-3  col-sm-12 text-center ">
                <label for="course_review_txt " class="h6">Put text what you have learned before submit:</label>
                <br>
                <textarea class="form-controls w-100 " id="course_review_txt" name="course_review_txt" rows="7" cols="50" maxlength="3000"></textarea>
                <br>
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn black_btn w-300 btn-lg mr-20" onclick="SubmitCourse()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>