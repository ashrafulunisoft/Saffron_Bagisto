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
        <div class="card mb-4 border-0 shadow overflow-hidden">
            <div class="card-body py-4 px-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative; overflow: hidden;">
                <!-- Decorative circles -->
                <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -30px; right: 30%; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>

                <div class="d-flex align-items-center position-relative">
                    <!-- Back Button -->
                    <a class="d-md-none me-3 text-decoration-none text-white" href="{{ route('shop.customers.account.index') }}">
                        <span class="icon-arrow-left rtl:icon-arrow-right fs-3"></span>
                    </a>

                    <div>
                        <h2 class="mb-1 fw-bold fs-3 text-white">
                            @lang('shop::app.customers.account.orders.title')
                        </h2>
                        <p class="mb-0 text-white-50 small">
                            <i class="icon-info-circle me-1"></i>
                            View and manage your order history
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

        <!-- For Desktop View -->
        <div class="d-none d-md-block">
            <x-shop::datagrid :src="route('shop.customers.account.orders.index')">
                <template #toolbar>
                    <div class="d-none"></div>
                </template>

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
                        <div class="row g-4">
                            <template v-for="record in available.records">
                                <div class="col-lg-6">
                                    <a :href="record.actions[0].url" class="text-decoration-none">
                                        <div class="card h-100 border-0 shadow transition-all" style="border-left: 5px solid #667eea; border-radius: 10px;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                                <i class="icon-shopping-bag text-white small"></i>
                                                            </div>
                                                            <span class="badge bg-light text-dark mb-0">
                                                                @lang('shop::app.customers.account.orders.order-id')
                                                            </span>
                                                        </div>
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
                                                        @lang('shop::app.customers.account.orders.grand-total')
                                                    </p>
                                                    <h4 class="mb-0 fw-bold" style="color: #667eea;">
                                                        @{{ record.grand_total }}
                                                    </h4>
                                                </div>

                                                <div class="mt-3 text-end">
                                                    <span class="text-primary small fw-semibold" style="color: #667eea;">
                                                        View Details <i class="icon-arrow-right rtl:icon-arrow-left ms-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </template>

                            <template v-if="available.records.length === 0">
                                <div class="col-12">
                                    <div class="card border-0 shadow text-center py-5" style="border-radius: 10px;">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <i class="icon-shopping-bag text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                                            </div>
                                            <h5 class="text-muted fw-light mb-3">@lang('shop::app.customers.account.orders.no-orders')</h5>
                                            <a href="{{ route('shop.home.index') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                                <i class="icon-shopping-bag me-2"></i>
                                                Start Shopping
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Custom Pagination -->
                        <div class="mt-4" v-if="available.meta && available.meta.total > available.meta.per_page">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item" v-for="page in getPaginationPages(available.meta)" :key="page"
                                        :class="{ 'active': page === available.meta.current_page }">
                                        <a class="page-link"
                                           :href="getPaginationUrl(page)"
                                           v-text="page"
                                           :class="{ 'bg-primary': page === available.meta.current_page, 'border-primary': page === available.meta.current_page }"
                                           :style="page === available.meta.current_page ? 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-color: #667eea;' : ''">
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </template>
                </template>

                <template #footer="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <div class="d-none"></div>
                </template>

                <script>
                    export default {
                        methods: {
                            getPaginationPages(meta) {
                                const pages = [];
                                for (let i = 1; i <= meta.last_page; i++) {
                                    pages.push(i);
                                }
                                return pages;
                            },
                            getPaginationUrl(page) {
                                const url = new URL(window.location.href);
                                url.searchParams.set('page', page);
                                return url.toString();
                            }
                        }
                    }
                </script>
            </x-shop::datagrid>
        </div>

        <!-- For Mobile View -->
        <div class="d-md-none">
            <x-shop::datagrid :src="route('shop.customers.account.orders.index')">
                <template #toolbar>
                    <div class="d-none"></div>
                </template>

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
                        <div class="row">
                            <template v-for="record in available.records">
                                <div class="col-12 mb-3">
                                    <a :href="record.actions[0].url" class="text-decoration-none">
                                        <div class="card border-0 shadow" style="border-left: 4px solid #667eea; border-radius: 10px;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                                <i class="icon-shopping-bag text-white small"></i>
                                                            </div>
                                                            <span class="badge bg-light text-dark mb-0">
                                                                @lang('shop::app.customers.account.orders.order-id')
                                                            </span>
                                                        </div>
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
                                                        @lang('shop::app.customers.account.orders.grand-total')
                                                    </p>
                                                    <h4 class="mb-0 fw-bold" style="color: #667eea;">
                                                        @{{ record.grand_total }}
                                                    </h4>
                                                </div>

                                                <div class="mt-3 text-end">
                                                    <span class="text-primary small fw-semibold" style="color: #667eea;">
                                                        View Details <i class="icon-arrow-right rtl:icon-arrow-left ms-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </template>

                            <template v-if="available.records.length === 0">
                                <div class="col-12">
                                    <div class="card border-0 shadow text-center py-5" style="border-radius: 10px;">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <i class="icon-shopping-bag text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                                            </div>
                                            <h5 class="text-muted fw-light mb-3">@lang('shop::app.customers.account.orders.no-orders')</h5>
                                            <a href="{{ route('shop.home.index') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-semibold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                                <i class="icon-shopping-bag me-2"></i>
                                                Start Shopping
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Mobile Pagination -->
                        <div class="mt-4" v-if="available.meta && available.meta.total > available.meta.per_page">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item" v-for="page in getPaginationPages(available.meta)" :key="page"
                                        :class="{ 'active': page === available.meta.current_page }">
                                        <a class="page-link"
                                           :href="getPaginationUrl(page)"
                                           v-text="page"
                                           :class="{ 'bg-primary': page === available.meta.current_page, 'border-primary': page === available.meta.current_page }"
                                           :style="page === available.meta.current_page ? 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-color: #667eea;' : ''">
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </template>
                </template>

                <template #footer="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                    <div class="d-none"></div>
                </template>

                <script>
                    export default {
                        methods: {
                            getPaginationPages(meta) {
                                const pages = [];
                                for (let i = 1; i <= meta.last_page; i++) {
                                    pages.push(i);
                                }
                                return pages;
                            },
                            getPaginationUrl(page) {
                                const url = new URL(window.location.href);
                                url.searchParams.set('page', page);
                                return url.toString();
                            }
                        }
                    }
                </script>
            </x-shop::datagrid>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}
    </div>

    <!-- Mobile Navigation -->
    <div class="col-12 d-md-none">
        <x-shop::layouts.account.navigation />
    </div>
</x-shop::layouts.account>
