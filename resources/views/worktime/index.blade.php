<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/style.css">
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h3>ម៉ោងធ្វើការ</h3>
                </div>
                <div class="d-print-none col-auto ms-auto">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#modal-add">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <x-icon.plus />
                            <span>បង្កើតថ្មី</span>
                        </a>
                        <a href="#" class="btn btn-primary btn-5 d-sm-none btn-icon d-sm-inline-flex"
                            data-bs-toggle="modal" data-bs-target="#modal-add" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <x-icon.pluses />
                        </a>
                    </div>

                    <!-- BEGIN MODAL -->
                    {{-- <x-popup id="modal-add" title="បន្ថែមសមាជិកថ្មី">
                        <x-members.add />
                    </x-popup> --}}
                    <!-- END MODAL -->
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
