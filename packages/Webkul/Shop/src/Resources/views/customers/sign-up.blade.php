<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.customers.signup-form.page-title')" />

    <meta name="keywords" content="@lang('shop::app.customers.signup-form.page-title')" />
@endPush

<x-shop::layouts :has-header="false" :has-feature="false" :has-footer="false">
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.signup-form.page-title')
    </x-slot>

    <div class="container mt-10 max-1180:px-4 max-md:mt-6" style="width: 550px;!important;">
        {!! view_render_event('bagisto.shop.customers.sign-up.logo.before') !!}

        <!-- Company Logo -->
        <div class="flex items-center gap-x-8">
            <a href="{{ route('shop.home.index') }}" class="m-[0_auto_12px_auto]" aria-label="@lang('shop::app.customers.signup-form.bagisto')">
                <img src="/themes/admin/default/build/assets/Saffron__Logo_Removebg.png"
                    alt="Saffron Sweets & Bakery" width="100" height="60" margin-bottom="12px">
            </a>
        </div>

        {!! view_render_event('bagisto.shop.customers.sign-up.logo.before') !!}

        <!-- Form Container -->
        <div
            class="m-auto w-full max-w-[425px] rounded-xl border border-zinc-200/80 bg-white p-3 shadow-lg max-md:p-2 max-sm:border-none max-sm:p-0 max-sm:shadow-none">
            <h1 class="font-dmserif text-lg font-semibold text-zinc-800 max-md:text-base">
                @lang('shop::app.customers.signup-form.page-title')
            </h1>

            <p class="mt-1 text-xs text-zinc-500">
                @lang('shop::app.customers.signup-form.form-signup-text')
            </p>

            <div class="mt-3 rounded">
                <x-shop::form :action="route('shop.customers.register.store')">
                    {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                    <!-- First Name -->
                    <x-shop::form.control-group class="mb-2.5">
                        <x-shop::form.control-group.label class="required mb-1 text-[11px] font-medium text-zinc-700">
                            @lang('shop::app.customers.signup-form.first-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control type="text"
                            class="rounded-lg border-zinc-200 bg-zinc-50/50 px-2.5 py-1 text-xs shadow-md transition-all focus:border-navyBlue focus:bg-white focus:shadow-lg"
                            name="first_name" rules="required" :value="old('first_name')" :label="trans('shop::app.customers.signup-form.first-name')" :placeholder="trans('shop::app.customers.signup-form.first-name')"
                            :aria-label="trans('shop::app.customers.signup-form.first-name')" aria-required="true" />

                        <x-shop::form.control-group.error control-name="first_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.first_name.after') !!}

                    <!-- Last Name -->
                    <x-shop::form.control-group class="mb-2.5">
                        <x-shop::form.control-group.label class="required mb-1 text-[11px] font-medium text-zinc-700">
                            @lang('shop::app.customers.signup-form.last-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control type="text"
                            class="rounded-lg border-zinc-200 bg-zinc-50/50 px-2.5 py-1 text-xs shadow-md transition-all focus:border-navyBlue focus:bg-white focus:shadow-lg"
                            name="last_name" rules="required" :value="old('last_name')" :label="trans('shop::app.customers.signup-form.last-name')" :placeholder="trans('shop::app.customers.signup-form.last-name')"
                            :aria-label="trans('shop::app.customers.signup-form.last-name')" aria-required="true" />

                        <x-shop::form.control-group.error control-name="last_name" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.last_name.after') !!}

                    <!-- Email -->
                    <x-shop::form.control-group class="mb-2.5">
                        <x-shop::form.control-group.label class="required mb-1 text-[11px] font-medium text-zinc-700">
                            @lang('shop::app.customers.signup-form.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control type="email"
                            class="rounded-lg border-zinc-200 bg-zinc-50/50 px-2.5 py-1 text-xs shadow-md transition-all focus:border-navyBlue focus:bg-white focus:shadow-lg"
                            name="email" rules="required|email" :value="old('email')" :label="trans('shop::app.customers.signup-form.email')"
                            placeholder="email@example.com" :aria-label="trans('shop::app.customers.signup-form.email')" aria-required="true" />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.email.after') !!}

                    <!-- Password -->
                    <x-shop::form.control-group class="mb-2.5">
                        <x-shop::form.control-group.label class="required mb-1 text-[11px] font-medium text-zinc-700">
                            @lang('shop::app.customers.signup-form.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control type="password"
                            class="rounded-lg border-zinc-200 bg-zinc-50/50 px-2.5 py-1 text-xs shadow-md transition-all focus:border-navyBlue focus:bg-white focus:shadow-lg"
                            name="password" rules="required|min:6" :value="old('password')" :label="trans('shop::app.customers.signup-form.password')"
                            :placeholder="trans('shop::app.customers.signup-form.password')" ref="password" :aria-label="trans('shop::app.customers.signup-form.password')" aria-required="true" />

                        <x-shop::form.control-group.error control-name="password" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.password.after') !!}

                    <!-- Confirm Password -->
                    <x-shop::form.control-group class="mb-2.5">
                        <x-shop::form.control-group.label class="mb-1 text-[11px] font-medium text-zinc-700">
                            @lang('shop::app.customers.signup-form.confirm-pass')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control type="password"
                            class="rounded-lg border-zinc-200 bg-zinc-50/50 px-2.5 py-1 text-xs shadow-md transition-all focus:border-navyBlue focus:bg-white focus:shadow-lg"
                            name="password_confirmation" rules="confirmed:@password" value="" :label="trans('shop::app.customers.signup-form.password')"
                            :placeholder="trans('shop::app.customers.signup-form.confirm-pass')" :aria-label="trans('shop::app.customers.signup-form.confirm-pass')" aria-required="true" />

                        <x-shop::form.control-group.error control-name="password_confirmation" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.signup_form.password_confirmation.after') !!}

                    <!-- Captcha -->
                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <x-shop::form.control-group>
                            {!! \Webkul\Customer\Facades\Captcha::render() !!}

                            <x-shop::form.control-group.error control-name="g-recaptcha-response" />
                        </x-shop::form.control-group>
                    @endif

                    <!-- Subscribed Button -->
                    @if (core()->getConfigData('customer.settings.create_new_account_options.news_letter'))
                        <div class="mb-3 flex select-none items-center gap-1.5">
                            <input type="checkbox" name="is_subscribed" id="is-subscribed" class="peer hidden" />

                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-base text-navyBlue peer-checked:text-navyBlue"
                                for="is-subscribed"></label>

                            <label class="cursor-pointer select-none text-[11px] text-zinc-600 ltr:pl-0 rtl:pr-0"
                                for="is-subscribed">
                                @lang('shop::app.customers.signup-form.subscribe-to-newsletter')
                            </label>
                        </div>
                    @endif

                    {!! view_render_event('bagisto.shop.customers.signup_form.newsletter_subscription.after') !!}

                    @if (core()->getConfigData('general.gdpr.settings.enabled') && core()->getConfigData('general.gdpr.agreement.enabled'))
                        <div class="mb-2 flex select-none items-center gap-1.5">
                            <x-shop::form.control-group.control type="checkbox" name="agreement" id="agreement"
                                value="0" rules="required" for="agreement" />

                            <label class="cursor-pointer select-none text-[11px] text-zinc-600" for="agreement">
                                {{ core()->getConfigData('general.gdpr.agreement.agreement_label') }}
                            </label>

                            @if (core()->getConfigData('general.gdpr.agreement.agreement_content'))
                                <span class="cursor-pointer text-[11px] text-navyBlue hover:underline"
                                    @click="$refs.termsModal.open()">
                                    @lang('shop::app.customers.signup-form.click-here')
                                </span>
                            @endif
                        </div>

                        <x-shop::form.control-group.error control-name="agreement" />
                    @endif

                    <div class="mt-3 flex flex-wrap items-center justify-center">
                        <!-- Save Button -->
                        <button
                            class="primary-button mx-auto block w-auto rounded-lg px-5 py-1.5 text-center text-xs font-medium shadow-lg transition-all hover:shadow-xl"
                            type="submit">
                            @lang('shop::app.customers.signup-form.button-title')
                        </button>

                        <div class="flex flex-wrap gap-3">
                            {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                </x-shop::form>
            </div>

            <p class="mt-3 text-center text-[11px] text-zinc-500">
                @lang('shop::app.customers.signup-form.account-exists')

                <a class="font-medium text-navyBlue hover:underline" href="{{ route('shop.customer.session.index') }}">
                    @lang('shop::app.customers.signup-form.sign-in-button')
                </a>
            </p>
        </div>

        <p class="mb-4 mt-5 text-center text-xs text-zinc-400">
            © Copyright 2010 - 2026, Saffron Sweets & Bakery. All rights reserved.
        </p>
    </div>

    @push('scripts')
        {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}
    @endpush

    <!-- Terms & Conditions Modal -->
    <x-shop::modal ref="termsModal">
        <x-slot:toggle></x-slot>

        <x-slot:header class="!p-4">
            <p class="text-sm font-medium">@lang('shop::app.customers.signup-form.terms-conditions')</p>
        </x-slot>

        <x-slot:content class="!p-4">
            <div class="max-h-[350px] overflow-auto text-sm">
                {!! core()->getConfigData('general.gdpr.agreement.agreement_content') !!}
            </div>
        </x-slot>
        </x-admin::modal>
</x-shop::layouts>
