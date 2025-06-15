@extends(Theme::getThemeNamespace('layouts.base'))

@section('content')
    {!! Theme::partial('headers.index') !!}

    <main>
        @if (!request()->is('products*'))
            {!! Theme::partial('breadcrumb') !!}
        @endif

        @if (request()->is('products*'))
            {!! Theme::content() !!}
        @else
            <div class="pt-80 pb-80">
                <div class="container">
                    {!! Theme::content() !!}
                </div>
            </div>
        @endif
    </main>

    {!! Theme::partial('footer') !!}
@endsection
