<select wire:model.lazy="selectedEnumValue" class="form-control">
    <option value="" selected>Please select </option>
    @foreach($enum::cases() as $enumOption)
        <option value="{{ $enumOption->value }}">{{ $enumOption->name }}</option>
    @endforeach
</select>
