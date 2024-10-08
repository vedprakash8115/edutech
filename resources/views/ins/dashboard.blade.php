@extends('layout.app')
@section('content')
<!-- <button id="theme-toggle-btn">Toggle Theme</button> -->

    {{-- <div class="container-xxl flex-grow-1 container-p-y"> --}}

    <div class="row" >
        <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Live And Webinar">
            <div class="card-hover card" >
                <a href="{{route('liveclass')}}">
                    <div class="card-body" >
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h4 class="text- mb-2">Live And Webinar</h>
                                </div>
                                <div class="mt-sm-auto">
                                    <h5 class="mb-0">$84,686k</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center icon-wrapper icon-wrapper-1">
                            <img src="/assets/img/icons/live.gif" alt="" srcset="" height="70" width="70">
                        </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3 content-tile" title="Content" data-bs-toggle="modal" data-bs-target="#contentModal" style="cursor: pointer;">
            <div class="card-hover card">
                <a href="javascript:void(0)">

                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h4 class="text- mb-2">Content</h4>
                                </div>
                                <div class="mt-sm-auto">
                                    <h5 class="mb-0">$84,686k</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center icon-wrapper icon-wrapper-2">
                            <img src="/assets/img/icons/content.gif" alt="" srcset="" height="70" width="70">

                        </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3 user-management-tile" title="User Management" data-bs-toggle="modal" data-bs-target="#userModal" style="cursor: pointer;">
            <div class="card-hover card">
                <a href="javascript:void(0)">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h4 class="text- mb-2">User Management</h4>
                                </div>
                                <div class="mt-sm-auto">
                                    <h5 class="mb-0">$84,686k</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center icon-wrapper icon-wrapper-3">
                            <img src="/assets/img/icons/user1.gif" alt="" srcset="" height="70" width="70">

                        </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3 marketing-tile" title="Marketing" data-bs-toggle="modal" data-bs-target="#MarketingModal" style="cursor: pointer;">
            <div class="card-hover card">
                <a href="javascript:void(0)">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h4 class="text- mb-2">Marketing</h4>
                                </div>
                                <div class="mt-sm-auto">
                                    <h5 class="mb-0">$84,686k</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center icon-wrapper icon-wrapper-12">
                                <img src="/assets/img/icons/marketing.gif" alt="" srcset="" height="70" width="70">

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Sliders">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Sliders</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-4">
                        <img src="/assets/img/icons/slider.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Books">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Books</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-5">
                        <img src="/assets/img/icons/books.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Website">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Website</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-6">
                        <img src="/assets/img/icons/website.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Support">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Support</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-7">
                        <img src="/assets/img/icons/user.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Test Practicals" onclick="window.location.href = '{{route('mock_test')}}'" style="cursor:pointer">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Test Practicals</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-8">
                        <img src="/assets/img/icons/test.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Chat Support">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Chat Support</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-9">
                      <img src="/assets/img/icons/chat.gif" alt="" srcset="" height="70" width="70">

                    </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Reports">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Reports</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-10">
                        <img src="/assets/img/icons/report.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-12 col-md-8 col-lg-3 order-3 order-md-2 mt-3" title="Setting">
            <div class="card-hover card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h4 class="text- mb-2">Setting</h4>
                            </div>
                            <div class="mt-sm-auto">
                                <h5 class="mb-0">$84,686k</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center icon-wrapper icon-wrapper-11">
                        <img src="/assets/img/icons/setting.gif" alt="" srcset="" height="70" width="70">

                      </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal  -->
        <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg-custom">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel">Content <i class="fa-solid fa-chevron-right"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('modals.content')

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg-custom">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel">User Management <i class="fa-solid fa-chevron-right"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('modals.user-management')

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="marketingModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg-custom">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel">Marketing <i class="fa-solid fa-chevron-right"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('modals.marketing')
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    

@endsection
