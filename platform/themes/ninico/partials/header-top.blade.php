<div @class(['header-top', $class ?? 'space-bg'])>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="headertoplag d-flex align-items-center justify-content-center">
                    {!! Theme::partial('currency-switcher') !!}
                    {!! Theme::partial('language-switcher') !!}
                    @if (theme_option('social_links') && ($socialLinks = json_decode(theme_option('social_links'), true)))
                        <div class="menu-top-social">
                            @foreach ($socialLinks as $socialLink)
                                @php($socialLink = collect($socialLink)->pluck('value', 'key'))
                                <a href="{{ $socialLink->get('url') }}" title="{{ $socialLink->get('name') }}">
                                    {!! BaseHelper::renderIcon($socialLink->get('icon')) !!}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
