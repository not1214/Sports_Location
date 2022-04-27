<div class="container">
    
    <h3 class="text-center mb-3">イベントを確認</h3>
    @if($target == 'create_confirm')
    <form method="post" action="/events">
    @elseif($target == 'edit_confirm')
    <form method="post" action="/events/{{ $event['id'] }}">
    @endif

        @if($event['status'] == '0')
            <div class="row mb-3 text-center text-danger">
                募集は終了しました。
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-3 offset-md-1">
                <img src="{{ $event['read_temp_path'] }}" class="event_image" width="200" height="130">
            </div>
            <div class="col-md-5">
                <p>{{ $event['user'] }}</p>
                <p>{{ $event['title'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="area" class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>

            <div class="col-md-5">
               <p>{{ $area->name }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>

            <div class="col-md-5">
                <p>{{ $event['location'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

            <div class="col-md-4">
                <p>{{ $event['date'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_time" class="col-md-4 col-form-label text-md-end">{{ __('Start_time') }}</label>

            <div class="col-md-4">
                <p>{{ $event['start_time'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="end_time" class="col-md-4 col-form-label text-md-end">{{ __('End_time') }}</label>

            <div class="col-md-4">
                <p>{{ $event['end_time'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="contents" class="col-md-4 col-form-label text-md-end">{{ __('Contents') }}</label>

            <div class="col-md-6">
                <p>{{ $event['contents'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="condition" class="col-md-4 col-form-label text-md-end">{{ __('Condition') }}</label>

            <div class="col-md-6">
                <p>{{ $event['condition'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="stuff" class="col-md-4 col-form-label text-md-end">{{ __('Stuff') }}</label>

            <div class="col-md-6">
                <p>{{ $event['stuff'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="attention" class="col-md-4 col-form-label text-md-end">{{ __('Attention') }}</label>

            <div class="col-md-6">
                <p>{{ $event['attention'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="number" class="col-md-4 col-form-label text-md-end">{{ __('Number') }}</label>

            <div class="col-md-4">
                <p>{{ $event['number'] }}名</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="deadline" class="col-md-4 col-form-label text-md-end">{{ __('Deadline') }}</label>

            <div class="col-md-4">
                <p>{{ $event['deadline'] }}</p>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-8 offset-md-4">
            @if($target == 'create_confirm')
                <button type="submit" name="store" class="btn btn-primary">
                    {{ __('Create') }}
                </button>
            @elseif($target == 'edit_confirm')
                <button type="submit" name="update" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            @endif
            </div>
        </div>
    </form>

</div>
