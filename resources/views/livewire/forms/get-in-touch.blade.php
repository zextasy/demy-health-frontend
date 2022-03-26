<form wire:submit.prevent="submit" class="mbr-form form-with-styler" data-form-title="Form Name">
    <input type="hidden" name="email" data-form-email="true" value="LpD3kOHUO7wUjX15qE6vPlC8yi1xoUM8Ac4vs4W3U12IIRSmSDSWTQRVEGS/tKunFUqVY/ZZGsKhyhVmZ9ahKw3Bf500N/zM+ZffDhYCZM9ovOTEUFkR5ey9zoms1G5N">
    <div class="row">
        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
            Oops...! some problem!
        </div>
    </div>
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="name">
            <input type="text" name="name" placeholder="Name" data-form-field="name" class="form-control" value="" id="name-form5-22">
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="email">
            <input type="email" name="email" placeholder="E-mail" data-form-field="email" class="form-control" value="" id="email-form5-22">
        </div>

        <div class="col-12 form-group mb-3" data-for="textarea">
            <textarea name="textarea" placeholder="Message" data-form-field="textarea" class="form-control" id="textarea-form5-22"></textarea>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
            <button type="submit" class="btn btn-primary display-4">Send message</button>
        </div>
    </div>
</form>
