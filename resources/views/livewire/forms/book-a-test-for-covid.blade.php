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
    <div class="col-md col-sm-12 form-group mb-3" data-for="select">
        <select wire:model="selectedTestCategory" class="form-control"  required>
            <option value="" selected>Choose Category</option>

            @foreach($testCategories as $testCategory)
                <option value="{{ $testCategory->id }}">{{ $testCategory->name }}</option>
            @endforeach

        </select>
        @error('selectedTestCategory') <p class="alert-danger">{{ $message }}</p> @enderror
    </div>
    @if (!is_null($selectedTestCategory))
        <div class="col-md col-sm-12 form-group mb-3" data-for="select">
            <select wire:model="selectedTestType" class="form-control"  required>
                <option value="" selected>Choose Test</option>

                @foreach($testTypes as $testType)
                    <option value="{{ $testType->id }}">{{ $testType->name }}</option>
                @endforeach

            </select>
            @error('selectedTestType') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
    @endif
    <div class="col-12 form-group mb-3" data-for="date">
        <label for="startTime">Date and Time: </label>
        <input type="datetime-local" wire:model.defer="dueDate" class="form-control" required>
        @error('dueDate') <p class="alert-danger">{{ $message }}</p> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="radio">
        <input type="radio" id="location-home" wire:model="locationType" value="{{\App\Enums\TestBookings\LocationTypeEnum::HOME->value}}">
        <label for="location-home">Home sample collection</label><br>
        <input type="radio" id="location-center" wire:model="locationType" value="{{\App\Enums\TestBookings\LocationTypeEnum::CENTER->value}}">
        <label for="location-center">Take the Test at a center</label><br>
        @error('locationType') <p class="alert-danger">{{ $message }}</p> @enderror
    </div>
    @if ($locationType == \App\Enums\TestBookings\LocationTypeEnum::HOME->value)
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.state-select
                name="selectedStateForHomeBooking"
                :value="$selectedStateForHomeBooking"
                placeholder="Choose a State"
                :is-for-sample="true"
            />
            @error('selectedStateForHomeBooking') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.local-government-area-select
                name="selectedLocalGovernmentArea"
                :value="$selectedLocalGovernmentArea"
                placeholder="Choose a Local Government Area"
                :depends-on="['selectedStateForHomeBooking']"
                :is-for-sample="true"
            />
            @error('selectedLocalGovernmentArea') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.defer="city" class="form-control" placeholder="Please enter your city" required>
            @error('city') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.lazy="addressLine1" class="form-control" placeholder="Please enter your address" required>
            @error('addressLine1') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.defer="addressLine2" class="form-control" placeholder="Please enter your address Line 2 (optional)">
            @error('addressLine2') <p class="alert-danger">{{ $message }}</p> @enderror
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
            @error('selectedStateForTestCenterBooking') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.test-center-select
                name="selectedTestCenter"
                :value="$selectedTestCenter"
                placeholder="Choose a Center"
                :depends-on="['selectedStateForTestCenterBooking']"
            />
            @error('selectedTestCenter') <p class="alert-danger">{{ $message }}</p> @enderror
        </div>
    @endif
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="select">
            <select name="selectedCustomerGender" wire:model.lazy="customerGender" class="form-control">
                <option value="" selected>Please select your gender</option>
                @foreach(\App\Enums\GenderEnum::cases() as $enumOption)
                    <option value="{{ $enumOption->value }}">{{ $enumOption->name }}</option>
                @endforeach
            </select>
            @error('customerGender') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3 " data-for="select">
            <livewire:forms.select.livewire-select.country-select
                name="selectedCustomerCountry"
                :value="$customerCountryId"
                placeholder="Please select your nationality"
                :searchable="true"
            />
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


