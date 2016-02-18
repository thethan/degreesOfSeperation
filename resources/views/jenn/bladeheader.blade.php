@extends('jenn.layout')

@section('styles')

    <link rel="stylesheet" href="{{ elixir('css/jenn2.css') }}">

@endsection

@section('scripts')
    <script src="{{ elixir('js/jenn.js') }}"></script>
@endsection

@section('header')
    <div class="collapse" id="exCollapsingNavbar">
        <div class="bg-inverse nav-menu p-a-1">
            <h4><span id="shadow">J</span>enn McHugh</h4>
            <ul class="text-muted column">
                <li><a href="/jenn/blog" class="delayClick">Blog</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-light bg-faded">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            <span class="hamburger">&#9776;</span> <span class="branding">JMQ</span>
        </button>
    </nav>
@endsection

@section('content')
    <div class="blog">
        <div class="stripe"></div>
        <div class="stripe"></div>

    </div>
    <h1 class="row col-xs-offset-3">Blog</h1>
    <section>
        <div class="articles">
            <article>
                <h2>Why Ethan is the best person ever?</h2>
                <p class="time"><i>
                        <time>Janaury 18, 2016, 5:00 PM</time>
                    </i></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nibh diam, ornare vel tincidunt vel,
                    fringilla vel libero. Quisque egestas neque pulvinar, consectetur ipsum vel, commodo ligula. Mauris
                    sed gravida tellus. Pellentesque eget erat vestibulum metus blandit hendrerit non a justo. Ut sed
                    dignissim augue. Aliquam eget scelerisque urna. Suspendisse pellentesque congue sem, nec cursus orci
                    vestibulum imperdiet. Mauris volutpat leo vitae nisl commodo pulvinar. Morbi malesuada efficitur
                    feugiat. Proin vel lorem consequat, congue mi eu, efficitur lorem. Nullam augue nibh, pellentesque
                    ut diam nec, vulputate dapibus turpis. Nullam convallis feugiat elit pharetra vulputate.
                    Pellentesque accumsan condimentum nunc, eget feugiat nibh pulvinar ut.
                </p>
            </article>
            <article>
                <h2>Why Ethan is the best person ever?</h2>
                <p class="time"><i>
                        <time>Janaury 18, 2016, 5:00 PM</time>
                    </i></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nibh diam, ornare vel tincidunt vel,
                    fringilla vel libero. Quisque egestas neque pulvinar, consectetur ipsum vel, commodo ligula. Mauris
                    sed gravida tellus. Pellentesque eget erat vestibulum metus blandit hendrerit non a justo. Ut sed
                    dignissim augue. Aliquam eget scelerisque urna. Suspendisse pellentesque congue sem, nec cursus orci
                    vestibulum imperdiet. Mauris volutpat leo vitae nisl commodo pulvinar. Morbi malesuada efficitur
                    feugiat. Proin vel lorem consequat, congue mi eu, efficitur lorem. Nullam augue nibh, pellentesque
                    ut diam nec, vulputate dapibus turpis. Nullam convallis feugiat elit pharetra vulputate.
                    Pellentesque accumsan condimentum nunc, eget feugiat nibh pulvinar ut.
                </p>
            </article>
        </div>
        <aside>
            <nav>
                <ul>
                    <li>Not a real link</li>
                    <li>Blog</li>
                    <li>content</li>
                </ul>
            </nav>
        </aside>

    </section>
@endsection