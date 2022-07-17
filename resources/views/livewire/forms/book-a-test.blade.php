<form wire:submit.prevent="submit" class="mbr-form form-with-styler" data-form-title="Form Name">
    @csrf
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.lazy="customerFirstName" class="form-control" placeholder="Please enter your First Name" value="{{$customerFirstName}}" required>
            @error('$customerFirstName') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.lazy="customerLastName" class="form-control" placeholder="Please enter your Last Name" value="{{$customerLastName}}" required>
            @error('$customerLastName') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="email">
            <input type="text" wire:model.lazy="customerEmail" class="form-control" placeholder="Please enter your email" value="{{$customerEmail}}">
            @error('customerEmail') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="phone">
            <input type="text" wire:model.lazy="customerPhoneNumber" class="form-control" placeholder="Please enter your phone number" value="{{$customerPhoneNumber}}">
            @error('customerPhoneNumber') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    </div>
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
    <div class="col-12 form-group mb-3" data-for="radio">
        <input type="radio" wire:model="locationType" value="{{\App\Enums\TestBookings\LocationTypeEnum::HOME->value}}">
        <label for="html">Home sample collection</label><br>
        <input type="radio" wire:model="locationType" value="{{\App\Enums\TestBookings\LocationTypeEnum::CENTER->value}}">
        <label for="css">Take the Test at a center</label><br>
        @error('locationType') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    @if ($locationType == \App\Enums\TestBookings\LocationTypeEnum::HOME->value)
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.state-select
                name="selectedStateForHomeBooking"
                :value="$selectedStateForHomeBooking"
                placeholder="Choose a State"
                :is-for-sample="true"
            />
            @error('selectedStateForHomeBooking') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.local-government-area-select
                name="selectedLocalGovernmentArea"
                :value="$selectedLocalGovernmentArea"
                placeholder="Choose a Local Government Area"
                :depends-on="['selectedStateForHomeBooking']"
                :is-for-sample="true"
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
    @if ($locationType == \App\Enums\TestBookings\LocationTypeEnum::CENTER->value)
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.state-select
                name="selectedStateForTestCenterBooking"
                :value="$selectedStateForTestCenterBooking"
                placeholder="Choose a State"
                :is-for-test-center="true"
            />
            @error('selectedStateForTestCenterBooking') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.test-center-select
                name="selectedTestCenter"
                :value="$selectedTestCenter"
                placeholder="Choose a Center"
                :depends-on="['selectedStateForTestCenterBooking']"
            />
            @error('selectedTestCenter') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    @endif
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="email">
            <input type="text" wire:model.lazy="customerGender" class="form-control" placeholder="Please select your gender">
            @error('customerGender') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3 " data-for="phone">
            <input type="text" wire:model.lazy="customerCountryId" class="form-control" placeholder="Please select your nationality">
            @error('customerCountryId') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.lazy="customerPassportNumber" class="form-control" placeholder="Please enter your passport number" value="{{$customerPassportNumber}}">
            @error('customerPassportNumber') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-12 form-group mb-3" data-for="date">
        <label for="startTime">Date of Birth: </label>
        <input type="date" wire:model.defer="customerDateOfBirth" class="form-control">
        @error('customerDateOfBirth') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
        <button type="submit" class="btn btn-primary display-4">Book Test</button>
    </div>
</form>
