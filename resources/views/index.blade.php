<x-layout title="Dashboard">
    @guest
        <x-slot name="title">Welcome to Paprokes</x-slot>
    @endguest
    <div class="container-fluid">
        Dashboard
    </div>
</x-layout>
