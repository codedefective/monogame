@extends('game.base.game')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero pb-5">
        <div class="container">
            <iframe src="{{ route('play',['token' => $bearer]) }}" width="100%" height="400" scrolling="off" frameborder="0"></iframe>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Product Section End -->
@endsection
