<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100" x-data="{
                    dispatched: false,
                    order: null,
                    nameUser: null,
                    delivered: false
                
                
                }" x-init="Echo.private('users.{{ auth()->user()->id }}')
                    .listen('OrderDispatched', (event) => {
                        dispatched = true
                        nameUser = event.user.name
                        order = event.order
                    })
                    .listen('OrderDelivered', (event) => {
                        delivered = true
                        nameUser = event.user.name
                        order = event.order
                    })">


                    <template x-if="dispatched">
                        <div>Order (<span x-text="order.id"></span>) has been dispatched to <span
                                x-text="nameUser"></span></div>
                    </template>

                    <template x-if="delivered">
                        <div>Order (<span x-text="order.id"></span>) has been delivered to <span
                                x-text="nameUser"></span></div>
                    </template>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
