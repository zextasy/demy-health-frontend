<form wire:submit.prevent="getTestResults" class="mbr-form form-with-styler" data-form-title="Form Name">
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="text" wire:model.lazy="customerIdentifier" class="form-control" placeholder="Please enter your email" required>
        @error('customerIdentifier') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="text" wire:model.defer="orderReference" class="form-control" placeholder="Please enter your order reference">
        @error('orderReference') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
        <button type="submit" class="btn btn-primary display-4">Get Results</button>
    </div>
</form>
<br>
<hr>
<br>
<div>
    {{ $this->table }}
</div>
