<!-- Page Layout -->
<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.home.contact.title')
    </x-slot>

    <div class="container py-10">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="mb-0 fw-bold">
                            @lang('shop::app.home.contact.title')
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted text-center mb-4">
                            @lang('shop::app.home.contact.about')
                        </p>

                        <!-- Contact Form -->
                        <x-shop::form :action="route('shop.home.contact_us.send_mail')">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    @lang('shop::app.home.contact.name') <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="{{ trans('shop::app.home.contact.name') }}"
                                    required
                                />
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    @lang('shop::app.home.contact.email') <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="{{ trans('shop::app.home.contact.email') }}"
                                    required
                                />
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact -->
                            <div class="mb-3">
                                <label for="contact" class="form-label fw-semibold">
                                    @lang('shop::app.home.contact.phone-number')
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="contact"
                                    name="contact"
                                    value="{{ old('contact') }}"
                                    placeholder="{{ trans('shop::app.home.contact.phone-number') }}"
                                />
                                @error('contact')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="mb-3">
                                <label for="message" class="form-label fw-semibold">
                                    @lang('shop::app.home.contact.desc') <span class="text-danger">*</span>
                                </label>
                                <textarea
                                    class="form-control"
                                    id="message"
                                    name="message"
                                    placeholder="{{ trans('shop::app.home.contact.describe-here') }}"
                                    rows="5"
                                    required
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Captcha -->
                            @if (core()->getConfigData('customer.captcha.credentials.status'))
                                <div class="mb-3">
                                    {!! \Webkul\Customer\Facades\Captcha::render() !!}
                                    @error('g-recaptcha-response')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="text-center mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-primary px-5 py-2 fw-semibold"
                                >
                                    @lang('shop::app.home.contact.submit')
                                </button>
                            </div>
                        </x-shop::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}
    @endpush
</x-shop::layouts>
