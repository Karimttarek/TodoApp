@if (session('status'))
@push('script')
    <script>
        window.addEventListener("load", (event) => {
            document.getElementById('event').click();
        });
    </script>
@endpush
@endif


<button class="hidden" id="event" onclick="window.$wireui.notify({
    title: '{{session('status')}}',
    description: '{{session('status')}}',
    icon: '{{session('status')}}' })">
</button>
