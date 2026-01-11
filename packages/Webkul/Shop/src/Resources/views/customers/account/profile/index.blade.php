<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.profile.index.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="profile" />
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
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- Back Button -->
                        <a class="d-md-none me-3 text-decoration-none" href="{{ route('shop.customers.account.index') }}">
                            <span class="icon-arrow-left rtl:icon-arrow-right fs-3"></span>
                        </a>

                        <h2 class="mb-0 fw-bold fs-4">
                            @lang('shop::app.customers.account.profile.index.title')
                        </h2>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.edit_button.before') !!}

                    <a href="{{ route('shop.customers.account.profile.edit') }}" class="btn btn-primary-custom">
                        @lang('shop::app.customers.account.profile.index.edit')
                    </a>

                    {!! view_render_event('bagisto.shop.customers.account.profile.edit_button.after') !!}
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    {!! view_render_event('bagisto.shop.customers.account.profile.first_name.before') !!}

                    <!-- First Name -->
                    <div class="col-12 mb-3">
                        <div class="row align-items-center py-3 border-bottom">
                            <div class="col-md-4">
                                <p class="mb-0 fw-bold">
                                    @lang('shop::app.customers.account.profile.index.first-name')
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 text-muted">
                                    {{ $customer->first_name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.first_name.after') !!}

                    {!! view_render_event('bagisto.shop.customers.account.profile.last_name.before') !!}

                    <!-- Last Name -->
                    <div class="col-12 mb-3">
                        <div class="row align-items-center py-3 border-bottom">
                            <div class="col-md-4">
                                <p class="mb-0 fw-bold">
                                    @lang('shop::app.customers.account.profile.index.last-name')
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 text-muted">
                                    {{ $customer->last_name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.last_name.after') !!}

                    {!! view_render_event('bagisto.shop.customers.account.profile.gender.before') !!}

                    <!-- Gender -->
                    <div class="col-12 mb-3">
                        <div class="row align-items-center py-3 border-bottom">
                            <div class="col-md-4">
                                <p class="mb-0 fw-bold">
                                    @lang('shop::app.customers.account.profile.index.gender')
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 text-muted">
                                    {{ $customer->gender ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.gender.after') !!}

                    {!! view_render_event('bagisto.shop.customers.account.profile.date_of_birth.before') !!}

                    <!-- Date of Birth -->
                    <div class="col-12 mb-3">
                        <div class="row align-items-center py-3 border-bottom">
                            <div class="col-md-4">
                                <p class="mb-0 fw-bold">
                                    @lang('shop::app.customers.account.profile.index.dob')
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 text-muted">
                                    {{ $customer->date_of_birth ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.date_of_birth.after') !!}

                    {!! view_render_event('bagisto.shop.customers.account.profile.email.before') !!}

                    <!-- Email -->
                    <div class="col-12 mb-3">
                        <div class="row align-items-center py-3 border-bottom">
                            <div class="col-md-4">
                                <p class="mb-0 fw-bold">
                                    @lang('shop::app.customers.account.profile.index.email')
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0 text-muted text-decoration-none">
                                    {{ $customer->email }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.email.after') !!}

                    {!! view_render_event('bagisto.shop.customers.account.profile.delete.before') !!}

                    <!-- Delete Profile -->
                    <div class="col-12 mt-4">
                        <x-shop::form action="{{ route('shop.customers.account.profile.destroy') }}">
                            <x-shop::modal>
                                <x-slot:toggle>
                                    <button type="button" class="btn btn-danger w-100">
                                        @lang('shop::app.customers.account.profile.index.delete-profile')
                                    </button>
                                </x-slot>

                                <x-slot:header>
                                    <h5 class="fw-bold">
                                        @lang('shop::app.customers.account.profile.index.enter-password')
                                    </h5>
                                </x-slot>

                                <x-slot:content>
                                    <x-shop::form.control-group class="!mb-0">
                                        <label class="form-label fw-bold">Password</label>
                                        <x-shop::form.control-group.control
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            rules="required"
                                            placeholder="Enter your password"
                                        />

                                        <x-shop::form.control-group.error
                                            class="text-danger"
                                            control-name="password"
                                        />
                                    </x-shop::form.control-group>
                                </x-slot>

                                <!-- Modal Footer -->
                                <x-slot:footer>
                                    <button type="submit" class="btn btn-danger">
                                        @lang('shop::app.customers.account.profile.index.delete')
                                    </button>
                                </x-slot>
                            </x-shop::modal>
                        </x-shop::form>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.delete.after') !!}
                </div>
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
    padding: 10px 25px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #5568d3 0%, #653a92 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}
</style>
