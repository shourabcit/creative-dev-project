<x-app-layout>
    <x-intro info="Banners Tab" />
    @livewire('banner')
    @push('js')
    <script src="{{ asset('backend/js/sweetalert2@11.js') }}"></script>
    <script>
        window.addEventListener('swal:confirm', event=> {
            Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
             window.livewire.emit('deleteBanner', event.detail.id);
          
            }
            })
        });
    </script>

    @endpush
</x-app-layout>