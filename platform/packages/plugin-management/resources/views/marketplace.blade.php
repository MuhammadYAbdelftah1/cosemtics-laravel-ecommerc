@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::alert type="warning" title="Important notes:" :important="false">
        Those plugins are from our Ecom-Eg community <a href="https://ecom-eg.net/products"
            target="_blank">ecom-eg.net/products</a>. We regret to inform
        you that we cannot assume responsibility for the functionality or support of free plugins, as they are
        developed and maintained independently. However, we are more than happy to assist with any inquiries or
        issues related to our official products and services.
    </x-core::alert>

    <v-plugin-list plugin-list-url="{{ route('plugins.marketplace.ajax.list') }}"
        plugin-remove-url="{{ route('plugins.remove', '__name__') }}"></v-plugin-list>
@endsection

@push('footer')
    <x-core::modal id="terms-and-policy-modal" :title="__('Install plugin from Marketplace')" :submit-button-label="__('Accept and install')" size="md">
        <div class="text-start">
            <p>
                You are installing plugin from our Ecom-Eg community. Those plugins are developed by author
                on <a href="https://ecom-eg.net" target="_blank">ecom-eg.net</a>.
            </p>
            <p>We (Ecom-Eg) <strong>won't</strong> support free plugins from Marketplace.</p>
            <p>
                If it has issues or bugs, please contact the author of that plugin to get support or just
                delete it from <a :href="installedPluginsUrl">Installed Plugins</a> page.
            </p>
            <p class="mb-0">
                If it makes your site down, just delete that plugin from
                <code>platform/plugins</code> folder.
            </p>
        </div>

        <x-slot:footer>
            <div class="w-100">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn w-100" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-info w-100" data-bb-toggle="accept-term-and-policy">
                            {{ __('Accept and install') }}
                        </button>
                    </div>
                </div>
            </div>
        </x-slot:footer>
    </x-core::modal>

    <script>
        window.trans = {{ Js::from([
            'base' => trans('packages/plugin-management::marketplace'),
        ]) }};

        window.marketplace = {
            route: {
                list: "{{ route('plugins.marketplace.ajax.list') }}",
                detail: "{{ route('plugins.marketplace.ajax.detail', [':id']) }}",
                install: "{{ route('plugins.marketplace.ajax.install', [':id']) }}",
                active: "{{ route('plugins.change.status') }}",
            },
            installed: {{ Js::from(get_installed_plugins()) }},
            activated: {{ Js::from(get_active_plugins()) }},
            token: "{{ csrf_token() }}",
            coreVersion: "{{ get_cms_version() }}"
        };
    </script>
@endpush
