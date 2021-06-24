<style>

@media screen and (min-width: 768px)
{
    .ei-slider-large{width:75%;float:left !important;}
    .sliderLead{width:25%;float:left;padding:10px 20px;}
}


.highlightText{
            background: #bb1414;
    padding: 2px 12px;
    color: white;
            }
            .sliderLead .form-control{
                background-color: #fff;
                color: #000;
                width: 100%;
                margin-bottom: 13px;
                height: 32px;
                border-width: 1px;
                border-style: solid;
                border-color: transparent;
                border-image: initial;
                padding: 6px 6px!important;
                border-radius: 6px;
                box-shadow: 1px 2px 3px #5d617624;
                font-size: 12px;
                border-radius: unset;
            }
            .sliderLead .form-group{
                display:block !important;
                margin-bottom: unset;
            }


            #onLeadSubmissionPass, #onLeadSubmissionFail{
                    display: none;

            } 

            @media screen and (max-width: 768px)
            {
                
                .sliderLead{
                    width:100%;float:left;padding:10px 20px;
                }
            }

    </style>

<div id="ei-slider" class="ei-slider" data-input="homepage" style="background:#fbfbfb">
    <ul class="ei-slider-large" style="">
        @foreach($sliders as $slider)
            <li>
                <a href="{{ $slider['link'] }}">
                    <img src="{{ get_storage_file_url($slider['featured_image']['path'], 'main_slider') }}" alt="{{ $slider['title'] ?? 'Slider Image ' . $loop->count }}">
                </a>
                <div class="ei-title">
                    <h2 style="color: {{ $slider['title_color'] }}">{{ $slider['title'] }}</h2>
                    <h3 style="color: {{ $slider['sub_title_color'] }}">{{ $slider['sub_title'] }}</h3>
                </div>
            </li>
        @endforeach
    </ul><!-- ei-slider-large -->
    <ul class="ei-slider-thumbs" style="float:left">
        <li class="ei-slider-element">Current</li>
        @foreach($sliders as $slider)
            <li>
                <a href="#">Slide {{ $loop->count }}</a>
                <img src="{{ isset($slider['images'][0]['path']) ?
                    get_storage_file_url($slider['images'][0]['path'], 'slider_thumb') :
                    get_storage_file_url($slider['featured_image']['path'], 'slider_thumb') }}" alt="thumbnail {{ $loop->count }}"
                />
            </li>
        @endforeach
    </ul>
    <style>
        
        </style>
    <ul class="sliderLead" style="">
        <div class="">

            {{  Form::open(['method'=>'post']) }}
            <h4 class="text-center">Post Your <span class="highlightText">Requirement</span> </h4>
            <div class="form-group">
                <label>Requirements*</label>
                <input type="text" name="leadProduct" id="leadProduct" required class="form-control leadGenerationForm" placeholder="Enter Product/Service Name...">
            </div>
            <div class="form-group" style="width: 49%;float: left;">
                <label>Name*</label>
                <input type="text" name="leadName" id="leadName" required class="form-control leadGenerationForm" placeholder="Enter  Name...">
            </div>
            <div class="form-group" style="width: 48%;float: left;margin-left: 5px;">
                <label>Phone*</label>
                <input type="text" pattern="[0-9]" required maxlength="32" oninput="this.value = this.value.replace(/[^0-9-+]/g,
                      '').replace(/(\..*)\./g, '$1');" name="leadContact" id="leadContact" class="form-control leadGenerationForm" placeholder="Enter  Phone...">
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="leadEmail" id="leadEmail" required class="form-control leadGenerationForm" placeholder="Enter  Email...">
                <input type="hidden" id="leadGeneratedFrom" name="leadGeneratedFrom" value="{{ Request::url()}}" readonly required>
                <input type="hidden" id="leadOwner" name="leadOwner" value=" " readonly >
                <input type="hidden" id="leadCountry" name="leadCountry"  value="India" readonly >
                <input type="hidden" value="1" name="leadProductQty" id="leadProductQty" class="form-control" placeholder="Enter Your Phone" required>

            </div>
            <div class="form-group">
                <button class="btn btn-sm btn-danger" id="submitLead">Raise Enquiry</button>
            </div>

                <div id="onLeadSubmissionPass">
                    <strong>Thanks!</strong> Will Process your enquiry soon.
                  </div>
                  <div id="onLeadSubmissionFail">
                    <strong>Warning!</strong> It looks data is already there.
                  </div>
                  <div id="onLeadSubmissionValidationFail" style="display: none">
                    <strong>Warning!</strong> Please fill all required fields in correct format.
                  </div>

            {{ Form::close()}}
            <div class="input-group">
              <small style="font-size:9px;">*To achieve our mission we provide all the necessary functionalities</small>
            </div>
        </div>
    </ul>
</div><!-- /.ei-slider-->