<div class="container">

    @if($target == 'confirm')
    <h3 class="text-center mb-3">イベントを作成</h3>
    <form method="post" action="/events/create/confirm" enctype="multipart/form-data" name="form">
    @elseif($target == 'update')
    <h3 class="text-center mb-3">イベントを編集</h3>
    <form method="post" action="/events/{{ $event->id }}/edit/confirm" enctype="multipart/form-data" name="form">
    @endif
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row mb-3">
            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

            <div class="col-md-6">
                <input id="image" type="file" class="form-control" name="image">
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" required value="{{ old('title', $event->title) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="genre" class="col-md-4 col-form-label text-md-end">{{ __('Genre') }}</label>

            <div class="col-md-4">
                <select id="genre" class="form-select" name="genre" required>
                    <option disabled style='display:none;' @if (empty($event->genre_id)) selected @endif>選択してください</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" @if (old('genre', $event->genre_id) == $genre->id)) selected @endif>{{ $genre->genre_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="area" class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>

            <div class="col-md-4">
                <select id="area" class="form-select" name="area" required>
                    <option disabled style='display:none;' @if (empty($event->area_id)) selected @endif>選択してください</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" @if (old('area', $event->area_id) == $area->id)) selected @endif>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>

            <div class="col-md-6">
                <input id="location" type="text" class="form-control" name="location" required value="{{ old('location', $event->location) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

            <div class="col-md-4">
                <input id="date" type="date" class="form-control" name="date" required value="{{ old('date', $event->date) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_time" class="col-md-4 col-form-label text-md-end">{{ __('Start_time') }}</label>

            <div class="col-md-4">
                <input id="start_time" type="time" class="form-control" name="start_time" required value="{{ old('start_time', $event->start_time) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="end_time" class="col-md-4 col-form-label text-md-end">{{ __('End_time') }}</label>

            <div class="col-md-4">
                <input id="end_time" type="time" class="form-control" name="end_time" required value="{{ old('end_time', $event->end_time) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="contents" class="col-md-4 col-form-label text-md-end">{{ __('Contents') }}</label>

            <div class="col-md-6">
                <textarea id="contents" class="form-control" name="contents" required>{{ old('contents', $event->contents) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="condition" class="col-md-4 col-form-label text-md-end">{{ __('Condition') }}</label>

            <div class="col-md-6">
                <textarea id="condition" class="form-control" name="condition" required>{{ old('condition', $event->condition) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="stuff" class="col-md-4 col-form-label text-md-end">{{ __('Stuff') }}</label>

            <div class="col-md-6">
                <textarea id="stuff" class="form-control" name="stuff" required>{{ old('stuff', $event->stuff) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="attention" class="col-md-4 col-form-label text-md-end">{{ __('Attention') }}</label>

            <div class="col-md-6">
                <textarea id="attention" class="form-control" name="attention" required>{{ old('attention', $event->attention) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="number" class="col-md-4 col-form-label text-md-end">{{ __('Number') }}</label>

            <div class="col-md-4">
                <input id="number" type="number" class="form-control" name="number" required min="1" value="{{ old('number', $event->number) }}">
            </div>
        </div>

        <div class="row mb-3">
            <label for="deadline" class="col-md-4 col-form-label text-md-end">{{ __('Deadline') }}</label>

            <div class="col-md-4">
                <input id="deadline" type="datetime-local" class="form-control" name="deadline" required value="{{ old('deadline', str_replace(" ", "T", $event->deadline)) }}">
            </div>
        </div>

        @if($target == 'confirm')
            <input id="status" name="status" type="hidden" value="1">
        @elseif($target == 'update')
            <div class="row mb-3">
                <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                <div class="col-md-6 d-flex align-items-center">
                    <input id="status" type="radio" name="status" value="1" {{ old('status', $event->status) == '1' ? 'checked' : '' }}>募集中　　
                    <input id="status" type="radio" name="status" value="0" {{ old('status', $event->status) == '0' ? 'checked' : '' }}>募集終了　　
                </div>
            </div>
        @endif

        <div class="row mb-2">
            <div class="col-md-12 text-center">
                <button type="submit" name="confirm" class="col-md-1 btn btn-primary">
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>
    </form>

</div>
