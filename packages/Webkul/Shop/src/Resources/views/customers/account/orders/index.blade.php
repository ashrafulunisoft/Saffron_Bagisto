<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.orders.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="orders" />
        @endSection
    @endif

    <!-- Sidebar Navigation (Desktop) -->
    <div class="col-lg-3 col-md-4 d-none d-md-block">
        <x-shop::layouts.account.navigation />
    </div>

    <!-- Main Content -->
    <div class="col-lg-9 col-md-8 account-main-content">
        <!-- Page Header -->
        <div class="card mb-4 border-0 shadow-sm overflow-hidden">
            <div class="card-body py-4 px-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex align-items-center">
                    <!-- Back Button -->
                    <a class="d-md-none me-3 text-decoration-none text-white" href="{{ route('shop.customers.account.index') }}">
                        <span class="icon-arrow-left rtl:icon-arrow-right fs-3"></span>
                    </a>

                    <h2 class="mb-0 fw-bold fs-4 text-white">
                        @lang('shop::app.customers.account.orders.title')
                    </h2>
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

        <!-- For Desktop View -->
        <div class="d-none d-md-block">
            <x-shop::datagrid :src="route('shop.customers.account.orders.index')">
                <template #body="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <template v-if="isLoading">
                        <x-shop::shimmer.datagrid.table.body />
                    </template>

                    <template v-else>
                        <div class="row g-4">
                            <template v-for="record in available.records">
                                <div class="col-lg-6">
                                    <a :href="record.actions[0].url" class="text-decoration-none">
                                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all" style="border-left: 4px solid #667eea;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    <div>
                                                        <span class="badge bg-light text-dark mb-2">
                                                            @lang('shop::app.customers.account.orders.order-id')
                                                        </span>
                                                        <h5 class="mb-1 fw-bold" style="color: #667eea;">
                                                            #@{{ record.id }}
                                                        </h5>
                                                        <p class="small text-muted mb-0">
                                                            <i class="icon-calendar me-1"></i>@{{ record.created_at }}
                                                        </p>
                                                    </div>
                                                    <div v-html="record.status" class="ms-2"></div>
                                                </div>

                                                <div class="pt-3 border-top">
                                                    <p class="small text-muted mb-2">
                                                        @lang('shop::app.customers.account.orders.subtotal')
                                                    </p>
                                                    <h4 class="mb-0 fw-bold" style="color: #667eea;">
                                                        @{{ record.grand_total }}
                                                    </h4>
                                                </div>

                                                <div class="mt-3 text-end">
                                                    <span class="text-primary small">
                                                        View Details <i class="icon-arrow-right rtl:icon-arrow-left"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </template>

                            <template v-if="available.records.length === 0">
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm text-center py-5">
                                        <div class="card-body">
                                            <i class="icon-shopping-bag text-muted mb-3" style="font-size: 4rem;"></i>
                                            <h5 class="text-muted mb-0">@lang('shop::app.customers.account.orders.no-orders')</h5>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </x-shop::datagrid>
        </div>

        <!-- For Mobile View -->
        <div class="d-md-none">
            <x-shop::datagrid :src="route('shop.customers.account.orders.index')">
                <!-- Datagrid Header -->
                <template #header="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <div class="d-none"></div>
                </template>

                <template #body="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <template v-if="isLoading">
                        <x-shop::shimmer.datagrid.table.body />
                    </template>

                    <template v-else>
                        <div class="space-y-3">
                            <template v-for="record in available.records">
                                <a :href="record.actions[0].url" class="text-decoration-none">
                                    <div class="card mb-3 border-0 shadow-sm hover-shadow transition-all" style="border-left: 4px solid #667eea;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <span class="badge bg-light text-dark mb-2">
                                                        @lang('shop::app.customers.account.orders.order-id')
                                                    </span>
                                                    <h5 class="mb-1 fw-bold" style="color: #667eea;">
                                                        #@{{ record.id }}
                                                    </h5>
                                                    <p class="small text-muted mb-0">
                                                        <i class="icon-calendar me-1"></i>@{{ record.created_at }}
                                                    </p>
                                                </div>
                                                <div v-html="record.status" class="ms-2"></div>
                                            </div>

                                            <div class="pt-3 border-top">
                                                <p class="small text-muted mb-2">
                                                    @lang('shop::app.customers.account.orders.subtotal')
                                                </p>
                                                <h4 class="mb-0 fw-bold" style="color: #667eea;">
                                                    @{{ record.grand_total }}
                                                </h4>
                                            </div>

                                            <div class="mt-3 text-end">
                                                <span class="text-primary small">
                                                    View Details <i class="icon-arrow-right rtl:icon-arrow-left"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </template>

                            <template v-if="available.records.length === 0">
                                <div class="card border-0 shadow-sm text-center py-5">
                                    <div class="card-body">
                                        <i class="icon-shopping-bag text-muted mb-3" style="font-size: 4rem;"></i>
                                        <h5 class="text-muted mb-0">@lang('shop::app.customers.account.orders.no-orders')</h5>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </x-shop::datagrid>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}
    </div>

    <!-- Mobile Navigation -->
    <div class="col-12 d-md-none">
        <x-shop::layouts.account.navigation />
    </div>
</x-shop::layouts.account>
