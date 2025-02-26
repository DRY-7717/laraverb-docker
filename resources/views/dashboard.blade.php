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
                    proses: false,
                    order: null,
                    nameUser: null,
                    kirim: false
                
                    {{-- didalam sini didalam echo listen itu bebas mau masukin apa aja karna disitu terjadi tempat perubahan data, asal datanya ada di x-data --}}
                
                }" x-init="Echo.private('users.{{ auth()->user()->id }}')
                    .listen('OrderDispatched', (event) => {
                        proses = true
                        nameUser = event.order.user_id
                        order = event.order
                        console.log(event)
                    })
                    .listen('OrderDelivered', (event) => {
                        kirim = true
                        nameUser = event.order.user_id
                        order = event.order
                    })">

                
                    <template x-if="proses">
                        <div>Order (<span x-text="order.id"></span>) has been dispatched to user id: <span
                                x-text="nameUser"></span></div>
                    </template>

                    <template x-if="kirim">
                        <div>Order (<span x-text="order.id"></span>) has been delivered to user id: <span
                                x-text="nameUser"></span></div>
                    </template>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
