<div class="tab-pane fade" id="v_pills_pricing" role="tabpanel" aria-labelledby="v_pills_pricing_tab">
    <div class="pricing-plans p-4">
        <div class="container">
            <h3 class="display-6 bold mt-4 text-center ">Our pricing plans</h3>
            <div class="col-sm-12 d-flex flex-column justify-content-end align-items-end">
                <p class="mr"><b>Powered by</b></p>
                <img src="../includes/stripe/old/stripe.png" class="img-stripe mb-2"/>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>1 - 5 Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $29.95 </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 1)?> </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>6 - 10 Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $59.95 </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 2)?> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>11 - 25 Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $79.95 </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 3)?> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>26 - 50 Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $99.95 </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 4)?> </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>51 - 75 Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2">
                                $109.95
                            </div>
                            <div>
                                <?=GetOrderPricingPlanStripeButton($pk_key, 5)?>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>76 - 250 Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $129.95 </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 6)?> </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>251 - 500 Hours of Community Service Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $149.95 </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 7)?> </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bsg mt-1 mb-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mobile-block">
                        <div>501 - 1000 Hours of Community Service Hours of Community Service</div>
                        <div class=" d-flex justify-content-end align-items-center col-sm-6 col-md-6 col-lg-6 mobile-block">
                            <div class="p-2"> $169.95
                            </div>
                            <div> <?=GetOrderPricingPlanStripeButton($pk_key, 8)?> </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>