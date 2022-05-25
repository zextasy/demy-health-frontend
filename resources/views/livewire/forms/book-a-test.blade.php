<form wire:submit.prevent="submit" class="mbr-form form-with-styler" data-form-title="Form Name">
    @csrf
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="text" wire:model.lazy="customerEmail" class="form-control" placeholder="Please enter your email" value="{{$customerEmail}}" required>
        @error('customerEmail') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="radio">
        <input type="radio" wire:model="locationType" value="{{\App\Enums\TestBooking\LocationTypeEnum::HOME->value}}">
        <label for="html">Home sample collection</label><br>
        <input type="radio" wire:model="locationType" value="{{\App\Enums\TestBooking\LocationTypeEnum::CENTER->value}}">
        <label for="css">Take the Test at a center</label><br>
        @error('locationType') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    @if ($locationType == \App\Enums\TestBooking\LocationTypeEnum::HOME->value)
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.state-select
                name="selectedState"
                :value="$selectedState"
                placeholder="Choose a State"
                :is-for-sample="true"
            />
            @error('selectedState') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.local-government-area-select
                name="selectedLocalGovernmentArea"
                :value="$selectedLocalGovernmentArea"
                placeholder="Choose a Local Government Area"
                :depends-on="['selectedState']"
            />
            @error('selectedLocalGovernmentArea') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.defer="city" class="form-control" placeholder="Please enter your city"  required>
            @error('city') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.lazy="addressLine1" class="form-control" placeholder="Please enter your address"  required>
            @error('addressLine1') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.defer="addressLine2" class="form-control" placeholder="Please enter your address Line 2 (optional)">
            @error('addressLine2') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    @endif
    @if ($locationType == \App\Enums\TestBooking\LocationTypeEnum::CENTER->value)
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.test-center-select
                name="selectedTestCenter"
                :value="$selectedTestCenter"
                placeholder="Choose a Center"
            />
            @error('selectedTestCenter') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    @endif
    <div class="col-12 form-group mb-3" data-for="select">
        <livewire:forms.select.livewire-select.test-type-select
            name="selectedTestType"
            :value="$selectedTestType"
            placeholder="Choose a Test"
            :searchable="true"
        />
        @error('selectedTestType') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="date">
        <label for="startTime">Date and Time: </label>
        <input type="datetime-local" wire:model.defer="dueDate" class="form-control" required>
        @error('dueDate') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
        <button type="submit" class="btn btn-primary display-4">Book Test</button>
    </div>
</form>
