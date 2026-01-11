@php
    $customer = auth()->guard('customer')->user();
@endphp

<!-- Bootstrap Navigation Sidebar -->
<div class="account-sidebar account-main-content">
    <!-- Account Profile Hero Section -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body py-4 px-4">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <img
                        src="{{ $customer->image_url ?? bagisto_asset('images/user-placeholder.png') }}"
                        class="rounded-circle"
                        style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #dee2e6;"
                        alt="Profile Image"
                    >
                </div>

                <div class="flex-grow-1">
                    <p class="mb-1 fw-bold fs-5">
                        Hello! {{ $customer->first_name }}
                    </p>

                    <p class="mb-0 text-muted text-decoration-none small">
                        {{ $customer->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Navigation Menus -->
    @foreach (menu()->getItems('customer') as $menuItem)
        <div class="menu-section mb-4">
            <!-- Account Navigation Toggler -->
            <div class="menu-header mb-3">
                <p class="fs-5 fw-bold mb-0">
                    {{ $menuItem->getName() }}
                </p>
            </div>

            <!-- Account Navigation Content -->
            @if ($menuItem->haveChildren())
                <div class="list-group list-group-flush rounded border">
                    @foreach ($menuItem->getChildren() as $subMenuItem)
                        <a href="{{ $subMenuItem->getUrl() }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 px-4 {{ $subMenuItem->isActive() ? 'active' : '' }}">
                            <div class="d-flex align-items-center gap-3">
                                <span class="{{ $subMenuItem->getIcon() }} fs-4"></span>
                                <span class="fs-6 fw-medium">
                                    {{ $subMenuItem->getName() }}
                                </span>
                            </div>
                            <span class="icon-arrow-right rtl:icon-arrow-left fs-4"></span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>

<!-- Custom Styles for Bootstrap Sidebar -->
<style>
.account-sidebar {
    max-width: 280px;
    min-width: 220px;
}

.menu-section:last-child {
    margin-bottom: 0 !important;
}

.list-group-item {
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
    border-top: 1px solid #dee2e6;
    border-bottom: none;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa !important;
    padding-left: 1.5rem !important;
}

.list-group-item.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: transparent;
    color: #ffffff;
}

.list-group-item.active .icon-arrow-right {
    color: #ffffff;
}

.list-group-item:first-child {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.list-group-item:last-child {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    border-bottom: 1px solid #dee2e6;
}
</style>
