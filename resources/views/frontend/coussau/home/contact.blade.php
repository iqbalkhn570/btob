<div class="letstalk" id="inquire">
            <div class="container">
                
                
                <div class="row col span_5">
                    <h2>Ready to get started? <br>
It’s easy.</h2>
                           <img src="{{ asset('public/frontend/images/Images 1.png') }}" alt="" style="display: block; margin: 0 auto 30px;">

                           <div class="text-center">
                        <a href="javascript:eazeeChat();" class="btn chat">Chat with Support Team</a>
                    </div>
                </div>
                <div class="row col span_7">
                   <h2 class="text-left">Let’s have a talk</h2>
                <p class="text-left">We’d love to hear what you are looking for. Drop us note here and we’ll <br> get back to you in 24 hours.</p>
                    <form  id="contact_us" method="post" action="javascript:void(0)">
                           <div class="alert" id="msg_contact_div" style="display:none">
        <span id="res_contact_message"></span>
      </div>
                    <div class="row">
                        <div class="col span_6">
                            <input type="text" placeholder="Your Name" name="name">                            
                            <input type="email" placeholder="Email"  type="email" name="email">
                        </div>
                        <div class="col span_6">
                           <input type="tel" placeholder="Contact No" name="mobile" >
                            <select name="product" id="">
                                <option value=""> Select Purpose</option>
                                <option value="Buying A Home">Buying A Home</option>
                                <option value="Refinance">Refinance</option>
                                <option value="Renew">Renew</option>
                            </select>
                            
                            
                            
                        </div>
                        <div class="col span_12">
                            <textarea name="message" id="" cols="30" rows="10" placeholder="Type your message(Max 2000 character)"></textarea>
                            <div class="flex">
                                <span class="captcha-image">{!! Captcha::img() !!}</span>
                                <button type="button" class="btn btn-success refresh-button"><img src="{{ asset('frontend/images/refresh.svg') }}" alt=""></button>
                                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha" required>
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="send_contact_form" >Send Message</button>
                </form>
                    
                </div>
                
                
            </div>
            <div class="container talk-to-expert-container">
                <div class="row">
                    <div class="col span_2"></div>
                    <div class="col span_8">
                    <div class="talk-to-expert-block">
                        <h2 class="ready-started">Ready to Get Started ?</h2>
                        <p>Speak to a coussau specialist at <a href="tel:{{$website_setting->contact_phone1}}">({{$website_setting->contact_phone1}})</a></p>
                        <a href="javascript:;" class="talk-to-expert-btn">Request a Callback</a>
            <div id="talk-to-expert-btn-div" style="display:none">
                <form action="#"  id="readyForm" method="post">
                   <div class="alert alert-success d-none" id="msg_div">
                        <span id="res_message"></span>
                    </div>
                    <div class="alert alert-danger" style="display:none"></div>
                <div >
                   <input type="text"  name="mobile_number" id="mobile_number"  placeholder="Enter Mobile">
                   <button type="submit" id="send_mobile" >Submit</button>
                </div>
               </form>
            </div>






                    </div>
                    </div>
                    <div class="col span_2"></div>
                </div>
            </div>

        </div>