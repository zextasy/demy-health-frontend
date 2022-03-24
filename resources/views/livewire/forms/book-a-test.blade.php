<form wire:submit.prevent="submit" class="mbr-form form-with-styler" data-form-title="Form Name">
    @csrf
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="radio" id="html" wire:model="location" value="home">
        <label for="html">Home sample collection</label><br>
        <input type="radio" id="css" wire:model="location" value="center">
        <label for="css">Take the Test at a center</label><br>
        @error('customerEmail') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="col-12 form-group mb-3" data-for="email">
        <input type="text" wire:model="customerEmail" class="form-control" placeholder="Please enter your email">
        @error('customerEmail') <span class="error">{{ $message }}</span> @enderror
    </div>
    @if ($location == 'home')
        <div class="col-12 form-group mb-3" data-for="textarea">
            <select wire:model="state" class="form-control">

                <option value="" selected>Choose State</option>

            </select>
            @error('state') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="col-12 form-group mb-3" data-for="textarea">
            <select wire:model="lga" class="form-control">

                <option value="" selected>Choose LGA</option>

            </select>
            @error('lga') <span class="error">{{ $message }}</span> @enderror
        </div>
        <input type="textarea" wire:model="address" class="form-control" placeholder="Please enter your address">
    @endif
    @if ($location == 'center')
    <div class="col-12 form-group mb-3" data-for="textarea">
        <select wire:model="testCenter" class="form-control">

            <option value="" selected>Choose Center</option>

            @foreach($testCenters as $testCenter)

                <option value="{{ $testCenter->id }}">{{ $testCenter->name }}</option>

            @endforeach

        </select>
        @error('testCenter') <span class="error">{{ $message }}</span> @enderror
    </div>
    @endif
        <div class="col-md col-sm-12 form-group mb-3" data-for="textarea">
            <select wire:model="selectedTestCategory" class="form-control">

                <option value="" selected>Choose Category</option>

                @foreach($testCategories as $testCategory)

                    <option value="{{ $testCategory->id }}">{{ $testCategory->name }}</option>

                @endforeach

            </select>
        </div>
    @if (!is_null($selectedTestCategory))
        <div class="col-md col-sm-12 form-group mb-3" data-for="textarea">
            <select wire:model="testType" class="form-control">

                <option value="" selected>Choose Test</option>

                @foreach($testTypes as $testType)

                    <option value="{{ $testType->id }}">{{ $testType->description }}</option>

                @endforeach

            </select>
            @error('testType') <span class="error">{{ $message }}</span> @enderror
        </div>
    @endif
        <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
            <button type="submit" class="btn btn-primary display-4">Book Test</button>
        </div>
</form>
