<form wire:submit.prevent="getTestResults" class="mbr-form form-with-styler" data-form-title="Form Name">
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="text" wire:model.lazy="customerEmail" class="form-control" placeholder="Please enter your email or phone number" required>
        @error('customerEmail') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="text" wire:model.defer="testBookingReference" class="form-control" placeholder="Please enter the booking reference " required>
        @error('testBookingReference') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
        <button type="submit" class="btn btn-primary display-4">Get Results</button>
    </div>
    <br>
    <hr>
    <br>
    <div>
        {{ $this->table }}
    </div>
</form>
