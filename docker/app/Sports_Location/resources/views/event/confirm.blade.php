<div class="container">

    <h3 class="text-center mb-3">イベントを確認</h3>
    @if($target == 'create_confirm')
    <form method="post" action="{{ route('events.store') }}">
    @elseif($target == 'edit_confirm')
    <form method="post" action="{{ route('events.update', ['event'=>$event->id]) }}">
    @method('patch')
    @endif
        @csrf
        @if($data['status'] == '0')
            <div class="row mb-3 align-items-center text-white bg-danger">
                <div class="text-center p-3">募集は終了しました。</div>
            </div>
        @endif

        <div class="row my-5">
            <div class="col-md-4 offset-md-1 text-center">
                @if(isset($data['read_temp_path']))
                <img src="{{ asset($data['read_temp_path']) }}" class="event_image">
                <input name="image" value="{{ $data['read_temp_path'] }}" type="hidden">
                @else
                <img src="{{ asset('images/no-image.png') }}" class="event_image">
                @endif
            </div>
            <div class="col-md-6 my-auto">
                <div class="mb-3">開催者：{{ $data['user'] }}</div>
                <h3 class="mb-3">{{ $data['title'] }}</h3>
            </div>
            <input name="title" value="{{ $data['title'] }}" type="hidden">
        </div>

        <div class="row py-3 mb-3 border-top border-dark">
            <label for="genre" class="col-md-4 text-md-end">{{ __('Genre') }}</label>

            <div class="col-md-6 offset-md-1">
               {{ $genre->genre_name }}
            </div>
            <input name="genre" value="{{ $genre->id }}" type="hidden">
        </div>
        
        <div class="row pb-3 mb-3">
            <label for="area" class="col-md-4 text-md-end">{{ __('Area') }}</label>

            <div class="col-md-6 offset-md-1">
               {{ $area->name }}
            </div>
            <input name="area" value="{{ $area->id }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="location" class="col-md-4 text-md-end">{{ __('Location') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{{ $data['location'] }}</p>
            </div>
            <input name="location" value="{{ $data['location'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="date" class="col-md-4 text-md-end">{{ __('Date') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $data['date'] }}</p>
            </div>
            <input name="date" value="{{ $data['date'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="start_time" class="col-md-4 text-md-end">{{ __('Start_time') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $data['start_time'] }}</p>
            </div>
            <input name="start_time" value="{{ $data['start_time'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="end_time" class="col-md-4 text-md-end">{{ __('End_time') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $data['end_time'] }}</p>
            </div>
            <input name="end_time" value="{{ $data['end_time'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="contents" class="col-md-4 text-md-end">{{ __('Contents') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{!! nl2br(e($data['contents'])) !!}</p>
            </div>
            <input name="contents" value="{{ $data['contents'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="condition" class="col-md-4 text-md-end">{{ __('Condition') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{!! nl2br(e($data['condition'])) !!}</p>
            </div>
            <input name="condition" value="{{ $data['condition'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="stuff" class="col-md-4 text-md-end">{{ __('Stuff') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{!! nl2br(e($data['stuff'])) !!}</p>
            </div>
            <input name="stuff" value="{{ $data['stuff'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="attention" class="col-md-4 text-md-end">{{ __('Attention') }}</label>

            <div class="col-md-6 offset-md-1">
                <p>{!! nl2br(e($data['attention'])) !!}</p>
            </div>
            <input name="attention" value="{{ $data['attention'] }}" type="hidden">
        </div>

        <div class="row mb-3">
            <label for="number" class="col-md-4 text-md-end">{{ __('Number') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ $data['number'] }}名</p>
            </div>
            <input name="number" value="{{ $data['number'] }}" type="hidden">
        </div>

        <div class="row mb-4 border-bottom border-dark">
            <label for="deadline" class="col-md-4 text-md-end">{{ __('Deadline') }}</label>

            <div class="col-md-4 offset-md-1">
                <p>{{ str_replace('T', ' ', $data['deadline']) }}</p>
            </div>
            <input name="deadline" value="{{ $data['deadline'] }}" type="hidden">
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
                <button type="submit" name="update" class="btn btn-primary col-md-2">
                    {{ __('Update') }}
                </button>
                <button type="submit" name="back" value="true" class="btn btn-danger col-md-2 offset-md-1">
                    {{ __('Back') }}
                </button>
            @endif
            </div>
        </div>
    </form>

</div>
