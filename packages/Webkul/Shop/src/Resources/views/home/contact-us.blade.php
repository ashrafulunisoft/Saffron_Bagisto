<!-- Page Layout -->
<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.home.contact.title')
    </x-slot>

    <div class="container py-5" style="background: min-height: 100vh; padding-top: 80px !important; padding-bottom: 80px !important;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card rounded-4 overflow-hidden" style="background: rgba(255, 255, 255, 0.95); box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37), 0 4px 16px 0 rgba(31, 38, 135, 0.25); border: 1px solid rgba(255, 255, 255, 0.3);">
                    <div class="text-white text-center py-4 px-4" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.3);">
                        <h3 class="mb-0 fw-bold" style="font-size: 1.75rem; color: white !important;">
                            @lang('shop::app.home.contact.title')
                        </h3>
                    </div>
                    <div class="p-5">
                        <p class="text-center mb-5" style="color: #555; font-size: 1.1rem;">
                            @lang('shop::app.home.contact.about')
                        </p>

                        <!-- Contact Form -->
                        <x-shop::form :action="route('shop.home.contact_us.send_mail')">
                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold" style="color: #333; font-size: 1rem;">
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
                                    style="background: #f8f9fa; border: 2px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8);"
                                />
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold" style="color: #333; font-size: 1rem;">
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
                                    style="background: #f8f9fa; border: 2px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8);"
                                />
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact -->
                            <div class="mb-4">
                                <label for="contact" class="form-label fw-semibold" style="color: #333; font-size: 1rem;">
                                    @lang('shop::app.home.contact.phone-number')
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="contact"
                                    name="contact"
                                    value="{{ old('contact') }}"
                                    placeholder="{{ trans('shop::app.home.contact.phone-number') }}"
                                    style="background: #f8f9fa; border: 2px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8);"
                                />
                                @error('contact')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="mb-4">
                                <label for="message" class="form-label fw-semibold" style="color: #333; font-size: 1rem;">
                                    @lang('shop::app.home.contact.desc') <span class="text-danger">*</span>
                                </label>
                                <textarea
                                    class="form-control"
                                    id="message"
                                    name="message"
                                    placeholder="{{ trans('shop::app.home.contact.describe-here') }}"
                                    rows="5"
                                    required
                                    style="background: #f8f9fa; border: 2px solid #e0e0e0; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.8);"
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Captcha -->
                            @if (core()->getConfigData('customer.captcha.credentials.status'))
                                <div class="mb-4">
                                    {!! \Webkul\Customer\Facades\Captcha::render() !!}
                                    @error('g-recaptcha-response')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="text-center mt-5">
                                <button
                                    type="submit"
                                    class="btn text-white px-5 py-3 fw-semibold rounded-3"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; border: none !important; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4), 0 2px 6px rgba(0, 0, 0, 0.1); font-size: 1.1rem;"
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
