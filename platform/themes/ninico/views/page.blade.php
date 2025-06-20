@php
    $page->loadMissing('metadata');

    $layout = in_array($page->template, ['default', 'full-width', 'blank']) ? $page->template : 'default';

    Theme::set('layout', $layout);

    // Safely get header style with fallback to default
    try {
        $headerStyle = $page->getMetaData('header_style', true);
    } catch (Exception $e) {
        $headerStyle = 'default';
    }

    // If header style is empty or null, use default
    if (empty($headerStyle)) {
        $headerStyle = 'default';
    }

    Theme::set('headerStyle', $headerStyle);

    Theme::set('pageTitle', $page->name);

    try {
        if ($bannerImage = $page->getMetaData('banner_image', true)) {
            Theme::set('breadcrumbBannerImage', RvMedia::getImageUrl($bannerImage));
        }

        if ($page->getMetaData('customize_footer', true) === 'custom') {
            if ($footerBackgroundColor = $page->getMetaData('footer_background_color', true)) {
                Theme::set('footerBackgroundColor', $footerBackgroundColor);
            }
            if ($footerBorderColor = $page->getMetaData('footer_border_color', true)) {
                Theme::set('footerBorderColor', $footerBorderColor);
            }
            if ($footerTextColor = $page->getMetaData('footer_text_color', true)) {
                Theme::set('footerTextColor', $footerTextColor);
            }
            if ($footerTextMutedColor = $page->getMetaData('footer_text_muted_color', true)) {
                Theme::set('footerTextMutedColor', $footerTextMutedColor);
            }
            if ($footerLogo = $page->getMetaData('footer_logo', true)) {
                Theme::set('footerLogo', $footerLogo);
            }
            if ($footerBottomBackgroundColor = $page->getMetaData('footer_bottom_background_color', true)) {
                Theme::set('footerBottomBackgroundColor', $footerBottomBackgroundColor);
            }
        }
    } catch (Exception $e) {
        // Silently handle metadata errors
    }
@endphp

@if (BaseHelper::isHomepage($page->id))
    <h1 class="d-none">{{ theme_option('site_title') }}</h1>
@endif

{!! apply_filters(
    PAGE_FILTER_FRONT_PAGE_CONTENT,
    Html::tag('div', BaseHelper::clean($page->content), ['class' => 'ck-content'])->toHtml(),
    $page,
) !!}
