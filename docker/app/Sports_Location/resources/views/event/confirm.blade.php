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

        <div class="row my-5">
            <div class="col-md-4 offset-md-1 text-center">
                <img src="{{ asset($event['read_temp_path']) }}" class="event_image">
            </div>
            <div class="col-md-6 my-auto">
                <div>開催者：{{ $event['user'] }}</div>
                <h3>{{ $event['title'] }}</h3>
            </div>
        </div>

        <div class="row py-3 mb-3 border-top border-dark">
            <label for="area" class="col-md-4 text-md-end">{{ __('Area') }}</label>

            <div class="col-md-6 offset-md-1">
               {{ $area->name }}
            </div>
        </div>

        <div class="row mb-3">
            <label for="location" class="col-md-4 text-md-end">{{ __('Location') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['location'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="date" class="col-md-4 text-md-end">{{ __('Date') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['date'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_time" class="col-md-4 text-md-end">{{ __('Start_time') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['start_time'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="end_time" class="col-md-4 text-md-end">{{ __('End_time') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['end_time'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="contents" class="col-md-4 text-md-end">{{ __('Contents') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['contents'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="condition" class="col-md-4 text-md-end">{{ __('Condition') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['condition'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="stuff" class="col-md-4 text-md-end">{{ __('Stuff') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['stuff'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="attention" class="col-md-4 text-md-end">{{ __('Attention') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['attention'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label for="number" class="col-md-4 text-md-end">{{ __('Number') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['number'] }}名</p>
            </div>
        </div>

        <div class="row mb-4 border-bottom border-dark">
            <label for="deadline" class="col-md-4 text-md-end">{{ __('Deadline') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['deadline'] }}</p>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-8 offset-md-4">
            @if($target == 'create_confirm')
                <button type="submit" name="store" class="btn btn-primary col-md-2">
                    {{ __('Create') }}
                </button>
            @elseif($target == 'edit_confirm')
                <button type="submit" name="update" class="btn btn-primary col-md-2">
                    {{ __('Update') }}
                </button>
            @endif
                <button type="button" onClick="history.back()" class="btn btn-danger offset-md-1 col-md-2">　戻る　</button>
            </div>
        </div>
    </form>

</div>
