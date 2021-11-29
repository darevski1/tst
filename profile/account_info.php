<div class="tab-pane fade" id="v_pills_account" role="tabpanel" aria-labelledby="v_pills_account_tab">
    <div class="d-flex flex-row bd-highlight">
        <div class="bd-highlight col-sm-12 col-md-6 col">
            <h3 class="small-text-m">Personal Infromation</h3>

        </div>
        <div class="bd-highlight col-sm-12 col-md-6 col">
            <button class="btn btn-secondary round-btn mains-btn float-end edit_btn" id="edit_btn">Edit
            </button>
            <button class="btn btn-secondary round-btn mains-btn float-end cancel" id="cancel">Cancel
            </button>
        </div>
    </div>
    <hr>
    <div class="row" id="profile_info">
        <div class="col-md-6 col-sm-12">
            <ul class="list-unstyled">
                <li class="mt-3">
                    <small class="mr-5">First name:</small>
                    <h5 id="first_name_txt"><?= $first_name ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Last name:</small>
                    <h5 id="last_name_txt"><?= $last_name ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Street Address:</small>
                    <h5 id="street_adress_txt"><?= $street_adress ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>City:</small>
                    <h5 id="city_txt"><?= $city ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Probation Officer:</small>
                    <h5 id="probation_txt"><?= $probation ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Court ID/Docket Number:</small>
                    <h5 id="court_id_txt"><?= $court_id ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Gender:</small>
                    <h5 id="gender_txt"><?= $gender ?></h5>
                </li>
                <div class="linems"></div>

            </ul>
        </div>
        <div class="col-md-6 col-sm-12">
            <ul class="list-unstyled">


                <li class="mt-3">
                    <small>Country:</small>
                    <h5 id="country_txt"><?= $country ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>State / Province:</small>
                    <h5 id="state_txt"><?= $state ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Zip / Postal Code:</small>
                    <h5 id="zip_code_txt"><?= $zip_code ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Hours Needed:</small>
                    <h5 id="hours_need_txt"><?= $hours_need ?></h5>
                </li>
                <div class="linems"></div>

                <li class="mt-3">
                    <small>Reason for doing Community Service:</small>
                    <h5 id="reason_txt"><?= $reason ?></h5>
                </li>
                <div class="linems"></div>


                <li class="mt-3">
                    <small>date of birth:</small>
                    <h5><?=$birth_month . "/" . $birth_day . "/" . $birth_year ?></h5>
                </li>
                <div class="linems"></div>


                <li class="mt-3">
                    <small>Email:</small>
                    <h5><?= $email ?></h5>
                </li>
                <div class="linems"></div>

            </ul>
        </div>
    </div>

    <div class="row" id="edit_info">
        <div class="col-md-6 col-sm-12">
            <ul class="list-unstyled">
                <li class="mt-3">
                    <small class="mr-5">First name:</small>
                    <input type="text" class="form-border" id="first_name" value="<?= $first_name ?>">
                </li>
                <li class="mt-3">
                    <small>Last name:</small>
                    <input type="text" class="form-border" id="last_name" value="<?= $last_name ?>">
                </li>
                <li class="mt-3">
                    <small>Street Address:</small>
                    <input type="text" class="form-border" id="street_adress" value="<?= $street_adress ?>">
                </li>
                <li class="mt-3">
                    <small>City:</small>
                    <input type="text" class="form-border" id="city" value="<?= $city ?>">
                </li>
                <li class="mt-3">
                    <small>Probation Officer:</small>
                    <input type="text" class="form-border" id="probation_officer" value="<?= $probation ?>">
                </li>
                <li class="mt-3">
                    <small>Court ID/Docket Number:</small>
                    <input type="text" class="form-border" id="court_id" value="<?= $court_id ?>">
                </li>



                <li class="mt-3">
                    <div class="form-group">
                        <button type="button" class="btn black_btn mt-4" onclick="SaveUserDetails()">Save</button>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col-md-6 col-sm-12">
            <ul class="list-unstyled">
                
                <li class="mt-3">
                    <small>Country:</small>
                    <div class="col w-100">
                        <?=getContries($country_id);?>
                    </div>
                </li>
                <li class="mt-3">
                    <small>State / Province:</small>
                    <div class="col">
                        <select class="js-example-basic-single form-control" id="state" disabled="" style="width: 100%">
                            
                        </select>
                    </div>
                </li>
                <li class="mt-3">
                    <small>Zip / Postal Code:</small>
                    <input type="text" class="form-border" id="zip_code" value="<?= $zip_code ?>">
                </li>
                <div class="linems"></div>
                <li class="mt-3">
                    <small>Hours Needed:</small>
                    <input type="text" class="form-border" id="hours_need" value="<?= $hours_need ?>">
                </li>
                <li class="mt-3">
                    <small>Reason for doing Community Service:</small>
                    <input type="text" class="form-border" id="reason" value="<?= $reason ?>">
                </li>
            </ul>
        </div>


        <div class="p-2 col-sm-12  coll">
            <div class="alert alert-danger"  role="alert" style="display: none" id="error_message">
                
            </div> 
            <div class="alert alert-success" role="alert" style="display: none" id="success_message" >
                Successfuly updated data
            </div>
        </div>
    </div>

    <div class="d-flex flex-row bd-highlight mt-5">
        <div class="bd-highlight col-sm-12 col-md-6 col">
            <h3 class="small-text-m">Change Password</h3>

        </div>
        <!-- <div class="bd-highlight col-sm-12 col-md-6 col">
            <button class="btn btn-secondary round-btn mains-btn float-end edit_btn" id="edit_pwd">Edit
            </button>
            <button class="btn btn-secondary round-btn mains-btn float-end cancel" id="cancel_pwd">Cancel
            </button>
        </div> -->
    </div>

<div class="row">
        <div class="col-md-6 col-sm-12">
            <form action="./#pc" method="POST" onsubmit="return ChangePasswordCheck()">
                <ul class="list-unstyled">
                    <li class="mt-3">
                        <small class="mr-5">Old password:</small>
                        <div class="form-group">
                            <input type="password" class="form-border" id="old_password" name="old_password">
                        </div>
                    </li>
                    <div class="linems"></div>
                    <li class="mt-3">
                        <small>New password:</small>
                        <div class="form-group">
                            <input type="password" class="form-border" id="new_password" name="new_password">
                        </div>
                    </li>
                    <div class="linems"></div>
                    <li class="mt-3">
                        <small>Retype password:</small>
                        <div class="form-group">
                            <input type="password" class="form-border" id="confirm_password" name="confirm_password">
                        </div>
                    </li>
                    <a id="pc"></a>
                    <div class="alert alert-danger mt-4" role="alert" style="display: <?=$display_password_error?>" id="error_message_password">
                        <?=$error_password_message;?>
                    </div>
                    <div class="alert alert-success mt-4" role="alert" style="display: <?=$display_password_success?>" 
                         id="success_message_password">
                        Your new password was successfully updated
                    </div>

                    <li class="mt-3">
                        <div class="form-group">
                            <button type="submit" class="btn black_btn mt-4">Save</button>
                        </div>
                    </li>
                </ul>

            </form>

        </div>

    </div>
</div>