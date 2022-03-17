@extends('layouts.app')

@section('content')
<div class="container">

    
    <div class="row">
        <h1 class="text-center mb-4">{{$data['characters_title']}}</h1>
        <h5 class="mb-3">{{$data['characters_sub_title']}}</h5>
    </div>

    <div class="row row-cols-2 row-cols-md-4 gx-3 gy-5">
        @if (!$data['data']->isEmpty())
        @foreach($data['data'] as $character)
            <div class="col ">
                <div class="p-3 border text-uppercase grey-bg py-5">
                    @php
                        $id = (isset($character['character_id']))? $character['character_id'] : basename(parse_url($character['url'], PHP_URL_PATH))
                    @endphp
                    {{ $id }} <br />
                    {{ $character['name'] }} <br />
                    {{ $character['gender'] }} <br /><br />
                    <a class="viewmore" href="{{ route('characters.show', $id) }}"> view more </a>
                </div>
            </div>
        @endforeach
        @else
            <div class="col ">
                <p>No data available!</p>
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
    
    <div class="row pagination">
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $data['data']->links() !!}
        </div>
    </div>
</div>
@endsection
