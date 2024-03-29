{{-- alert nodal pop up --}}
<div class="modal fade" id="alert-modal" role="dialog" tabindex="-1" aria-labelledby="alert-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alert-modal-label"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      </div>
      <div class="modal-body p-4">
        <div class="text-center mb-3" id="alert-modal-icon">
        
        </div>
        <h6 class="text-center pb-3" id="alert-modal-body"></h6>
        <div class="btns-main d-flex flex-md-row justify-content-center align-items-center gap-3 mt-2">
            <a href="#" class="btn btn-primary round" id="alert-modal-action-btn"></a>
            <a href="javascript:;" class="btn btn-secondary round" data-bs-dismiss="modal" aria-label="Close">Close</a>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- end of alert modal pop up --}}

{{-- cart modal pop up --}}
<div class="modal fade" id="cart-modal" tabindex="-1" role="dialog" aria-labelledby="cart-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cart-modal-label">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      </div>
      <div class="modal-body p-4">
        <div class="text-center mb-3">
           <img src="{{ url('front/images/question-icon1.png') }}" alt="">
        </div>
        <h6 class="text-center pb-3" id="cart-modal-body"></h6>
        <div class="btns-main d-flex flex-md-row justify-content-center align-items-center gap-3">
            <a href="{{ route('checkout') }}" class="btn btn-primary round">Go to Checkout</a>
            <a href="javascript:;" class="btn btn-secondary round" data-bs-dismiss="modal" aria-label="Close">Add Package</a>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- end of cart modal popup --}}