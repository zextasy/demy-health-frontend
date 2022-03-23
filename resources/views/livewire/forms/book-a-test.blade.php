<form action="{{url('book-a-test.html')}}" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
    <input type="hidden" name="email" data-form-email="true" value="ovVFq2hbkg62a/JTnnwMkpS/xD2De3rGDuCp0Ow53QaDWJK7G8bY+dO+guyyKTHGi1ENTYtIM1SGrYUXlvPJ0XZgfeo50qCf/RgFlQBOK8lSs7pxVKEbmC3qTJu2r5cK">
    @csrf
    <div class="col-12 form-group mb-3" data-for="textarea">
        <select class="form-control" name="category_id">

            <option value="" selected>Choose Center</option>

            @foreach($testCenters as $testCenter)

                <option value="{{ $testCenter->id }}">{{ $testCenter->name }}</option>

            @endforeach

        </select>
    </div>
    <div class="dragArea row">
        <div class="col-md col-sm-12 form-group mb-3" data-for="textarea">
            <select wire:model="selectedTestCategory" class="form-control">

                <option value="" selected>Choose Category</option>

                @foreach($testCategories as $testCategory)

                    <option value="{{ $testCategory->id }}">{{ $testCategory->name }}</option>

                @endforeach

            </select>
        </div>
        <div class="col-md col-sm-12 form-group mb-3" data-for="textarea">
            <select class="form-control" name="test_type_id">

                <option value="" selected>Choose Test</option>

                @foreach($testTypes as $testType)

                    <option value="{{ $testType->id }}">{{ $testType->description }}</option>

                @endforeach

            </select>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 align-center mbr-section-btn">
            <button type="submit" class="btn btn-primary display-4">Book Test</button>
        </div>
    </div>
</form>
