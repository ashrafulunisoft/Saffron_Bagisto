{!! view_render_event('bagisto.shop.layout.footer.before') !!}

@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

@php
    $channel = core()->getCurrentChannel();
    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);
@endphp

<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4 mb-4">

            {{-- Brand --}}
            <div class="col-lg-3 col-md-6">
                <div class="mb-3">
                    <img src="{{ core()->getCurrentChannel()->logo_url ?? asset('images/logo.png') }}" alt="Logo" style="max-height: 40px;">
                </div>
                <p class="text-white small mb-3">
                    @lang('shop::app.components.layouts.footer.subscribe-stay-touch')
                </p>
                {{-- Social Icons --}}
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light btn-sm rounded-circle"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-light btn-sm rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="btn btn-light btn-sm rounded-circle"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-light btn-sm rounded-circle"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Footer Links (Desktop) --}}
            <div class="col-lg-4 col-md-6 d-none d-lg-block">
                <div class="row">
                    @if ($customization?->options)
                        @foreach ($customization->options as $footerLinkSection)
                            <div class="col-6">
                                <h6 class="text-uppercase text-white fw-bold small mb-3">
                                    @lang('shop::app.components.layouts.footer.footer-content')
                                </h6>
                                @php
                                    usort($footerLinkSection, function ($a, $b) {
                                        return $a['sort_order'] - $b['sort_order'];
                                    });
                                @endphp
                                <ul class="list-unstyled">
                                    @foreach ($footerLinkSection as $link)
                                        <li class="mb-2">
                                            <a href="{{ $link['url'] }}" class="text-white text-decoration-none small hover-light">
                                                {{ $link['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- Address Section --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-uppercase text-white fw-bold small mb-3">Contact Us</h6>
                <ul class="list-unstyled small">
                    <li class="mb-3 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-warning"></i>
                        <span class="text-white">123 Shopping Street, Market Area, City 12345</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning"></i>
                        <a href="tel:+1234567890" class="text-white text-decoration-none">+1 234 567 890</a>
                    </li>
                    <li class="mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <a href="mailto:support@store.com" class="text-white text-decoration-none">support@store.com</a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-clock-fill text-warning"></i>
                        <span class="text-white">Mon - Fri: 9AM - 6PM</span>
                    </li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="col-lg-3 col-md-6">
                {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}
                @if (core()->getConfigData('customer.settings.newsletter.subscription'))
                    <div class="bg-secondary bg-opacity-25 rounded p-3">
                        <h6 class="fw-bold mb-1">@lang('shop::app.components.layouts.footer.newsletter-text')</h6>
                        <p class="text-white small mb-3">@lang('shop::app.components.layouts.footer.subscribe-stay-touch')</p>
                        <x-shop::form action="{{ route('shop.subscription.store') }}" class="d-flex gap-2">
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter your email" required>
                            <button type="submit" class="btn btn-warning btn-sm">@lang('shop::app.components.layouts.footer.subscribe')</button>
                        </x-shop::form>
                    </div>
                @endif
                {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}
            </div>

        </div>

        {{-- Mobile Accordion --}}
        <div class="d-lg-none mb-4">
            <div class="accordion accordion-flush" id="footerAccordion">
                <div class="accordion-item bg-dark">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#footerLinks">
                            @lang('shop::app.components.layouts.footer.footer-content')
                        </button>
                    </h2>
                    <div id="footerLinks" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
                        <div class="accordion-body">
                            @if ($customization?->options)
                                @foreach ($customization->options as $footerLinkSection)
                                    @php
                                        usort($footerLinkSection, function ($a, $b) {
                                            return $a['sort_order'] - $b['sort_order'];
                                        });
                                    @endphp
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($footerLinkSection as $link)
                                            <li class="mb-2">
                                                <a href="{{ $link['url'] }}" class="text-white text-decoration-none small">{{ $link['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-top border-secondary pt-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}
                <p class="text-white small mb-0">
                    @lang('shop::app.components.layouts.footer.footer-text', ['current_year' => date('Y')])
                </p>
                {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
                <div class="d-flex gap-3">
                    <a href="#" class="text-white text-decoration-none small">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none small">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
