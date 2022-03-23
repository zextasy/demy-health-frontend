<div>
    <div class="form-group row">

        <label for="{{\Illuminate\Support\Str::lower($firstLevelModelName)}}" class="col-md-4 col-form-label text-md-right">{{$firstLevelModelName}}</label>

        <div class="col-md-6">

            <select wire:model="selectedModel" class="form-control">

                <option value="" selected>Choose {{$firstLevelModelName}}</option>

                @foreach($firstLevelCollection as $firstLevelModel)

                    <option value="{{ $firstLevelModel->id }}">{{ $firstLevelModel->name }}</option>

                @endforeach

            </select>

        </div>

    </div>



    @if (!is_null($selectedModel))

        <div class="form-group row">

            <label for="{{\Illuminate\Support\Str::lower($secondLevelModelName)}}" class="col-md-4 col-form-label text-md-right">{{$secondLevelModelName}}</label>



            <div class="col-md-6">

                <select class="form-control" name="{{$secondLevelModelKey}}">

                    <option value="" selected>Choose {{$secondLevelModelName}}</option>

                    @foreach($secondLevelCollection as $secondLevelModel)

                        <option value="{{ $secondLevelModel->id }}">{{ $secondLevelModel->name }}</option>

                    @endforeach

                </select>

            </div>

        </div>

    @endif
</div>
