<div class="row g-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
                <div class="pb-1 mb-2 d-flex align-items-center">
                    <div class="avatar me-2">
                        <span class="rounded avatar-initial bg-label-primary"><i class="bx bx-link"></i></span>
                    </div>
                    <h4 class="mb-0 ms-1">{{ $totalCreated }}</h4>
                </div>
                <p class="mb-1">Total Url Creadas</p>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-border-shadow-success h-100">
            <div class="card-body">
                <div class="pb-1 mb-2 d-flex align-items-center">
                    <div class="avatar me-2">
                        <span class="rounded avatar-initial bg-label-success"><i class="bx bx-link-alt"></i></span>
                    </div>
                    <h4 class="mb-0 ms-1">{{ $urlUnique }}</h4>
                </div>
                <p class="mb-1">Url unicas</p>

            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-border-shadow-warning h-100">
            <div class="card-body">
                <div class="pb-1 mb-2 d-flex align-items-center">
                    <div class="avatar me-2">
                        <span class="rounded avatar-initial bg-label-warning"><i class="bx bxs-show"></i></span>
                    </div>
                    <h4 class="mb-0 ms-1">{{ $totalVisited }}</h4>
                </div>
                <p class="mb-1">Total visitas</p>

            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
                <div class="pb-1 mb-2 d-flex align-items-center">
                    <div class="avatar me-2">
                        <span class="rounded avatar-initial bg-label-info"><i
                                class="bx bx-time-five"></i></span>
                    </div>
                    <h4 class="mb-0 ms-1">{{ $lastVisited->created_at }}</h4>
                </div>
                <p class="mb-1">Mas reciente  {{ $lastVisited->url }} - {{ $lastVisited->code }} </p>

            </div>
        </div>
    </div>
</div>
