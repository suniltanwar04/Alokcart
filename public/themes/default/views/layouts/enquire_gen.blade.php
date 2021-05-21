<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please fill required data</h4>

          <h3 class="modal-title"><p style="font-size: 15px;font-weight: 600;color: red;">{{ $item->title }}</p></h3>
        </div>
        <div class="modal-body" style="padding:15px 45px;background: #fbfbfb;">

            {{ Form::open(array('url' => '#')) }}

            <div class="form-group">
                <label>Your Name:</label>
                <input type="text" class="form-control leadGenerationForm" id="leadName" name="leadName" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <label>Your Email:</label>
                <input type="text" class="form-control leadGenerationForm" id="leadEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="leadEmail" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group">
                <label>Your Phone:</label>
                <input type="text" pattern="[0-9]" maxlength="12" class="form-control leadGenerationForm" id="leadContact" name="leadContact" placeholder="Enter Your Phone" required>
            </div>
            <div class="form-group">
              <label> Your Country:</label>
              <input type="text"  maxlength="100" class="form-control leadGenerationForm" id="leadCountry" name="leadCountry" placeholder="Enter Your Country" required>
          </div>
            <div class="form-group">
                <label>Requested Qty:</label>
                <input type="text" readonly value="" name="leadProductQty" id="req_qty_popup" class="form-control" placeholder="Enter Your Phone" required>
                <input type="hidden" id="leadOwner" name="leadOwner" value="{{ $item->shop->slug}}" readonly required>
                <input type="hidden" id="leadProduct" name="leadProduct" value="{{ $item->id}}" readonly required>
                <input type="hidden" id="leadGeneratedFrom" name="leadGeneratedFrom" value="{{ Request::url()}}" readonly required>

            </div>
            <div class="form-group">
                <button class="btn btn-md btn-danger" type="button" id="submitLead">Enquire Now</button>
            </div>
            {{ Form::close() }}

            <div class="form-group">
                <div class="alert alert-success" id="onLeadSubmissionPass">
                    <strong>Thanks!</strong> Will Process your enquiry soon.
                  </div>

                  <div class="alert alert-danger" id="onLeadSubmissionFail">
                    <strong>Warning!</strong> It looks data is already there.
                  </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <style>
#onLeadSubmissionPass{display: none;}
#onLeadSubmissionFail{display: none;}
      </style>