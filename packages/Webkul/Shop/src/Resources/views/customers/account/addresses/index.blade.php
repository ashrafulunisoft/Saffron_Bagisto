<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.index.add-address')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="addresses" />
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
                            @lang('shop::app.customers.account.addresses.index.title')
                        </h2>
                    </div>

                    <a href="{{ route('shop.customers.account.addresses.create') }}" class="btn btn-primary-custom">
                        @lang('shop::app.customers.account.addresses.index.add-address')
                    </a>
                </div>
            </div>
        </div>

        @if (! $addresses->isEmpty())
            <!-- Address Information -->
            <div class="row g-4 mt-4">
                {!! view_render_event('bagisto.shop.customers.account.addresses.list.before', ['addresses' => $addresses]) !!}

                @foreach ($addresses as $address)
                    <div class="col-lg-6 col-md-12">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 fw-bold">
                                            {{ $address->first_name }} {{ $address->last_name }}

                                            @if ($address->company_name)
                                                <small class="text-muted">({{ $address->company_name }})</small>
                                            @endif
                                        </h5>
                                    </div>

                                    <div class="d-flex gap-2 align-items-center">
                                        @if ($address->default_address)
                                            <span class="badge bg-primary">
                                                @lang('shop::app.customers.account.addresses.index.default-address')
                                            </span>
                                        @endif

                                        <!-- Dropdown Actions -->
                                        <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                                            <x-slot:toggle>
                                                <button
                                                    class="btn btn-sm btn-outline-secondary"
                                                    aria-label="More Options"
                                                >
                                                    <span class="icon-more"></span>
                                                </button>
                                            </x-slot>

                                            <x-slot:menu>
                                                <x-shop::dropdown.menu.item>
                                                    <a href="{{ route('shop.customers.account.addresses.edit', $address->id) }}" class="text-decoration-none text-dark">
                                                        @lang('shop::app.customers.account.addresses.index.edit')
                                                    </a>
                                                </x-shop::dropdown.menu.item>

                                                <x-shop::dropdown.menu.item>
                                                    <form
                                                        method="POST"
                                                        ref="addressDelete"
                                                        action="{{ route('shop.customers.account.addresses.delete', $address->id) }}"
                                                    >
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>

                                                    <a href="javascript:void(0);"
                                                       @click="$emitter.emit('open-confirm-modal', {
                                                           agree: () => {
                                                               $refs['addressDelete'].submit()
                                                           }
                                                       })"
                                                       class="text-decoration-none text-danger"
                                                    >
                                                        @lang('shop::app.customers.account.addresses.index.delete')
                                                    </a>
                                                </x-shop::dropdown.menu.item>

                                                @if (! $address->default_address)
                                                    <x-shop::dropdown.menu.item>
                                                        <form
                                                            method="POST"
                                                            ref="setAsDefault"
                                                            action="{{ route('shop.customers.account.addresses.update.default', $address->id) }}"
                                                        >
                                                            @method('PATCH')
                                                            @csrf
                                                        </form>

                                                        <a href="javascript:void(0);"
                                                           @click="$emitter.emit('open-confirm-modal', {
                                                               agree: () => {
                                                                   $refs['setAsDefault'].submit()
                                                               }
                                                           })"
                                                           class="text-decoration-none text-dark"
                                                        >
                                                            @lang('shop::app.customers.account.addresses.index.set-as-default')
                                                        </a>
                                                    </x-shop::dropdown.menu.item>
                                                @endif
                                            </x-slot>
                                        </x-shop::dropdown>
                                    </div>
                                </div>

                                <p class="text-muted mb-0">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    {{ $address->address }},

                                    {{ $address->city }},
                                    {{ $address->state }}, {{ $address->country }},
                                    {{ $address->postcode }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {!! view_render_event('bagisto.shop.customers.account.addresses.list.after', ['addresses' => $addresses]) !!}

        @else
            <!-- Address Empty Page -->
            <div class="card border-0 text-center py-5">
                <div class="card-body">
                    <img
                        class="mb-4"
                        src="{{ bagisto_asset('images/no-address.png') }}"
                        alt="Empty Address"
                        title=""
                        style="max-width: 200px;"
                    >

                    <p class="h5 mb-0">
                        @lang('shop::app.customers.account.addresses.index.empty-address')
                    </p>
                </div>
            </div>
        @endif
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
