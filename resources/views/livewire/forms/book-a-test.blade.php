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
        <x-alpine-select-search
            wire:model="selectedTestType"
            :data="$testTypes"
            placeholder="Choose a Test"
        />
        @error('selectedTestType') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="date">
        <label for="startTime">Date and Time: </label>
        <input type="datetime-local" wire:model.defer="dueDate" class="form-control" required>
        @error('dueDate') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="radio">
        <input type="radio" wire:model.live="locationType" name="locationType" value="{{\App\Enums\TestBookings\LocationTypeEnum::HOME->value}}">
        <label for="html">Home sample collection</label><br>
        <input type="radio" wire:model.live="locationType" name="locationType" value="{{\App\Enums\TestBookings\LocationTypeEnum::CENTER->value}}">
        <label for="css">Take the Test at a center</label><br>
        @error('locationType') <span class="alert-danger">{{ $message }}</span> @enderror
    </div>
    @if ($locationType == \App\Enums\TestBookings\LocationTypeEnum::HOME->value)
        <div class="col-12 form-group mb-3" data-for="select">
            <x-alpine-select-search
                wire:model.live="selectedStateForHomeBooking"
                :data="$statesForHomeBooking"
                placeholder="Choose a State"
            />
            @error('selectedStateForHomeBooking') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
{{--            <x-alpine-select-search--}}
{{--                wire:model.live="selectedLocalGovernmentArea"--}}
{{--                wire:key="{{ $selectedStateForHomeBooking }}"--}}
{{--                :data="$localGovernmentAreas"--}}
{{--                placeholder="Choose a Region"--}}
{{--            />--}}
            <select class="form-control" wire:model.live="selectedLocalGovernmentArea" wire:key="{{ $selectedStateForHomeBooking }}">
                <option value="" >Choose a Region</option>
                @foreach (\App\Models\LocalGovernmentArea::query()->where('state_id',$selectedStateForHomeBooking)->get() as $testCenter)
                    <option value="{{ $testCenter->id }}">{{ $testCenter->name }}</option>
                @endforeach
            </select>
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
            <x-alpine-select-search
                wire:model.live="selectedStateForTestCenterBooking"
                :data="$statesForCenterBooking"
                placeholder="Choose a State"
            />
            @error('selectedStateForTestCenterBooking') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
{{--            <x-alpine-select-search--}}
{{--                wire:model.live="selectedTestCenter"--}}
{{--                :data="$testCenters"--}}
{{--                placeholder="Choose a Center"--}}
{{--            />--}}
            <!-- dependent select menu... -->
            <select class="form-control" wire:model.live="selectedTestCenter" wire:key="{{ $selectedStateForTestCenterBooking }}">
                <option value="" >Choose a Center</option>
                @foreach (\App\Models\TestCenter::query()->inState($selectedStateForTestCenterBooking)->get() as $testCenter)
                    <option value="{{ $testCenter->id }}">{{ $testCenter->name }}</option>
                @endforeach
            </select>
            @error('selectedTestCenter') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
    @endif
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="select">
            <select class="form-control" name="selectedCustomerGender" wire:model.lazy="customerGender" class="form-control">
                <option value="" selected>Please select your gender (optional)</option>
                @foreach(\App\Enums\GenderEnum::cases() as $enumOption)
                    <option value="{{ $enumOption->value }}">{{ $enumOption->name }}</option>
                @endforeach
            </select>
            @error('customerGender') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3 " data-for="select">
            <x-alpine-select-search
                wire:model="customerCountryId"
                :data="$countries"
                placeholder="Select Country"
            />
            @error('customerCountryId') <span class="alert-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="text">
            <input type="text" wire:model.lazy="customerPassportNumber" class="form-control" placeholder="Please enter your passport number (optional)" value="{{$customerPassportNumber}}">
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
