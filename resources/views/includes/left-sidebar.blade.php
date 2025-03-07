<section>
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li @if (Request::url() === route('dashboard')) class="active" @endif>
                    <a href="{{ route('dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>{{ __('root.menu.dashboard') }}</span>
                    </a>
                </li>
                {{-- Branch  Start --}}
                <li @if (config('role_manage.Branch.All') == 0 and
                    config('role_manage.Branch.TrashShow') == 0 and
                    config('role_manage.Branch.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('branch') or
                        Request::url() === route('branch.create') or
                        Request::url() === route('branch.trashed') or
                        Request::url() === route('branch.active.search') or
                        Request::url() === route('branch.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-project-diagram"></i>
                        <span>{{ __('root.menu.branch') }} </span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('branch') or Request::url() === route('branch.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Branch.All') == 0) style="display: none" @endif
                                href="{{ route('branch') }}">{{ __('root.menu.branch_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('branch.create')) class="active" @endif>
                            <a @if (config('role_manage.Branch.Create') == 0) style="display: none" @endif
                                href="{{ route('branch.create') }}">{{ __('root.menu.branch_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('branch.trashed') or Request::url() === route('branch.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Branch.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('branch.trashed') }}">{{ __('root.menu.branch_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- Branch End --}}

                {{-- Product  Start --}}
                <li @if (config('role_manage.Product.All') == 0 and
                    config('role_manage.Product.TrashShow') == 0 and
                    config('role_manage.Product.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('product') or
                        Request::url() === route('product.create') or
                        Request::url() === route('product.trashed') or
                        Request::url() === route('product.active.search') or
                        Request::url() === route('product.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-boxes"></i>
                        <span>{{ __('root.menu.product') }} </span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('product') or Request::url() === route('product.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Product.All') == 0) style="display: none" @endif
                                href="{{ route('product') }}">{{ __('root.menu.product_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('product.create')) class="active" @endif>
                            <a @if (config('role_manage.Product.Create') == 0) style="display: none" @endif
                                href="{{ route('product.create') }}">{{ __('root.menu.product_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('product.trashed') or Request::url() === route('product.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Product.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('product.trashed') }}">{{ __('root.menu.product_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- Product End --}}

                {{-- Sell  Start --}}
                <li @if (config('role_manage.Sell.All') == 0 and
                    config('role_manage.Sell.TrashShow') == 0 and
                    config('role_manage.Sell.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('sell') or
                        Request::url() === route('sell.create') or
                        Request::url() === route('sell.trashed') or
                        Request::url() === route('sell.active.search') or
                        Request::url() === route('sell.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-dolly"></i>
                        <span>{{ __('root.menu.sell') }} </span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('sell') or Request::url() === route('sell.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Sell.All') == 0) style="display: none" @endif
                                href="{{ route('sell') }}">{{ __('root.menu.sell_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('sell.create')) class="active" @endif>
                            <a @if (config('role_manage.Sell.Create') == 0) style="display: none" @endif
                                href="{{ route('sell.create') }}">{{ __('root.menu.sell_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('sell.trashed') or Request::url() === route('sell.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Sell.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('sell.trashed') }}">{{ __('root.menu.sell_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- Sells End --}}

                {{-- Purchase Start --}}
                <li @if (config('role_manage.PurchaseRequisition.All') == 0 and
                    config('role_manage.PurchaseRequisition.TrashShow') == 0 and
                    config('role_manage.PurchaseRequisition.Create') == 0 and
                    config('role_manage.PurchaseRQNConfirm.All') == 0 and
                    config('role_manage.PurchaseRQNConfirm.TrashShow') == 0 and
                    config('role_manage.PurchaseRQNConfirm.Create') == 0 and
                    config('role_manage.PurchaseOrder.All') == 0 and
                    config('role_manage.PurchaseOrder.TrashShow') == 0 and
                    config('role_manage.PurchaseOrder.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('purchase_requisition') or
                        Request::url() === route('purchase_requisition.create') or
                        Request::url() === route('purchase_requisition.trashed') or
                        Request::url() === route('requisition_confirmed') or
                        Request::url() === route('requisition_confirmed.create') or
                        Request::url() === route('requisition_confirmed.trashed') or
                        Request::url() === route('purchase_order') or
                        Request::url() === route('purchase_order.create') or
                        Request::url() === route('purchase_order.trashed')) class="active " @endif>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-shopping-cart"></i>
                        <span>{{ __('root.menu.purchase') }}</span>
                    </a>
                    <ul class="ml-menu">
                        {{-- Purchase Requisition Start --}}
                        <li @if (config('role_manage.PurchaseRequisition.All') == 0 and
                            config('role_manage.PurchaseRequisition.TrashShow') == 0 and
                            config('role_manage.PurchaseRequisition.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('purchase_requisition') or
                                Request::url() === route('purchase_requisition.create') or
                                Request::url() === route('purchase_requisition.trashed') or
                                Request::url() === route('purchase_requisition.active.search') or
                                Request::url() === route('purchase_requisition.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.requisition') }} </span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (Request::url() === route('purchase_requisition') or
                                    Request::url() === route('purchase_requisition.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseRequisition.All') == 0) style="display: none" @endif
                                        href="{{ route('purchase_requisition') }}">{{ __('root.menu.requisition_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('purchase_requisition.create')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseRequisition.Create') == 0) style="display: none" @endif
                                        href="{{ route('purchase_requisition.create') }}">{{ __('root.menu.requisition_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('purchase_requisition.trashed') or
                                    Request::url() === route('purchase_requisition.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseRequisition.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('purchase_requisition.trashed') }}">{{ __('root.menu.requisition_trashed') }}</a>
                                </li>
                            </ul>
                        </li>
                        {{-- Purchase Requisiton End --}}

                        {{-- Requisition Confirmed Start --}}
                        <li @if (config('role_manage.PurchaseRQNConfirm.All') == 0 and
                            config('role_manage.PurchaseRQNConfirm.TrashShow') == 0 and
                            config('role_manage.PurchaseRQNConfirm.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('requisition_confirmed') or
                                Request::url() === route('requisition_confirmed.create') or
                                Request::url() === route('requisition_confirmed.trashed') or
                                Request::url() === route('requisition_confirmed.active.search') or
                                Request::url() === route('requisition_confirmed.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.requisition_confirmed') }} </span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (Request::url() === route('requisition_confirmed') or
                                    Request::url() === route('requisition_confirmed.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseRQNConfirm.All') == 0) style="display: none" @endif
                                        href="{{ route('requisition_confirmed') }}">{{ __('root.menu.requisition_confirmed_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('requisition_confirmed.create')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseRQNConfirm.Create') == 0) style="display: none" @endif
                                        href="{{ route('requisition_confirmed.create') }}">{{ __('root.menu.requisition_confirmed_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('requisition_confirmed.trashed') or
                                    Request::url() === route('requisition_confirmed.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseRQNConfirm.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('requisition_confirmed.trashed') }}">{{ __('root.menu.requisition_confirmed_trashed') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Purchase Order --}}
                        <li @if (config('role_manage.PurchaseOrder.All') == 0 and
                            config('role_manage.PurchaseOrder.TrashShow') == 0 and
                            config('role_manage.PurchaseOrder.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('purchase_order') or
                                Request::url() === route('purchase_order.create') or
                                Request::url() === route('purchase_order.trashed') or
                                Request::url() === route('purchase_order.active.search') or
                                Request::url() === route('purchase_order.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.purchase_order') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (Request::url() === route('purchase_order') or Request::url() === route('purchase_order.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseOrder.All') == 0) style="display: none" @endif
                                        href="{{ route('purchase_order') }}">{{ __('root.menu.purchase_order_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('purchase_order.create')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseOrder.Create') == 0) style="display: none" @endif
                                        href="{{ route('purchase_order.create') }}">{{ __('root.menu.purchase_order_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('purchase_order.trashed') or
                                    Request::url() === route('purchase_order.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.PurchaseOrder.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('purchase_order.trashed') }}">{{ __('root.menu.purchase_order_trashed') }}</a>
                                </li>
                            </ul>
                        </li>
                        {{-- Requisiton Confirmed End --}}
                    </ul>
                </li>
                {{-- Purchase End --}}

                {{-- Vendor  Start --}}
                <li @if (config('role_manage.Vendor.All') == 0 and
                    config('role_manage.Vendor.TrashShow') == 0 and
                    config('role_manage.Vendor.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('vendor') or
                        Request::url() === route('vendor.create') or
                        Request::url() === route('vendor.trashed') or
                        Request::url() === route('vendor.active.search') or
                        Request::url() === route('vendor.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-industry"></i>
                        <span>{{ __('root.menu.vendor') }} </span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('vendor') or Request::url() === route('vendor.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Vendor.All') == 0) style="display: none" @endif
                                href="{{ route('vendor') }}">{{ __('root.menu.vendor_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('vendor.create')) class="active" @endif>
                            <a @if (config('role_manage.Vendor.Create') == 0) style="display: none" @endif
                                href="{{ route('vendor.create') }}">{{ __('root.menu.vendor_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('vendor.trashed') or Request::url() === route('vendor.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Vendor.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('vendor.trashed') }}">{{ __('root.menu.vendor_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- Vedor End --}}

                {{-- Employee  Start --}}
                <li @if (config('role_manage.Employee.All') == 0 and
                    config('role_manage.Employee.TrashShow') == 0 and
                    config('role_manage.Employee.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('employee') or
                        Request::url() === route('employee.create') or
                        Request::url() === route('employee.trashed') or
                        Request::url() === route('employee.active.search') or
                        Request::url() === route('employee.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-graduate"></i>
                        <span>{{ __('root.menu.employee') }} </span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('employee') or Request::url() === route('employee.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Employee.All') == 0) style="display: none" @endif
                                href="{{ route('employee') }}">{{ __('root.menu.employee_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('employee.create')) class="active" @endif>
                            <a @if (config('role_manage.Employee.Create') == 0) style="display: none" @endif
                                href="{{ route('employee.create') }}">{{ __('root.menu.employee_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('employee.trashed') or Request::url() === route('employee.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Employee.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('employee.trashed') }}">{{ __('root.menu.employee_trashed') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- Employee End --}}

                {{-- Customer  Start --}}
                <li @if (config('role_manage.Customer.All') == 0 and
                    config('role_manage.Customer.TrashShow') == 0 and
                    config('role_manage.Customer.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('customer') or
                        Request::url() === route('customer.create') or
                        Request::url() === route('customer.trashed') or
                        Request::url() === route('customer.active.search') or
                        Request::url() === route('customer.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-tie"></i>
                        <span>{{ __('root.menu.customer') }} </span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('customer') or Request::url() === route('customer.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Customer.All') == 0) style="display: none" @endif
                                href="{{ route('customer') }}">{{ __('root.menu.customer_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('customer.create')) class="active" @endif>
                            <a @if (config('role_manage.Customer.Create') == 0) style="display: none" @endif
                                href="{{ route('customer.create') }}">{{ __('root.menu.customer_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('customer.trashed') or Request::url() === route('branch.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Customer.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('customer.trashed') }}">{{ __('root.menu.customer_trashed') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- Customer End --}}


                {{-- Ledger --}}
                <li @if (config('role_manage.LedgerType.All') == 0 and
                    config('role_manage.LedgerType.TrashShow') == 0 and
                    config('role_manage.LedgerType.Create') == 0 and
                    config('role_manage.LedgerGroup.All') == 0 and
                    config('role_manage.LedgerGroup.TrashShow') == 0 and
                    config('role_manage.LedgerGroup.Create') == 0 and
                    config('role_manage.LedgerName.All') == 0 and
                    config('role_manage.LedgerName.TrashShow') == 0 and
                    config('role_manage.LedgerName.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('income_expense_type') or
                        Request::url() === route('income_expense_type.create') or
                        Request::url() === route('income_expense_type.trashed') or
                        Request::url() === route('income_expense_type.active.search') or
                        Request::url() === route('income_expense_type.trashed.search') or
                        Request::url() === route('income_expense_group') or
                        Request::url() === route('income_expense_group.create') or
                        Request::url() === route('income_expense_group.trashed') or
                        Request::url() === route('income_expense_group.active.search') or
                        Request::url() === route('income_expense_group.trashed.search') or
                        Request::url() === route('income_expense_head') or
                        Request::url() === route('income_expense_head.create') or
                        Request::url() === route('income_expense_head.trashed') or
                        Request::url() === route('income_expense_head.active.search') or
                        Request::url() === route('income_expense_head.trashed.search')) class="active" @endif>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>{{ __('root.menu.ledger') }} </span>
                    </a>
                    <ul class="ml-menu">

                        {{-- Ledger Type Start --}}
                        <li @if (config('role_manage.LedgerType.All') == 0 and
                            config('role_manage.LedgerType.TrashShow') == 0 and
                            config('role_manage.LedgerType.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('income_expense_type') or
                                Request::url() === route('income_expense_type.create') or
                                Request::url() === route('income_expense_type.trashed') or
                                Request::url() === route('income_expense_type.active.search') or
                                Request::url() === route('income_expense_type.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.type') }} </span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (Request::url() === route('income_expense_type') or
                                    Request::url() === route('income_expense_type.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerType.All') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_type') }}">{{ __('root.menu.type_all') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Income Expense Type End --}}

                        {{-- Ledger Group Start --}}
                        <li @if (config('role_manage.LedgerGroup.All') == 0 and
                            config('role_manage.LedgerGroup.TrashShow') == 0 and
                            config('role_manage.LedgerGroup.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('income_expense_group') or
                                Request::url() === route('income_expense_group.create') or
                                Request::url() === route('income_expense_group.trashed') or
                                Request::url() === route('income_expense_group.active.search') or
                                Request::url() === route('income_expense_group.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.group') }} </span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (Request::url() === route('income_expense_group') or
                                    Request::url() === route('income_expense_group.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerGroup.All') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_group') }}">{{ __('root.menu.group_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_group.create')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerGroup.Create') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_group.create') }}">{{ __('root.menu.group_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_group.trashed') or
                                    Request::url() === route('income_expense_group.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerGroup.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_group.trashed') }}">{{ __('root.menu.group_trashed') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Ledger Group End --}}

                        {{-- Ledger Name Start --}}
                        <li @if (config('role_manage.LedgerName.All') == 0 and
                            config('role_manage.LedgerName.TrashShow') == 0 and
                            config('role_manage.LedgerName.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('income_expense_head') or
                                Request::url() === route('income_expense_head.create') or
                                Request::url() === route('income_expense_head.trashed') or
                                Request::url() === route('income_expense_head.active.search') or
                                Request::url() === route('income_expense_head.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.name') }} </span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (Request::url() === route('income_expense_head') or
                                    Request::url() === route('income_expense_head.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerName.All') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_head') }}">{{ __('root.menu.name_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_head.create')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerName.Create') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_head.create') }}">{{ __('root.menu.name_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('income_expense_head.trashed') or
                                    Request::url() === route('income_expense_head.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.LedgerName.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('income_expense_head.trashed') }}">{{ __('root.menu.name_trashed') }}</a>
                                </li>
                            </ul>
                        </li>
                        {{-- Ledger Name End --}}
                    </ul>
                </li>
                {{-- Ledger End --}}

                {{-- Bank Cash Start --}}
                <li @if (config('role_manage.BankCash.All') == 0 and
                    config('role_manage.BankCash.TrashShow') == 0 and
                    config('role_manage.BankCash.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('bank_cash') or
                        Request::url() === route('bank_cash.create') or
                        Request::url() === route('bank_cash.trashed') or
                        Request::url() === route('bank_cash.active.search') or
                        Request::url() === route('bank_cash.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-university"></i>
                        <span>{{ __('root.menu.bank_cash') }}</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('bank_cash') or Request::url() === route('bank_cash.active.search')) class="active" @endif>
                            <a @if (config('role_manage.BankCash.All') == 0) style="display: none" @endif
                                href="{{ route('bank_cash') }}">{{ __('root.menu.bank_cash_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('bank_cash.create')) class="active" @endif>
                            <a @if (config('role_manage.BankCash.Create') == 0) style="display: none" @endif
                                href="{{ route('bank_cash.create') }}">{{ __('root.menu.bank_cash_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('bank_cash.trashed') or Request::url() === route('bank_cash.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.BankCash.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('bank_cash.trashed') }}">{{ __('root.menu.bank_cash_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                @if (env('DEMO_MODE', false) == false && env('INITIAL_BALANCE_ACTIVITY',false) == true)
                    {{-- Opening Balance Start --}}
                    <li @if (config('role_manage.InitialIncomeExpenseHeadBalance.All') == 0 and
                        config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow') == 0 and
                        config('role_manage.InitialIncomeExpenseHeadBalance.Create') == 0 and
                        config('role_manage.InitialBankCashBalance.All') == 0 and
                        config('role_manage.InitialBankCashBalance.TrashShow') == 0 and
                        config('role_manage.InitialBankCashBalance.Create') == 0) style="display: none" @endif
                        @if (Request::url() === route('initial_bank_cash_balance') or
                            Request::url() === route('initial_bank_cash_balance.create') or
                            Request::url() === route('initial_bank_cash_balance.trashed') or
                            Request::url() === route('initial_bank_cash_balance.active.search') or
                            Request::url() === route('initial_bank_cash_balance.trashed.search') or
                            Request::url() === route('initial_income_expense_head_balance') or
                            Request::url() === route('initial_income_expense_head_balance.create') or
                            Request::url() === route('initial_income_expense_head_balance.trashed') or
                            Request::url() === route('initial_income_expense_head_balance.active.search') or
                            Request::url() === route('initial_income_expense_head_balance.trashed.search')) class="active " @endif>
                        <a class="menu-toggle" href="javascript:void(0);">
                            <i class="fas fa-balance-scale"></i>
                            <span>Initial Balance</span>
                        </a>
                        <ul class="ml-menu">
                            {{-- Initial Bank Cash Balance Start --}}
                            <li @if (config('role_manage.InitialBankCashBalance.All') == 0 and
                                config('role_manage.InitialBankCashBalance.TrashShow') == 0 and
                                config('role_manage.InitialBankCashBalance.Create') == 0) style="display: none" @endif
                                @if (Request::url() === route('initial_bank_cash_balance') or
                                    Request::url() === route('initial_bank_cash_balance.create') or
                                    Request::url() === route('initial_bank_cash_balance.trashed') or
                                    Request::url() === route('initial_bank_cash_balance.active.search') or
                                    Request::url() === route('initial_bank_cash_balance.trashed.search')) class="active " @endif>
                                <a class="menu-toggle " href="javascript:void(0);">
                                    <span>Bank or Cash </span>
                                </a>
                                <ul class="ml-menu">
                                    <li @if (Request::url() === route('initial_bank_cash_balance') or
                                        Request::url() === route('initial_bank_cash_balance.active.search')) class="active" @endif>
                                        <a @if (config('role_manage.InitialBankCashBalance.All') == 0) style="display: none" @endif
                                            href="{{ route('initial_bank_cash_balance') }}">All</a>
                                    </li>
                                    <li @if (Request::url() === route('initial_bank_cash_balance.create')) class="active" @endif>
                                        <a @if (config('role_manage.InitialBankCashBalance.Create') == 0) style="display: none" @endif
                                            href="{{ route('initial_bank_cash_balance.create') }}">Create</a>
                                    </li>
                                    <li @if (Request::url() === route('initial_bank_cash_balance.trashed') or
                                        Request::url() === route('initial_bank_cash_balance.trashed.search')) class="active" @endif>
                                        <a @if (config('role_manage.InitialBankCashBalance.TrashShow') == 0) style="display: none" @endif
                                            href="{{ route('initial_bank_cash_balance.trashed') }}">Trashed</a>
                                    </li>
                                </ul>
                            </li>
                            {{-- Initial Bank Cash Balance End --}}
                            {{-- initial_income_expense_head_balance Start --}}
                            <li @if (config('role_manage.InitialIncomeExpenseHeadBalance.All') == 0 and
                                config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow') == 0 and
                                config('role_manage.InitialIncomeExpenseHeadBalance.Create') == 0) style="display: none" @endif
                                @if (Request::url() === route('initial_income_expense_head_balance') or
                                    Request::url() === route('initial_income_expense_head_balance.create') or
                                    Request::url() === route('initial_income_expense_head_balance.trashed') or
                                    Request::url() === route('initial_income_expense_head_balance.active.search') or
                                    Request::url() === route('initial_income_expense_head_balance.trashed.search')) class="active " @endif>
                                <a class="menu-toggle " href="javascript:void(0);">
                                    <span>Ledger</span>
                                </a>
                                <ul class="ml-menu">
                                    <li @if (Request::url() === route('initial_income_expense_head_balance') or
                                        Request::url() === route('initial_income_expense_head_balance.active.search')) class="active" @endif>
                                        <a @if (config('role_manage.InitialIncomeExpenseHeadBalance.All') == 0) style="display: none" @endif
                                            href="{{ route('initial_income_expense_head_balance') }}">All</a>
                                    </li>
                                    <li @if (Request::url() === route('initial_income_expense_head_balance.create')) class="active" @endif>
                                        <a @if (config('role_manage.InitialIncomeExpenseHeadBalance.Create') == 0) style="display: none" @endif
                                            href="{{ route('initial_income_expense_head_balance.create') }}">Create</a>
                                    </li>
                                    <li @if (Request::url() === route('initial_income_expense_head_balance.trashed') or
                                        Request::url() === route('initial_income_expense_head_balance.trashed.search')) class="active" @endif>
                                        <a @if (config('role_manage.InitialIncomeExpenseHeadBalance.TrashShow') == 0) style="display: none" @endif
                                            href="{{ route('initial_income_expense_head_balance.trashed') }}">Trashed</a>
                                    </li>
                                </ul>
                            </li>
                            {{-- initial_income_expense_head_balance End --}}
                        </ul>
                    </li>
                @endif
                {{-- Opening Balance Start --}}

                {{-- Voucher Start --}}
                <li @if (config('role_manage.CrVoucher.All') == 0 and
                    config('role_manage.CrVoucher.TrashShow') == 0 and
                    config('role_manage.CrVoucher.Create') == 0 and
                    config('role_manage.DrVoucher.All') == 0 and
                    config('role_manage.DrVoucher.TrashShow') == 0 and
                    config('role_manage.DrVoucher.Create') == 0 and
                    config('role_manage.JnlVoucher.All') == 0 and
                    config('role_manage.JnlVoucher.TrashShow') == 0 and
                    config('role_manage.JnlVoucher.Create') == 0 and
                    config('role_manage.ContraVoucher.All') == 0 and
                    config('role_manage.ContraVoucher.TrashShow') == 0 and
                    config('role_manage.ContraVoucher.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('dr_voucher') or
                        Request::url() === route('dr_voucher.create') or
                        Request::url() === route('dr_voucher.trashed') or
                        Request::url() === route('dr_voucher.active.search') or
                        Request::url() === route('dr_voucher.trashed.search') or
                        Request::url() === route('cr_voucher') or
                        Request::url() === route('cr_voucher.create') or
                        Request::url() === route('cr_voucher.trashed') or
                        Request::url() === route('cr_voucher.active.search') or
                        Request::url() === route('cr_voucher.trashed.search') or
                        Request::url() === route('jnl_voucher') or
                        Request::url() === route('jnl_voucher.create') or
                        Request::url() === route('jnl_voucher.trashed') or
                        Request::url() === route('jnl_voucher.active.search') or
                        Request::url() === route('jnl_voucher.trashed.search') or
                        Request::url() === route('contra_voucher') or
                        Request::url() === route('contra_voucher.create') or
                        Request::url() === route('contra_voucher.trashed') or
                        Request::url() === route('contra_voucher.active.search') or
                        Request::url() === route('contra_voucher.trashed.search')) class="active " @endif>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="material-icons">account_balance_wallet</i>
                        <span>{{ __('root.menu.voucher') }}</span>
                    </a>

                    <ul class="ml-menu">

                        {{-- Cr Voucher Start --}}

                        <li @if (config('role_manage.CrVoucher.All') == 0 and
                            config('role_manage.CrVoucher.TrashShow') == 0 and
                            config('role_manage.CrVoucher.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('cr_voucher') or
                                Request::url() === route('cr_voucher.create') or
                                Request::url() === route('cr_voucher.trashed') or
                                Request::url() === route('cr_voucher.active.search') or
                                Request::url() === route('cr_voucher.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrow-right"></i>
                                <span>{{ __('root.menu.voucher_credit') }}</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('cr_voucher') or Request::url() === route('cr_voucher.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.CrVoucher.All') == 0) style="display: none" @endif
                                        href="{{ route('cr_voucher') }}">{{ __('root.menu.voucher_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('cr_voucher.create')) class="active" @endif>
                                    <a @if (config('role_manage.CrVoucher.Create') == 0) style="display: none" @endif
                                        href="{{ route('cr_voucher.create') }}">{{ __('root.menu.voucher_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('cr_voucher.trashed') or Request::url() === route('cr_voucher.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.CrVoucher.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('cr_voucher.trashed') }}">{{ __('root.menu.voucher_trashed') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- cr Voucher End --}}

                        {{-- Dr Voucher Start --}}

                        <li @if (config('role_manage.DrVoucher.All') == 0 and
                            config('role_manage.DrVoucher.TrashShow') == 0 and
                            config('role_manage.DrVoucher.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('dr_voucher') or
                                Request::url() === route('dr_voucher.create') or
                                Request::url() === route('dr_voucher.trashed') or
                                Request::url() === route('dr_voucher.active.search') or
                                Request::url() === route('dr_voucher.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrow-left"></i>
                                <span>{{ __('root.menu.debit') }}</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('dr_voucher') or Request::url() === route('dr_voucher.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.DrVoucher.All') == 0) style="display: none" @endif
                                        href="{{ route('dr_voucher') }}">{{ __('root.menu.debit_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('dr_voucher.create')) class="active" @endif>
                                    <a @if (config('role_manage.DrVoucher.Create') == 0) style="display: none" @endif
                                        href="{{ route('dr_voucher.create') }}">{{ __('root.menu.debit_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('dr_voucher.trashed') or Request::url() === route('dr_voucher.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.DrVoucher.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('dr_voucher.trashed') }}">{{ __('root.menu.debit_trashed') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Dr Voucher End --}}


                        {{-- Jnl Voucher Start --}}

                        <li @if (config('role_manage.JnlVoucher.All') == 0 and
                            config('role_manage.JnlVoucher.TrashShow') == 0 and
                            config('role_manage.JnlVoucher.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('jnl_voucher') or
                                Request::url() === route('jnl_voucher.create') or
                                Request::url() === route('jnl_voucher.trashed') or
                                Request::url() === route('jnl_voucher.active.search') or
                                Request::url() === route('jnl_voucher.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrows-alt-h"></i>
                                <span>{{ __('root.menu.journal') }}</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('jnl_voucher') or Request::url() === route('jnl_voucher.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.JnlVoucher.All') == 0) style="display: none" @endif
                                        href="{{ route('jnl_voucher') }}">{{ __('root.menu.journal_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('jnl_voucher.create')) class="active" @endif>
                                    <a @if (config('role_manage.JnlVoucher.Create') == 0) style="display: none" @endif
                                        href="{{ route('jnl_voucher.create') }}">{{ __('root.menu.journal_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('jnl_voucher.trashed') or Request::url() === route('jnl_voucher.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.JnlVoucher.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('jnl_voucher.trashed') }}">{{ __('root.menu.journal_trashed') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Jnl Voucher End --}}

                        {{-- contra_voucher Start --}}

                        <li @if (config('role_manage.ContraVoucher.All') == 0 and
                            config('role_manage.ContraVoucher.TrashShow') == 0 and
                            config('role_manage.ContraVoucher.Create') == 0) style="display: none" @endif
                            @if (Request::url() === route('contra_voucher') or
                                Request::url() === route('contra_voucher.create') or
                                Request::url() === route('contra_voucher.trashed') or
                                Request::url() === route('contra_voucher.active.search') or
                                Request::url() === route('contra_voucher.trashed.search')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <i class="fas fa-arrows-alt-h"></i>
                                <span>{{ __('root.menu.contra') }}</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (Request::url() === route('contra_voucher') or Request::url() === route('contra_voucher.active.search')) class="active" @endif>
                                    <a @if (config('role_manage.ContraVoucher.All') == 0) style="display: none" @endif
                                        href="{{ route('contra_voucher') }}">{{ __('root.menu.contra_all') }}</a>
                                </li>
                                <li @if (Request::url() === route('contra_voucher.create')) class="active" @endif>
                                    <a @if (config('role_manage.ContraVoucher.Create') == 0) style="display: none" @endif
                                        href="{{ route('contra_voucher.create') }}">{{ __('root.menu.contra_create') }}</a>
                                </li>
                                <li @if (Request::url() === route('contra_voucher.trashed') or
                                    Request::url() === route('contra_voucher.trashed.search')) class="active" @endif>
                                    <a @if (config('role_manage.ContraVoucher.TrashShow') == 0) style="display: none" @endif
                                        href="{{ route('contra_voucher.trashed') }}">{{ __('root.menu.contra_trashed') }}</a>
                                </li>
                            </ul>
                        </li>

                        {{-- contra_voucher End --}}

                    </ul>
                </li>

                {{-- Voucher End --}}

                {{-- Report Start --}}
                <?php
                $AccountsShow = (config('role_manage.Ledger.All') or config('role_manage.TrialBalance.All') or config('role_manage.CostOfRevenue.All') or config('role_manage.ProfitOrLossAccount.All') or config('role_manage.RetainedEarning.All') or config('role_manage.FixedAssetsSchedule.All') or config('role_manage.StatementOfFinancialPosition.All') or config('role_manage.CashFlow.All') or config('role_manage.ReceiveAndPayment.All') or config('role_manage.Notes.All'));
                
                $generalShow = (config('role_manage.GeneralBranch.All') or config('role_manage.GeneralLedger.All') or config('role_manage.GeneralBankCash.All') or config('role_manage.GeneralVoucher.All'));
                
                $sellsShow = config('role_manage.SellsReport.All');
                $purchaseShow = config('role_manage.PurchaseReport.All');
                
                ?>

                <li @if ($AccountsShow == false and $generalShow == false and $sellsShow == false and $purchaseShow == false) class="dis-none" @endif
                    @if (Request::url() === route('reports.accounts.ledger') or
                        Request::url() === route('reports.accounts.trial_balance') or
                        Request::url() === route('reports.accounts.cost_of_revenue') or
                        Request::url() === route('reports.accounts.profit_or_loss_account') or
                        Request::url() === route('reports.accounts.retained_earnings') or
                        Request::url() === route('reports.accounts.fixed_asset_schedule') or
                        Request::url() === route('reports.accounts.balance_sheet') or
                        Request::url() === route('reports.accounts.receive_payment') or
                        Request::url() === route('reports.accounts.notes') or
                        Request::url() === route('reports.accounts.cash_flow') or
                        Request::url() === route('reports.general.branch') or
                        Request::url() === route('reports.general.ledger.type') or
                        Request::url() === route('reports.general.bank_cash') or
                        Request::url() === route('reports.general.voucher') or
                        Request::url() === route('report.sells.party_ledger') or
                        Request::url() === route('report.purchase')) class="active " @endif>
                    <a class="menu-toggle" href="javascript:void(0);">
                        <i class="fas fa-receipt"></i>
                        <span>{{ __('root.menu.report') }}</span>
                    </a>
                    <ul class="ml-menu">
                        {{-- Accounts Report Start --}}
                        <li @if ($AccountsShow == false) class="dis-none" @endif
                            @if (Request::url() === route('reports.accounts.ledger') or
                                Request::url() === route('reports.accounts.trial_balance') or
                                Request::url() === route('reports.accounts.cost_of_revenue') or
                                Request::url() === route('reports.accounts.profit_or_loss_account') or
                                Request::url() === route('reports.accounts.retained_earnings') or
                                Request::url() === route('reports.accounts.fixed_asset_schedule') or
                                Request::url() === route('reports.accounts.balance_sheet') or
                                Request::url() === route('reports.accounts.receive_payment') or
                                Request::url() === route('reports.accounts.notes') or
                                Request::url() === route('reports.accounts.cash_flow')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.accounts') }} </span>
                            </a>
                            <ul class="ml-menu">
                                <li @if (config('role_manage.Ledger.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.ledger')) class="active " @endif>
                                    <a href="{{ route('reports.accounts.ledger') }}">{{ __('root.menu.ledger') }}</a>
                                </li>
                                <li @if (config('role_manage.TrialBalance.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.trial_balance')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.accounts.trial_balance') }}">{{ __('root.menu.trial_balance') }}</a>
                                </li>
                                <li @if (config('role_manage.CostOfRevenue.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.cost_of_revenue')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.accounts.cost_of_revenue') }}">{{ __('root.menu.cost_of_revenue') }}</a>
                                </li>
                                <li @if (config('role_manage.ProfitOrLossAccount.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.profit_or_loss_account')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.accounts.profit_or_loss_account') }}">{{ __('root.menu.profit_or_loss_account') }}</a>
                                </li>
                                <li @if (config('role_manage.RetainedEarning.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.retained_earnings')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.accounts.retained_earnings') }}">{{ __('root.menu.retained_earnings') }}</a>
                                </li>
                                <li @if (config('role_manage.FixedAssetsSchedule.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.fixed_asset_schedule')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.accounts.fixed_asset_schedule') }}">{{ __('root.menu.fixed_asset_schedule') }}</a>
                                </li>
                                <li @if (config('role_manage.StatementOfFinancialPosition.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.balance_sheet')) class="active " @endif>
                                    <a
                                        href=" {{ route('reports.accounts.balance_sheet') }} ">{{ __('root.menu.balance_sheet') }}</a>
                                </li>
                                <li @if (config('role_manage.CashFlow.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.cash_flow')) class="active" @endif>
                                    <a
                                        href="{{ route('reports.accounts.cash_flow') }}">{{ __('root.menu.cash_flow') }}</a>
                                </li>
                                <li @if (config('role_manage.ReceiveAndPayment.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.receive_payment')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.accounts.receive_payment') }}">{{ __('root.menu.receive_payment') }}</a>
                                </li>
                                <li @if (config('role_manage.Notes.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.accounts.notes')) class="active " @endif>
                                    <a href="{{ route('reports.accounts.notes') }}">{{ __('root.menu.notes') }}</a>
                                </li>
                            </ul>
                        </li>
                        {{-- Accounts Report End --}}

                        {{-- Selles Report Start --}}
                        <li @if (config('role_manage.SellsReport.All') == 0) style="display: none" @endif
                            @if (Request::url() === route('report.sells.party_ledger')) class="active " @endif>
                            <a href="{{ route('report.sells.party_ledger') }}">{{ __('root.menu.report_sells') }}</a>
                        </li>
                        {{-- Selles Report End --}}

                        {{-- Purchase Report Start --}}
                        <li @if (config('role_manage.PurchaseReport.All') == 0) style="display: none" @endif
                            @if (Request::url() === route('report.purchase')) class="active " @endif>
                            <a href="{{ route('report.purchase') }}">
                                <span>{{ __('root.menu.report_purchase') }}</span>
                            </a>
                        </li>
                        {{-- Purchase Report End --}}

                        {{-- General Report Start --}}
                        <li @if ($generalShow == false) class="dis-none" @endif
                            @if (Request::url() === route('reports.general.branch') or
                                Request::url() === route('reports.general.ledger.type') or
                                Request::url() === route('reports.general.bank_cash') or
                                Request::url() === route('reports.general.voucher')) class="active " @endif>
                            <a class="menu-toggle " href="javascript:void(0);">
                                <span>{{ __('root.menu.general') }}</span>
                            </a>

                            <ul class="ml-menu">
                                <li @if (config('role_manage.GeneralBranch.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.general.branch')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.general.branch') }}">{{ __('root.menu.general_branch') }}</a>
                                </li>

                                <li @if (config('role_manage.GeneralLedger.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.general.ledger.type')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.general.ledger.type') }}">{{ __('root.menu.general_ledger') }}</a>
                                </li>

                                <li @if (config('role_manage.GeneralBankCash.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.general.bank_cash')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.general.bank_cash') }}">{{ __('root.menu.general_bank_cash') }}</a>
                                </li>

                                <li @if (config('role_manage.GeneralVoucher.All') == 0) style="display: none" @endif
                                    @if (Request::url() === route('reports.general.voucher')) class="active " @endif>
                                    <a
                                        href="{{ route('reports.general.voucher') }}">{{ __('root.menu.general_voucher') }}</a>
                                </li>
                            </ul>
                        </li>
                        {{-- General Report End --}}
                    </ul>
                </li>
                {{-- Report End --}}
                {{-- User Start --}}
                <li @if (config('role_manage.Language.All') == 0 and
                    config('role_manage.Language.TrashShow') == 0 and
                    config('role_manage.Language.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('language') or
                        Request::url() === route('language.create') or
                        Request::url() === route('language.trashed') or
                        Request::url() === route('language.active.search') or
                        Request::url() === route('language.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-language"></i>
                        <span>{{ __('root.menu.language') }}</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('language') or Request::url() === route('language.active.search')) class="active" @endif>
                            <a @if (config('role_manage.Language.All') == 0) style="display: none" @endif
                                href="{{ route('language') }}">{{ __('root.menu.language_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('language.create')) class="active" @endif>
                            <a @if (config('role_manage.Language.Create') == 0) style="display: none" @endif
                                href="{{ route('language.create') }}">{{ __('root.menu.language_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('language.trashed') or Request::url() === route('language.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.Language.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('language.trashed') }}">{{ __('root.menu.language_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- User End --}}
               
                {{-- User Start --}}
                <li @if (config('role_manage.User.All') == 0 and
                    config('role_manage.User.TrashShow') == 0 and
                    config('role_manage.User.Create') == 0) style="display: none" @endif
                    @if (Request::url() === route('user') or
                        Request::url() === route('user.create') or
                        Request::url() === route('user.trashed') or
                        Request::url() === route('user.active.search') or
                        Request::url() === route('user.trashed.search')) class="active " @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user"></i>
                        <span>User</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('user') or Request::url() === route('user.active.search')) class="active" @endif>
                            <a @if (config('role_manage.User.All') == 0) style="display: none" @endif
                                href="{{ route('user') }}">{{ __('root.menu.user_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('user.create')) class="active" @endif>
                            <a @if (config('role_manage.User.Create') == 0) style="display: none" @endif
                                href="{{ route('user.create') }}">{{ __('root.menu.user_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('user.trashed') or Request::url() === route('user.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.User.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('user.trashed') }}">{{ __('root.menu.user_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- User End --}}
                

                {{-- role-manage Start --}}
                <li @if (Request::url() === route('role-manage') or
                    Request::url() === route('role-manage.create') or
                    Request::url() === route('role-manage.trashed') or
                    Request::url() === route('role-manage.active.search') or
                    Request::url() === route('role-manage.trashed.search')) class="active" @endif
                    @if (config('role_manage.RoleManager.All') == 0 and
                        config('role_manage.RoleManager.TrashShow') == 0 and
                        config('role_manage.RoleManager.Create') == 0) style="display: none" @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="fas fa-user-lock "></i>
                        <span>{{ __('root.menu.role_manage') }}</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (Request::url() === route('role-manage') or Request::url() === route('role-manage.active.search')) class="active" @endif>
                            <a @if (config('role_manage.RoleManager.All') == 0) style="display: none" @endif
                                href="{{ route('role-manage') }}">{{ __('root.menu.role_manage_all') }}</a>
                        </li>
                        <li @if (Request::url() === route('role-manage.create')) class="active" @endif>
                            <a @if (config('role_manage.RoleManager.Create') == 0) style="display: none" @endif
                                href="{{ route('role-manage.create') }}">{{ __('root.menu.role_manage_create') }}</a>
                        </li>
                        <li @if (Request::url() === route('role-manage.trashed') or Request::url() === route('role-manage.trashed.search')) class="active" @endif>
                            <a @if (config('role_manage.RoleManager.TrashShow') == 0) style="display: none" @endif
                                href="{{ route('role-manage.trashed') }}">{{ __('root.menu.role_manage_trashed') }}</a>
                        </li>
                    </ul>
                </li>
                {{-- role-manage End --}}

                {{-- SETTINGSStart --}}
                <li @if (Request::url() === route('settings.system') or Request::url() === route('settings.general')) class="active" @endif
                    @if (config('role_manage.Settings.All') == 0 and config('role_manage.Settings.Show') == 0) style="display: none" @endif>
                    <a class="menu-toggle " href="javascript:void(0);">
                        <i class="material-icons">settings</i>
                        <span>{{ __('root.menu.settings') }}</span>
                    </a>
                    <ul class="ml-menu">
                        <li @if (config('role_manage.Settings.All') == 0) style="display: none" @endif
                            @if (Request::url() === route('settings.general')) class="active" @endif>
                            <a href="{{ route('settings.general') }}"> {{ __('root.menu.settings_general') }} </a>
                        </li>
                        <li @if (config('role_manage.Settings.Show') == 0) style="display: none" @endif
                            @if (Request::url() === route('settings.system')) class="active" @endif>
                            <a href="{{ route('settings.system') }}">{{ __('root.menu.settings_system') }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">

                            </a>
                        </li>
                    </ul>
                </li>
                {{-- SETTINGS End --}}
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                {{ config('settings.developed_label') }} <a target="_blank"
                    href="{{ config('settings.developed_link') }}">{{ config('settings.developed_by') }}</a>
            </div>
            <div class="version">
                <b>Version: </b> {{ config('settings.version') }}
            </div>
        </div>
        <!-- #Footer -->
    </aside>
</section>
