<form wire:submit.prevent="submit" class="mbr-form form-with-styler" data-form-title="Form Name">
    <input type="hidden" name="email" data-form-email="true" value="bo/rMslJzymf6uZ/MxvtwXMJon7Q3aQDa9IUaXK2VBpPSmbnMyKGCV8Gb2vWJAVlXEalAKDCG7dIsU+YNWGv2WlafBzTr28HuHiW5+Szh1iVH/kcgscAQAeMUX4kE9wb">
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="name">
            <input type="text" wire:model.lazy="customerName" placeholder="Name" data-form-field="name" class="form-control" value="" id="name-form5-15">
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="email">
            <input type="email" wire:model.lazy="customerEmail" placeholder="E-mail" data-form-field="email" class="form-control" value="" id="email-form5-15">
        </div>
        <div class="col-12 form-group mb-3" data-for="select">
            <livewire:forms.select.livewire-select.state-select
                name="selectedState"
                :value="$selectedState"
                placeholder="Choose a State"
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
{{--        <div class="col-12 form-group mb-3" data-for="text">--}}
{{--            <input type="textarea" wire:model.defer="city" class="form-control" placeholder="Please enter your city"  required>--}}
{{--            @error('city') <span class="alert-danger">{{ $message }}</span> @enderror--}}
{{--        </div>--}}
{{--        <div class="col-12 form-group mb-3" data-for="text">--}}
{{--            <input type="textarea" wire:model.lazy="addressLine1" class="form-control" placeholder="Please enter your address"  required>--}}
{{--            @error('addressLine1') <span class="alert-danger">{{ $message }}</span> @enderror--}}
{{--        </div>--}}
{{--        <div class="col-12 form-group mb-3" data-for="text">--}}
{{--            <input type="textarea" wire:model.defer="addressLine2" class="form-control" placeholder="Please enter your address Line 2 (optional)">--}}
{{--            @error('addressLine2') <span class="alert-danger">{{ $message }}</span> @enderror--}}
{{--        </div>--}}
        <div class="col-12 form-group mb-3" data-for="textarea">
            <textarea wire:model.lazy="message" placeholder="Message" data-form-field="textarea" class="form-control" id="textarea-form5-15"></textarea>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
            <button type="submit" class="btn btn-primary display-4">Send message</button>
        </div>
    </div>
</form>
