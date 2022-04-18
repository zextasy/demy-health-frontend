<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
<span class="text-gray-700">{{ __('Select Items') }}</span>
<div>
    <div id="users-select" wire:ignore></div>
</div>

<link rel="stylesheet" href="node_modules/virtual-select-plugin/dist/virtual-select.min.css">
<script src="node_modules/virtual-select-plugin/dist/virtual-select.min.js"></script>

<!-- optional -->
<link rel="stylesheet" href="node_modules/tooltip-plugin/dist/tooltip.min.css">
<script src="node_modules/tooltip-plugin/dist/tooltip.min.js"></script>

<script>
    let myOptions = [
            @foreach($users as $user)
        { label: "{{ $user->name }}", value: "{{ $user->id }}" },
        @endforeach
    ];
    VirtualSelect.init({
        ele: '#users-select',
        options: myOptions,
        multiple: true,
        search: true,
        placeholder: "{{__('Select Picked Orders')}}",
        noOptionsText: "{{__('No results found')}}",
    });

    let selectedUsers = document.querySelector('#users-select')
    selectedUsers.addEventListener('change', () => {
        let data = selectedUsers.value
        @this.set('selectedUsers', data)
    })
</script>
