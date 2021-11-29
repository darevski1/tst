<div class="tab-pane fade" id="v_pills_schedule" role="tabpanel" aria-labelledby="v_pills_schedule_tab">
    <div class="container">

        <div class="row">
            <h2 class="mt-4">Schedule</h2>
            <p>
                A timer will track the minutes you spend on each section. You must click on the submit
                button to receive full credit. A 'keep alive' box will pop up every few minutes. If you
                are not present to click the button, you will be returned to this page, and the timer
                will stop. If you leave the section without clicking the submit button, you may lose
                some of your earned time.
            </p>
              <div class="col-sm-12">
              <div class="form-group">
                <!-- <label for="date" style="font-size: 16px">Choose Date:</label> -->
                <button class="btn btn-secondary round-btn mains-btn edit_btn" 
                        onclick="$('#week_picker_id').toggle()" id="choose_date_button">Choose Week</button>
                     <div class="week-picker" id="week_picker_id" style="margin-top: 10px;"></div>     
                     
                </div>
              </div>
              <hr class="mt-4">
          
            <div class="table-responsive" id="schedule_table_div">
                
            </div>

        </div>
    </div>
</div>


 

<!-- Modal -->
<div class="modal fade" id="modal_join" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" id="modal_join_content">
      
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="cancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Join to some title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      A timer will track the minutes you spend on each section. You must click on the submit button to receive full credit. A 'keep alive' box will pop up every few minutes. If you are not present to click the button, you will be returned to this page, and the timer will stop. If you leave the section without clicking the submit button, you may lose some of your earned time.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn cancel_btn " data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn join_btn">Yes i what to cancel</button>
      </div>
    </div>
  </div>
</div>