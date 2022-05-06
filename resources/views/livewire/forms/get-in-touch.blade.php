<form wire:submit.prevent="submit" class="mbr-form form-with-styler" data-form-title="Form Name">
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="name">
            <input type="text" wire:model.lazy="customerName" placeholder="Name" data-form-field="name" class="form-control" id="name-form5-22" required>
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="email">
            <input type="email" wire:model.lazy="customerEmail" placeholder="E-mail" data-form-field="email" class="form-control"id="email-form5-22" required>
        </div>

        <div class="col-12 form-group mb-3" data-for="textarea">
            <textarea wire:model.lazy="message" placeholder="Message" data-form-field="textarea" class="form-control" id="textarea-form5-22" required></textarea>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
            <button type="submit" class="btn btn-primary display-4">Send message</button>
        </div>
    </div>
</form>
