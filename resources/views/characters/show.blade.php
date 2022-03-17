@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="text-center mb-5">{{ __('View Character Page') }}</h1>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @php
                        $characterData = $data['characterData'];
                        $savedCharacterId = $data['savedCharacterId'];
                        $id = basename(parse_url($characterData['url'], PHP_URL_PATH));
                    @endphp

                    <p class="back-listing mb-4"> 
                        <a href="{{ url()->previous() }}"><i class="bi bi-chevron-compact-left"></i> back to listing page</a>
                    </p>

                    <h3 class="mb-4">{{$characterData['name']}}</h3>
                    <div class="mb-4">
                        <p class="mb-1"><strong>Height:</strong> {{$characterData['height']}}</p>
                        <p class="mb-1"><strong>Hair Colour:</strong> {{$characterData['hair_color']}}</p>
                        <p class="mb-1"><strong>Gender:</strong> {{$characterData['gender']}}</p>
                    </div>
                    <div class="viewcharacter-btn">
                        @if(!$savedCharacterId)
                            <form action="{{ route('characters.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="character_id" value="{{ $id }}">
                                <input type="hidden" name="name" value="{{$characterData['name']}}">
                                <input type="hidden" name="gender" value="{{$characterData['gender']}}">
                                <button class="btn btn-primary">Save Character</button>
                            </form>
                        @else
                            <form action="{{ route('characters.destroy',$savedCharacterId) }}" method="POST">   
                                @csrf
                                @method('DELETE')      
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
