@if($enabled)
<div class="floating-social-media">
    @if($help_text)
        <div class="floating-social-help">
            {{ $help_text }}
        </div>
    @endif
    
    <div class="floating-social-icons">
        @foreach($social_links as $platform => $link)
            @if($link['enabled'])
                <a href="{{ $link['url'] }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="floating-social-icon floating-social-{{ $platform }}"
                   title="{{ $link['title'] }}"
                   style="background-color: {{ $link['color'] }}">
                    <i class="{{ $link['icon'] }}"></i>
                </a>
            @endif
        @endforeach
    </div>
</div>
@endif
