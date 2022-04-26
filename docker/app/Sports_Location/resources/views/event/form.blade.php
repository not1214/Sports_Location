<div class="container">
    
    @if($target == 'store')
    <h3 class="text-center mb-3">イベントを作成</h3>
    <form method="post" action="/events">
    @elseif($target == 'update')
    <h3 class="text-center mb-3">イベントを編集</h3>
    <form method="post" action="/events/{{ $event->id }}">
    @endif
        <div class="row mb-3">
            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

            <div class="col-md-6">
                <input id="image" type="file" class="form-control" name="image">
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="area" class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>

            <div class="col-md-6">
                <select id="area" class="form-control" name="area" required>
                    <option disabled style='display:none;' @if (empty($event->area_id)) selected @endif>選択してください</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" @if (isset($event->area_id) && ($event->area_id === $area->id)) selected @endif>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" required>
            </div>
        </div>
    </form>

</div>
