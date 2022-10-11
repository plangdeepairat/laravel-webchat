<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto shadow-lg rounded-lg">
                <!-- headaer -->
            <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
              <div class="font-semibold text-2xl">Test Chat </div>
            </div>
            <!-- end header -->
            <!-- Chatting -->
            <div class="flex flex-row justify-between bg-sky-100	">
              <!-- message -->
              <div class="w-full px-5 flex flex-col justify-between">
                <div class="">
                  <div class="w-full">
                    <div id="app">
                      <chat-template :user="{{ Auth::user() }}"/>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end message -->
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
