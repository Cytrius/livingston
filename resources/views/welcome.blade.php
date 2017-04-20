@extends('layouts.livingston')

@section('content')

<link href="{{ asset('css/form.css') }}" rel="stylesheet">

<div class="lead-gen-module-container lead-gen-main">
    <div class="lead-gen-module">
         <h2><span>KEVIN,</span></h2>
                    <h2>HOW CAN WE <span>HELP YOU?</span></h2>
            <p><b>Select options from the form below to define your transportation needs.</b><br>Livingston can help Simplify Trade — starting with a real-time quote.</p>

    </div>
</div>

<div class="lead-gen-form-container lead-gen-main">
    <div class="lead-gen-form">
        <div id="lg-form-services">

            <div class="lg-section-holder">
                <p class="lg-section-heading marginx2">Do you require freight forwarding services?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="freightForwardingRequired" type="checkbox" value="yes">
                        <label for="freightForwardingRequired">Yes, I require freight forwarding services.</label>
                    </div>
                </div>

                <br/>

                <div style="height: 72px;">
                    <div class="lg-subsection-holder" style="opacity: 1;">
                        <label for="cb_originPostalCode" class="lg-section-subheading">Expected Departure Date</label>
                        <input id="cb_originPostalCode" value="" type="text" class="text">
                    </div>
                </div>
            </div>

            <div class="lg-section-holder">
                <p class="lg-section-heading marginx2">Do you need a pick-up service at the origin?</p>
                <div class="lg-section-content">

                    <div class="checkbox-group">
                        <input id="cb_pickupRequired" type="checkbox" value="yes">
                        <label for="cb_pickupRequired">Yes, I need the shipment picked up.</label>
                    </div>
                    <br/>
                    <div class="checkbox-group">
                        <input id="cb_pickupNoRequired" type="checkbox" value="yes">
                        <label for="cb_pickupNoRequired">No, I will drop off the shipment at the terminal.</label>
                    </div>

                    <br/>

                    <div class="marginx3" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Origin City</label>
                            <input id="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>

                    <div class="marginx3" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Origin State/Province</label>
                            <input id="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>

                    <div style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Origin Postal Code</label>
                            <input id="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>

                </div>
                <br/><br/>
                <p class="lg-section-heading marginx2">Do you need a delivery service at the destination?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="cb_deliveryRequired" type="checkbox" value="yes">
                        <label for="cb_deliveryRequired">Yes, I need the shipment delivered.</label>
                    </div>
                    <br/>
                    <div class="checkbox-group">
                        <input id="cb_deliveryNoRequired" type="checkbox" value="yes">
                        <label for="cb_deliveryNoRequired">No, I will pick up the shipment at the terminal.</label>
                    </div>
                    <br/>
                    <div class="marginx3" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Destination City</label>
                            <input id="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>

                    <div class="marginx3" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Destination State/Province</label>
                            <input id="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>

                    <div style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Destination Postal Code</label>
                            <input id="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg-section-holder" style="border-bottom:none;">
                <p class="lg-section-heading marginx2">Vehicle can be driven?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="vehicleCanBeDriven" type="checkbox" value="yes">
                        <label for="vehicleCanBeDriven">Yes, vehicle can be driven.</label>
                    </div>
                </div>
                <br/>
                <p class="lg-section-heading marginx2">Vehicle has functioning parking break?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="vehicleHasParkingBreak" type="checkbox" value="yes">
                        <label for="vehicleHasParkingBreak">Yes, vehicle has functioning parking break.</label>
                    </div>
                </div>
                <br/>
                <div class="marginx3" style="height: 72px;">
                    <div class="lg-subsection-holder" style="opacity: 1;">
                        <label for="cb_originPostalCode" class="lg-section-subheading">Vehicle Type</label>
                        <input id="cb_originPostalCode" value="" type="text" class="text">
                    </div>
                </div>

                <div class="marginx3" style="height: 72px;">
                    <div class="lg-subsection-holder" style="opacity: 1;">
                        <label for="cb_originPostalCode" class="lg-section-subheading">Vehicle Make</label>
                        <input id="cb_originPostalCode" value="" type="text" class="text">
                    </div>
                </div>

                <div class="marginx3" style="height: 72px;">
                    <div class="lg-subsection-holder" style="opacity: 1;">
                        <label for="cb_originPostalCode" class="lg-section-subheading">Vehicle Model</label>
                        <input id="cb_originPostalCode" value="" type="text" class="text">
                    </div>
                </div>

                <div class="marginx3" style="height: 72px;">
                    <div class="lg-subsection-holder" style="opacity: 1;">
                        <label for="cb_originPostalCode" class="lg-section-subheading">Vehicle Year</label>
                        <input id="cb_originPostalCode" value="" type="text" class="text">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main" style="background: #F2F6F9;">
    <div class="lead-gen-form">
        <div id="lg-form-personal">
            <!-- FORM: Personal Details -->
            <div class="lg-section-holder" style="border: none;">
                <p class="lg-section-heading marginx3">Who should we contact about this quote?</p>
                <div class="lg-section-content">
                    <div class="marginx1 form-check form-check-email">
                        <label class="" for="contact_email">Email *</label>
                        <input type="text" class="" name="contact_email" id="contact_email" value="" size="30" maxlength="255">
                        <span class="errormsg">Please enter a valid email address.</span>
                    </div>
                    <div class="marginx1 form-check">
                        <label class="" for="contact_first_name">First Name *</label>
                        <input type="text" class="" name="contact_first_name" id="contact_first_name" value="" size="30" maxlength="40">
                        <span class="errormsg">Please provide your first name.</span>
                    </div>
                    <div class="marginx1 form-check">
                        <label class="" for="contact_last_name">Last Name *</label>
                        <input type="text" class="" name="contact_last_name" id="contact_last_name" value="" size="30" maxlength="80">
                        <span class="errormsg">Please provide your last name.</span>
                    </div>
                    <div class="marginx1 form-check form-check-phone">
                        <label class="" for="contact_business_phone">Business Phone *</label>
                        <input type="text" class="" name="contact_business_phone" id="contact_business_phone" value="" size="30" maxlength="40">
                        <span class="errormsg">Please provide a valid telephone number.</span>
                    </div>
                    <div class="marginx1 form-check form-check-ignore">
                        <label class="" for="contact_company">Company *</label>
                        <input type="text" class="" name="contact_company" id="contact_company" value="" size="30" maxlength="255">
                        <span class="errormsg">Please provide the name of your company.</span>
                    </div>
                    <div class="marginx1 form-check form-check-ignore">
                        <label class="" for="contact_address">Address *</label>
                        <input type="text" class="" name="contact_address" id="contact_address" value="" size="30" maxlength="255">
                        <span class="errormsg">Please provide your address.</span>
                    </div>
                    <div class="marginx1 form-check form-check-ignore">
                        <label class="" for="contact_city">City *</label>
                        <input type="text" class="" name="contact_city" id="contact_city" value="" size="30" maxlength="40">
                        <span class="errormsg">Please provide your city.</span>
                    </div>
                    <div id="pd_country" class="marginx1 form-check">
                        <label class="" for="contact_country">Country *</label>
                        <select name="contact_country" id="contact_country">
                            <option value=""></option>
                            <option value="177774" selected="selected">Please Select...</option>
                            <option value="178254">United States</option>
                            <option value="178256">Mexico</option>
                            <option value="178258">United Kingdom</option>
                            <option value="177776">Canada</option>
                            <option value="177778">Afghanistan</option>
                            <option value="177780">Albania</option>
                            <option value="177782">Algeria</option>
                            <option value="177784">American Samoa</option>
                            <option value="177786">Andorra</option>
                            <option value="177788">Angola</option>
                            <option value="177790">Anguilla</option>
                            <option value="177792">Antarctica</option>
                            <option value="177794">Antigua and Barbuda</option>
                            <option value="177796">Argentina</option>
                            <option value="177798">Armenia</option>
                            <option value="177800">Aruba</option>
                            <option value="177802">Australia</option>
                            <option value="177804">Austria</option>
                            <option value="177806">Azerbaijan</option>
                            <option value="177808">Bahamas</option>
                            <option value="177810">Bahrain</option>
                            <option value="177812">Bangladesh</option>
                            <option value="177814">Barbados</option>
                            <option value="177816">Belarus</option>
                            <option value="177818">Belgium</option>
                            <option value="177820">Belize</option>
                            <option value="177822">Benin</option>
                            <option value="177824">Bermuda</option>
                            <option value="177826">Bhutan</option>
                            <option value="177828">Bolivia</option>
                            <option value="177830">Bosnia and Herzegovina</option>
                            <option value="177832">Botswana</option>
                            <option value="177834">Brazil</option>
                            <option value="177836">British Indian Ocean Territory</option>
                            <option value="177838">British Virgin Islands</option>
                            <option value="177840">Brunei</option>
                            <option value="177842">Bulgaria</option>
                            <option value="177844">Burkina Faso</option>
                            <option value="177846">Burundi</option>
                            <option value="177848">Cambodia</option>
                            <option value="177850">Cameroon</option>
                            <option value="177852">Cape Verde</option>
                            <option value="177854">Cayman Islands</option>
                            <option value="177856">Central African Republic</option>
                            <option value="177858">Chad</option>
                            <option value="177860">Chile</option>
                            <option value="177862">China</option>
                            <option value="177864">Christmas Island</option>
                            <option value="177866">Cocos (Keeling) Islands</option>
                            <option value="177868">Colombia</option>
                            <option value="177870">Comoros</option>
                            <option value="177872">Congo</option>
                            <option value="177874">Cook Islands</option>
                            <option value="177876">Costa Rica</option>
                            <option value="177878">Croatia</option>
                            <option value="177880">Cuba</option>
                            <option value="177882">Curaçao</option>
                            <option value="177884">Cyprus</option>
                            <option value="177886">Czech Republic</option>
                            <option value="177888">Côte d’Ivoire</option>
                            <option value="177890">Democratic Republic of the Congo</option>
                            <option value="177892">Denmark</option>
                            <option value="177894">Djibouti</option>
                            <option value="177896">Dominica</option>
                            <option value="177898">Dominican Republic</option>
                            <option value="177900">Ecuador</option>
                            <option value="177902">Egypt</option>
                            <option value="177904">El Salvador</option>
                            <option value="177906">Equatorial Guinea</option>
                            <option value="177908">Eritrea</option>
                            <option value="177910">Estonia</option>
                            <option value="177912">Ethiopia</option>
                            <option value="177914">Falkland Islands</option>
                            <option value="177916">Faroe Islands</option>
                            <option value="177918">Fiji</option>
                            <option value="177920">Finland</option>
                            <option value="177922">France</option>
                            <option value="177924">French Guiana</option>
                            <option value="177926">French Polynesia</option>
                            <option value="177928">French Southern Territories</option>
                            <option value="177930">Gabon</option>
                            <option value="177932">Gambia</option>
                            <option value="177934">Georgia</option>
                            <option value="177936">Germany</option>
                            <option value="177938">Ghana</option>
                            <option value="177940">Gibraltar</option>
                            <option value="177942">Greece</option>
                            <option value="177944">Greenland</option>
                            <option value="177946">Grenada</option>
                            <option value="177948">Guadeloupe</option>
                            <option value="177950">Guam</option>
                            <option value="177952">Guatemala</option>
                            <option value="177954">Guernsey</option>
                            <option value="177956">Guinea</option>
                            <option value="177958">Guinea-Bissau</option>
                            <option value="177960">Guyana</option>
                            <option value="177962">Haiti</option>
                            <option value="177964">Honduras</option>
                            <option value="177966">Hong Kong S.A.R., China</option>
                            <option value="177968">Hungary</option>
                            <option value="177970">Iceland</option>
                            <option value="177972">India</option>
                            <option value="177974">Indonesia</option>
                            <option value="177976">Iran</option>
                            <option value="177978">Iraq</option>
                            <option value="177980">Ireland</option>
                            <option value="177982">Isle of Man</option>
                            <option value="177984">Israel</option>
                            <option value="177986">Italy</option>
                            <option value="177988">Jamaica</option>
                            <option value="177990">Japan</option>
                            <option value="177992">Jersey</option>
                            <option value="177994">Jordan</option>
                            <option value="177996">Kazakhstan</option>
                            <option value="177998">Kenya</option>
                            <option value="178000">Kiribati</option>
                            <option value="178002">Kuwait</option>
                            <option value="178004">Kyrgyzstan</option>
                            <option value="178006">Laos</option>
                            <option value="178008">Latvia</option>
                            <option value="178010">Lebanon</option>
                            <option value="178012">Lesotho</option>
                            <option value="178014">Liberia</option>
                            <option value="178016">Libya</option>
                            <option value="178018">Liechtenstein</option>
                            <option value="178020">Lithuania</option>
                            <option value="178022">Luxembourg</option>
                            <option value="178024">Macao S.A.R., China</option>
                            <option value="178026">Macedonia</option>
                            <option value="178028">Madagascar</option>
                            <option value="178030">Malawi</option>
                            <option value="178032">Malaysia</option>
                            <option value="178034">Maldives</option>
                            <option value="178036">Mali</option>
                            <option value="178038">Malta</option>
                            <option value="178040">Marshall Islands</option>
                            <option value="178042">Martinique</option>
                            <option value="178044">Mauritania</option>
                            <option value="178046">Mauritius</option>
                            <option value="178048">Mayotte</option>
                            <option value="178050">Micronesia</option>
                            <option value="178052">Moldova</option>
                            <option value="178054">Monaco</option>
                            <option value="178056">Mongolia</option>
                            <option value="178058">Montenegro</option>
                            <option value="178060">Montserrat</option>
                            <option value="178062">Morocco</option>
                            <option value="178064">Mozambique</option>
                            <option value="178066">Myanmar</option>
                            <option value="178068">Namibia</option>
                            <option value="178070">Nauru</option>
                            <option value="178072">Nepal</option>
                            <option value="178074">Netherlands</option>
                            <option value="178076">New Caledonia</option>
                            <option value="178078">New Zealand</option>
                            <option value="178080">Nicaragua</option>
                            <option value="178082">Niger</option>
                            <option value="178084">Nigeria</option>
                            <option value="178086">Niue</option>
                            <option value="178088">Norfolk Island</option>
                            <option value="178090">North Korea</option>
                            <option value="178092">Northern Mariana Islands</option>
                            <option value="178094">Norway</option>
                            <option value="178096">Oman</option>
                            <option value="178098">Pakistan</option>
                            <option value="178100">Palau</option>
                            <option value="178102">Palestinian Territory</option>
                            <option value="178104">Panama</option>
                            <option value="178106">Papua New Guinea</option>
                            <option value="178108">Paraguay</option>
                            <option value="178110">Peru</option>
                            <option value="178112">Philippines</option>
                            <option value="178114">Pitcairn</option>
                            <option value="178116">Poland</option>
                            <option value="178118">Portugal</option>
                            <option value="178120">Puerto Rico</option>
                            <option value="178122">Qatar</option>
                            <option value="178124">Romania</option>
                            <option value="178126">Russia</option>
                            <option value="178128">Rwanda</option>
                            <option value="178130">Réunion</option>
                            <option value="178132">Saint Barthélemy</option>
                            <option value="178134">Saint Helena</option>
                            <option value="178136">Saint Kitts and Nevis</option>
                            <option value="178138">Saint Lucia</option>
                            <option value="178140">Saint Pierre and Miquelon</option>
                            <option value="178142">Saint Vincent and the Grenadines</option>
                            <option value="178144">Samoa</option>
                            <option value="178146">San Marino</option>
                            <option value="178148">Sao Tome and Principe</option>
                            <option value="178150">Saudi Arabia</option>
                            <option value="178152">Senegal</option>
                            <option value="178154">Serbia</option>
                            <option value="178156">Seychelles</option>
                            <option value="178158">Sierra Leone</option>
                            <option value="178160">Singapore</option>
                            <option value="178162">Slovakia</option>
                            <option value="178164">Slovenia</option>
                            <option value="178166">Solomon Islands</option>
                            <option value="178168">Somalia</option>
                            <option value="178170">South Africa</option>
                            <option value="178172">South Korea</option>
                            <option value="178174">South Sudan</option>
                            <option value="178176">Spain</option>
                            <option value="178178">Sri Lanka</option>
                            <option value="178180">Sudan</option>
                            <option value="178182">Suriname</option>
                            <option value="178184">Svalbard and Jan Mayen</option>
                            <option value="178186">Swaziland</option>
                            <option value="178188">Sweden</option>
                            <option value="178190">Switzerland</option>
                            <option value="178192">Syria</option>
                            <option value="178194">Taiwan</option>
                            <option value="178196">Tajikistan</option>
                            <option value="178198">Tanzania</option>
                            <option value="178200">Thailand</option>
                            <option value="178202">Timor-Leste</option>
                            <option value="178204">Togo</option>
                            <option value="178206">Tokelau</option>
                            <option value="178208">Tonga</option>
                            <option value="178210">Trinidad and Tobago</option>
                            <option value="178212">Tunisia</option>
                            <option value="178214">Turkey</option>
                            <option value="178216">Turkmenistan</option>
                            <option value="178218">Turks and Caicos Islands</option>
                            <option value="178220">Tuvalu</option>
                            <option value="178222">U.S. Virgin Islands</option>
                            <option value="178224">Uganda</option>
                            <option value="178226">Ukraine</option>
                            <option value="178228">United Arab Emirates</option>
                            <option value="178230">United States Minor Outlying Islands</option>
                            <option value="178232">Uruguay</option>
                            <option value="178234">Uzbekistan</option>
                            <option value="178236">Vanuatu</option>
                            <option value="178238">Vatican</option>
                            <option value="178240">Venezuela</option>
                            <option value="178242">Viet Nam</option>
                            <option value="178244">Wallis and Futuna</option>
                            <option value="178246">Western Sahara</option>
                            <option value="178248">Yemen</option>
                            <option value="178250">Zambia</option>
                            <option value="178252">Zimbabwe</option>
                        </select>
                        <span class="errormsg">Please select your country.</span>
                    </div>
                    <div class="lg-subsection-holder">
                        <div id="pd_state" class="marginx1 form-check">

                            <div id="state_US">
                                <label class="" for="contact_state">State *</label>
                                <select name="contact_state" id="contact_state">
                                    <!-- <option value=""></option> -->
                                    <option value="">Please Select... </option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    </select>
                                <span class="errormsg">Please select your state.</span>
                            </div>

                            <div id="state_CA">
                                <label class="" for="contact_province">Province</label>
                                <select name="contact_province" id="contact_province">
                                    <!-- <option value=""></option> -->
                                    <option value="">Please Select... </option>
                                    <option value="AB">Alberta</option>
                                    <option value="BC">British Columbia</option>
                                    <option value="MB">Manitoba</option>
                                    <option value="NB">New Brunswick</option>
                                    <option value="NL">Newfoundland</option>
                                    <option value="NT">Northwest Territories</option>
                                    <option value="NS">Nova Scotia</option>
                                    <option value="NU">Nunavut</option>
                                    <option value="ON">Ontario</option>
                                    <option value="PE">Prince Edward Island</option>
                                    <option value="QC">Quebec</option>
                                    <option value="SK">Saskatchewan</option>
                                    <option value="YT">Yukon</option>
                                </select>
                                <span class="errormsg">Please select your province.</span>
                            </div>

                        </div>
                    </div>
                    <div class="lg-subsection-holder">
                        <div id="pd_castl" class="marginx1 form-check">
                            <div>
                                <label class="marginx2"><span class="errormsg" style="padding-left:0;"></span>Yes, I consent to receive Livingston emails.</label>
                                <div class="lg-section-content radio-group">
                                    <input name="contact_casl" id="contact_caslYES" type="radio" value="yes">
                                    <label for="contact_caslYES">Yes</label>
                                    <input name="contact_casl" id="contact_caslNO" type="radio" value="no">
                                    <label for="contact_caslNO">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- error message for errors elsewhere in form -->
                <div class="lg-section-content">
                    <div class="errorflag-holder">
                        <span class="errormsg errorflag" style="display: none;">Errors have been found in your form. Please verify before submitting.</span>
                    </div>
                </div>

                <div class="lg-section-content">
                    <span class="">* = required information</span>
                </div>
            </div>
            <div id="lg-form-submit">
                <button type="button" class="lead-gen-button">Get A Real-Time Quote</button>
            </div>
        </div>
    </div>
</div>

@endsection