<div class="container">
    
    <h3 class="text-center mb-3">イベントを確認</h3>
    @if($target == 'create_confirm')
    <form method="post" action="/events">
    @elseif($target == 'edit_confirm')
    <form method="post" action="/events/{{ $id }}">
    @method('patch')
    @endif
        @csrf
        @if($event['status'] == '0')
            <div class="row mb-3 text-center text-danger">
                募集は終了しました。
            </div>
        @endif

        <div class="row my-5">
            <div class="col-md-4 offset-md-1 text-center">
                @if(isset($event['read_temp_path']))
                <img src="{{ asset($event['read_temp_path']) }}" class="event_image">
                <input name="image" value="{{ $event['read_temp_path'] }}" type="hidden">
                @else
                <img src="{{ asset('images/no-image.png') }}" class="event_image">
                @endif
            </div>
            <div class="col-md-6 my-auto">
                <div>開催者：{{ $event['user'] }}</div>
                <h3>{{ $event['title'] }}</h3>
            </div>
            <input name="title" value="{{ $event['title'] }}" type="hidden">
        </div>

        <div class="row py-3 mb-3 border-top border-dark">
            <label for="area" class="col-md-4 text-md-end">{{ __('Area') }}</label>

            <div class="col-md-6 offset-md-1">
               {{ $area->name }}
            </div>
            <input name="area" value="{{ $area->id }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="location" class="col-md-4 text-md-end">{{ __('Location') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['location'] }}</p>
            </div>
            <input name="location" value="{{ $event['location'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="date" class="col-md-4 text-md-end">{{ __('Date') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['date'] }}</p>
            </div>
            <input name="date" value="{{ $event['date'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="start_time" class="col-md-4 text-md-end">{{ __('Start_time') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['start_time'] }}</p>
            </div>
            <input name="start_time" value="{{ $event['start_time'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="end_time" class="col-md-4 text-md-end">{{ __('End_time') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['end_time'] }}</p>
            </div>
            <input name="end_time" value="{{ $event['end_time'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="contents" class="col-md-4 text-md-end">{{ __('Contents') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['contents'] }}</p>
            </div>
            <input name="contents" value="{{ $event['contents'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="condition" class="col-md-4 text-md-end">{{ __('Condition') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['condition'] }}</p>
            </div>
            <input name="condition" value="{{ $event['condition'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="stuff" class="col-md-4 text-md-end">{{ __('Stuff') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['stuff'] }}</p>
            </div>
            <input name="stuff" value="{{ $event['stuff'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="attention" class="col-md-4 text-md-end">{{ __('Attention') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $event['attention'] }}</p>
            </div>
            <input name="attention" value="{{ $event['attention'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="number" class="col-md-4 text-md-end">{{ __('Number') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['number'] }}名</p>
            </div>
            <input name="number" value="{{ $event['number'] }}" type="hidden">
        </div>

        <div class="row mb-4 border-bottom border-dark">
            <label for="deadline" class="col-md-4 text-md-end">{{ __('Deadline') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $event['deadline'] }}</p>
            </div>
            <input name="deadline" value="{{ $event['deadline'] }}" type="hidden">
        </div>

        <div class="row mb-2">
            <div class="col-md-8 offset-md-4">
            @if($target == 'create_confirm')
                <button type="submit" name="store" class="btn btn-primary col-md-2">
                    {{ __('Create') }}
                </button>
                <button type="submit" name="back" value="true" class="btn btn-danger col-md-2 offset-md-1">
                    {{ __('Back') }}
                </button>
            @elseif($target == 'edit_confirm')
                <button type="submit" name="update" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
                <button type="submit" name="back" value="true" class="btn btn-danger">
                    {{ __('Back') }}
                </button>
            @endif
            </div>
        </div>
    </form>

</div>
