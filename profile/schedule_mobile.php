
<div class="tab-pane fade" id="v_pills_schedule_mobile" role="tabpanel" aria-labelledby="v_pills_schedule_mobile_tab">
    <div class="ms-mobile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="mt-4">Schedule</h2>
                    <p>A timer will track the minutes you spend on each section. You must click on the submit button to receive full credit. A 'keep alive' box will pop up every few minutes. If you are not present to click the button, you will be returned to this page, and the timer will stop. If you leave the section without clicking the submit button, you may lose some of your earned time. </p>
                </div>
                <div class="d-grid gap-2 mt-3">
                     <button class="btn btn-bt" type="button" onclick="$('#week_picker_id').toggle()" id="choose_date_button" >Chooes Week</button>
                     <div class="week-picker" id="week_picker_id" style="margin-top: 10px;"></div>   
                </div>
                <div class="col-sm-12">
                    <div class="wrapme mt-5">

                        <div class="block-arow  d-flex justify-content-center align-items-baseline">
                            <i class="fas fa-caret-left" onclick="SwipeLeftSchedule()"></i>
                        </div>

                        <div id="schedules_mobile" class="wrap-schedule">

                        </div>

                        <div class="block-arow  d-flex justify-content-center align-items-baseline">
                            <i class="fas fa-caret-right" onclick="SwipeRightSchedule()"></i>
                        </div>
                </div>
        
            </div>
        </div>

    </div>
</div>