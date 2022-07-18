
        <div class="calculatorSection">
            <div class="container">
               <h2>coussau Calculators</h2>
               <p>Calculate your monthly payment and review your loan options. </p>
               
                <div class="calculatorTab">
                    <div class="tab">
                        <ul>
                            <li rel="newHomeAffordablity" class="active"><span>New Home Affordability</span> </li>
                            <li rel="rentVsHome"><span>Rent Vs Buy Home</span></li>
                            <li rel="cmhcMorgage"><span>CMHC coussau </span></li>
                            <li rel="purchaseMorgage"><span>Purchase coussau Calculator/EMI</span></li>
                            <li rel="refinanceMorgage"><span>Refinance coussau</span></li>
                        </ul>
                        
                        <div class="tabContent" id="newHomeAffordablity" style="display: block">
                            @include('frontend.coussau.home.calculators.affordability')
                        </div>
                        <div class="tabContent" id="rentVsHome">
                            @include('frontend.coussau.home.calculators.rentvsbuy')
                        </div>
                        <div class="tabContent" id="cmhcMorgage">
                            <div class="calculatercontent">
                            @include('frontend.coussau.home.calculators.cmhc')
                            </div>
                        </div>
                        
                        <div class="tabContent" id="purchaseMorgage">
                            <div class="calculatercontent">
                            @include('frontend.coussau.home.calculators.emi')
                            </div>
                        </div>
                        
                        <div class="tabContent" id="refinanceMorgage">
                            <div class="calculatercontent">
                            @include('frontend.coussau.home.calculators.refinance')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>