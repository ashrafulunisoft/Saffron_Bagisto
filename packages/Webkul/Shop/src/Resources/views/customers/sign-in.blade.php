w<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.customers.login-form.page-title')"/>

    <meta name="keywords" content="@lang('shop::app.customers.login-form.page-title')"/>
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.login-form.page-title')
    </x-slot>

    <div class="container mt-10 max-1180:px-5 max-md:mt-6 max-sm:mt-4">
        {!! view_render_event('bagisto.shop.customers.login.logo.before') !!}

        <!-- Company Logo -->
        <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
            <a
                href="{{ route('shop.home.index') }}"
                class="m-[0_auto_20px_auto]"
                aria-label="@lang('shop::app.customers.login-form.bagisto')"
            >
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    width="131"
                    height="29"
                >
            </a>
        </div>

        {!! view_render_event('bagisto.shop.customers.login.logo.after') !!}

        <!-- Form Container -->
        <div class="m-auto w-full max-w-[400px] rounded-xl border border-zinc-200 p-6 px-6 max-md:px-4 max-md:py-4 max-sm:border-none max-sm:p-0">
            <h1 class="font-dmserif text-2xl max-md:text-xl max-sm:text-lg">
                @lang('shop::app.customers.login-form.page-title')
            </h1>

            <p class="mt-2 text-base text-zinc-500 max-sm:mt-1 max-sm:text-xs">
                @lang('shop::app.customers.login-form.form-login-text')
            </p>

            {!! view_render_event('bagisto.shop.customers.login.before') !!}

            <div class="mt-6 rounded max-sm:mt-4">
                <x-shop::form :action="route('shop.customer.session.create')">

                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                    <!-- Email -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.login-form.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="px-3 py-2 max-md:py-1.5 max-sm:py-1 text-sm"
                            name="email"
                            rules="required|email"
                            value=""
                            :label="trans('shop::app.customers.login-form.email')"
                            placeholder="email@example.com"
                            :aria-label="trans('shop::app.customers.login-form.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    <!-- Password -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.login-form.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="px-3 py-2 max-md:py-1.5 max-sm:py-1 text-sm"
                            id="password"
                            name="password"
                            rules="required|min:6"
                            value=""
                            :label="trans('shop::app.customers.login-form.password')"
                            :placeholder="trans('shop::app.customers.login-form.password')"
                            :aria-label="trans('shop::app.customers.login-form.password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error control-name="password" />
                    </x-shop::form.control-group>

                    <div class="flex justify-between">
                        <div class="flex select-none items-center gap-1.5">
                            <input
                                type="checkbox"
                                id="show-password"
                                class="peer hidden"
                                onchange="switchVisibility()"
                            />

                            <label
                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-lg text-navyBlue peer-checked:text-navyBlue max-sm:text-base"
                                for="show-password"
                            ></label>

                            <label
                                class="cursor-pointer select-none text-sm text-zinc-500 max-sm:text-xs ltr:pl-0 rtl:pr-0"
                                for="show-password"
                            >
                                @lang('shop::app.customers.login-form.show-password')
                            </label>
                        </div>

                        <div class="block">
                            <a
                                href="{{ route('shop.customers.forgot_password.create') }}"
                                class="cursor-pointer text-sm text-black max-sm:text-xs"
                            >
                                <span>
                                    @lang('shop::app.customers.login-form.forgot-pass')
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Captcha -->
                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <x-shop::form.control-group class="mt-5">
                            {!! \Webkul\Customer\Facades\Captcha::render() !!}

                            <x-shop::form.control-group.error control-name="g-recaptcha-response" />
                        </x-shop::form.control-group>
                    @endif

                    <!-- Submit Button -->
                    <div class="mt-5 flex flex-wrap items-center gap-6 max-sm:justify-center max-sm:gap-3 max-sm:text-center">
                        <button
                            class="primary-button m-0 mx-auto block w-full max-w-[280px] rounded-lg px-6 py-2.5 text-center text-sm max-md:max-w-full max-md:rounded-md max-md:py-2 max-sm:py-1.5 max-sm:text-xs ltr:ml-0 rtl:mr-0"
                            type="submit"
                        >
                            @lang('shop::app.customers.login-form.button-title')
                        </button>

                        {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}
                    </div>
                </x-shop::form>
            </div>

            {!! view_render_event('bagisto.shop.customers.login.after') !!}

            <p class="mt-4 font-medium text-zinc-500 max-sm:text-center max-sm:text-xs">
                @lang('shop::app.customers.login-form.new-customer')

                <a
                    class="text-navyBlue"
                    href="{{ route('shop.customers.register.index') }}"
                >
                    @lang('shop::app.customers.login-form.create-your-account')
                </a>
            </p>
        </div>

        <p class="mb-2 mt-5 text-center text-[10px] text-zinc-500">
            @lang('shop::app.customers.login-form.footer', ['current_year'=> date('Y') ])
        </p>
    </div>

    @push('scripts')
        {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}

        <script>
            function switchVisibility() {
                let passwordField = document.getElementById("password");

                passwordField.type = passwordField.type === "password"
                    ? "text"
                    : "password";
            }
        </script>
    @endpush
</x-shop::layouts>
