        <div class="row">
          <div class="col-md-6 nopadding-right">
            <div class="form-group">
              {!! Form::label('leadName', 'Name', ['class' => 'with-help']) !!}
              {!! Form::text('leadName', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadContact', 'Phone', ['class' => 'with-help']) !!}
              {!! Form::text('leadContact', null, ['class' => 'form-control', 'placeholder' => 'Phone', 'required', 'maxlength' => '15']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadCategory', 'Category') !!}
              {!! Form::select('leadCategory', $categories , null, ['class' => 'form-control select2', 'placeholder' => 'Category', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadProduct', 'Product Name', ['class' => 'with-help']) !!}
              {!! Form::select('leadProduct', $products, null, ['class' => 'form-control select2', 'placeholder' => 'Product Name', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadProductQty', 'Quantity', ['class' => 'with-help']) !!}
              {!! Form::text('leadProductQty', null, ['class' => 'form-control', 'placeholder' => 'Quantity', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-6 nopadding-left">
            <div class="form-group">
              {!! Form::label('leadEmail', 'Email', ['class' => 'with-help']) !!}
              {!! Form::email('leadEmail', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadCountry', trans('app.form.country')) !!}
              {!! Form::select('leadCountry', $countries , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.country'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadProductTitle', 'Product Title', ['class' => 'with-help']) !!}
              {!! Form::text('leadProductTitle', null, ['class' => 'form-control', 'placeholder' => 'Product Title', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('leadProductDescription', 'Product Description', ['class' => 'with-help']) !!}
              {!! Form::textarea('leadProductDescription', null, ['class' => 'form-control', 'placeholder' => 'Product Description', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
      