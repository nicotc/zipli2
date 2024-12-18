<x-layout>
    <x-slot:styles>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}">
    </x-slot:styles>
    <x-slot:scripts>
        <script type="module">
            document.addEventListener('livewire:init', () => {

                Livewire.on('notify', (data) => {
                    var type = data[0].type;
                    var msg = data[0].message;
                    if (type == 'success') {
                        toastr.success(msg);
                    } else {
                        toastr.error(msg);
                    }
                });
            });
        </script>
    </x-slot:scripts>

    <x-slot:title>
        My profile
    </x-slot:title>

    <div class="container-xxl flex-grow-1 container-p-y">


            <livewire:urlshort::url.info />



        <div class="row">
            <div class="my-4 col-md-5 col-lg-3">
                <livewire:urlshort::url.create />
            </div>
            <div class="my-4 col-md-7 col-lg-9">
                <livewire:urlshort::url.url-datatable />
            </div>
        </div>



</x-layout>
