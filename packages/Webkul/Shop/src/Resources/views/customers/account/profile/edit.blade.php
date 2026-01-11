<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.profile.edit.edit-profile')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="profile.edit" />
        @endSection
    @endif

    <!-- Sidebar Navigation (Desktop) -->
    <div class="col-lg-3 col-md-4 d-none d-md-block">
        <x-shop::layouts.account.navigation />
    </div>

    <!-- Main Content -->
    <div class="col-lg-9 col-md-8 account-main-content">
        <!-- Page Header -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <!-- Back Button -->
                    <a class="d-md-none me-3 text-decoration-none" href="{{ route('shop.customers.account.profile.index') }}">
                        <span class="icon-arrow-left rtl:icon-arrow-right fs-3"></span>
                    </a>

                    <h2 class="mb-0 fw-bold fs-4">
                        @lang('shop::app.customers.account.profile.edit.edit-profile')
                    </h2>
                </div>
            </div>
        </div>

        <!-- Profile Edit Form Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <!-- Profile Edit Form -->
                <x-shop::form
                    :action="route('shop.customers.account.profile.update')"
                    enctype="multipart/form-data"
                >
                    <!-- Image -->
                    <x-shop::form.control-group class="mt-4">
                        <x-shop::form.control-group.control
                            type="image"
                            class="max-md:[&>*]:[&>*]:rounded-full mb-0 rounded-xl !p-0 text-gray-700 max-md:grid max-md:justify-center"
                            name="image[]"
                            :label="trans('Image')"
                            :is-multiple="false"
                            accepted-types="image/*"
                            :src="$customer->image_url"
                        />

                        <x-shop::form.control-group.error control-name="image[]" />
                    </x-shop::form.control-group>

                    <!-- First Name -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.profile.edit.first-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="first_name"
                            rules="required"
                            :value="old('first_name') ?? $customer->first_name"
                            :label="trans('shop::app.customers.account.profile.edit.first-name')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.first-name')"
                        />

                        <x-shop::form.control-group.error control-name="first_name" />
                    </x-shop::form.control-group>

                    <!-- Last Name -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.profile.edit.last-name')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="last_name"
                            rules="required"
                            :value="old('last_name') ?? $customer->last_name"
                            :label="trans('shop::app.customers.account.profile.edit.last-name')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.last-name')"
                        />

                        <x-shop::form.control-group.error control-name="last_name" />
                    </x-shop::form.control-group>

                    <!-- Email -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.profile.edit.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="email"
                            rules="required|email"
                            :value="old('email') ?? $customer->email"
                            :label="trans('shop::app.customers.account.profile.edit.email')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.email')"
                        />

                        <x-shop::form.control-group.error control-name="email" />
                    </x-shop::form.control-group>

                    <!-- Phone -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.profile.edit.phone')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="text"
                            name="phone"
                            rules="required|phone"
                            :value="old('phone') ?? $customer->phone"
                            :label="trans('shop::app.customers.account.profile.edit.phone')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.phone')"
                        />

                        <x-shop::form.control-group.error control-name="phone" />
                    </x-shop::form.control-group>

                    <!-- Gender -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label class="required">
                            @lang('shop::app.customers.account.profile.edit.gender')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="select"
                            class="mb-3"
                            name="gender"
                            rules="required"
                            :value="old('gender') ?? $customer->gender"
                            :aria-label="trans('shop::app.customers.account.profile.edit.select-gender')"
                            :label="trans('shop::app.customers.account.profile.edit.gender')"
                        >
                            <option value="Other">
                                @lang('shop::app.customers.account.profile.edit.other')
                            </option>

                            <option value="Male">
                                @lang('shop::app.customers.account.profile.edit.male')
                            </option>

                            <option value="Female">
                                @lang('shop::app.customers.account.profile.edit.female')
                            </option>
                        </x-shop::form.control-group.control>

                        <x-shop::form.control-group.error control-name="gender" />
                    </x-shop::form.control-group>

                    <!-- DOB -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.account.profile.edit.dob')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="date"
                            name="date_of_birth"
                            :value="old('date_of_birth') ?? $customer->date_of_birth"
                            :label="trans('shop::app.customers.account.profile.edit.dob')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.dob')"
                        />

                        <x-shop::form.control-group.error control-name="date_of_birth" />
                    </x-shop::form.control-group>

                    <!-- Current Password -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.account.profile.edit.current-password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            name="current_password"
                            value=""
                            :label="trans('shop::app.customers.account.profile.edit.current-password')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.current-password')"
                        />

                        <x-shop::form.control-group.error control-name="current_password" />
                    </x-shop::form.control-group>

                    <!-- New Password -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.account.profile.edit.new-password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            name="new_password"
                            value=""
                            :label="trans('shop::app.customers.account.profile.edit.new-password')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.new-password')"
                        />

                        <x-shop::form.control-group.error control-name="new_password" />
                    </x-shop::form.control-group>

                    <!-- New Password Confirmation -->
                    <x-shop::form.control-group>
                        <x-shop::form.control-group.label>
                            @lang('shop::app.customers.account.profile.edit.confirm-password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            name="new_password_confirmation"
                            rules="confirmed:@new_password"
                            value=""
                            :label="trans('shop::app.customers.account.profile.edit.confirm-password')"
                            :placeholder="trans('shop::app.customers.account.profile.edit.confirm-password')"
                        />

                        <x-shop::form.control-group.error control-name="new_password_confirmation" />
                    </x-shop::form.control-group>

                    <!-- Newsletter Subscription -->
                    <div class="form-check mb-4">
                        <input
                            type="checkbox"
                            name="subscribed_to_news_letter"
                            id="is-subscribed"
                            class="form-check-input"
                            @checked($customer->subscribed_to_news_letter)
                        />

                        <label
                            class="form-check-label"
                            for="is-subscribed"
                        >
                            @lang('shop::app.customers.account.profile.edit.subscribe-to-newsletter')
                        </label>
                    </div>

                    <!-- Save Button -->
                    <button
                        type="submit"
                        class="btn btn-primary-custom w-100"
                    >
                        @lang('shop::app.customers.account.profile.edit.save')
                    </button>

                </x-shop::form>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="col-12 d-md-none">
        <x-shop::layouts.account.navigation />
    </div>
</x-shop::layouts.account>

<style>
.btn-primary-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: #ffffff;
    padding: 12px 25px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #5568d3 0%, #653a92 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}
</style>
