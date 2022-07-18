<select name="selectedCustomerGender" wire:model.lazy="customerGender" class="form-control">
    <option value="" selected>Please select </option>
    @foreach(\App\Enums\GenderEnum::cases() as $enumOption)
        <option value="{{ $enumOption->value }}">{{ $enumOption->name }}</option>
    @endforeach
</select>
