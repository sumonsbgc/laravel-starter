<div class="flex mb-1">
    <div class="col-6">
        <h3 class="page-title">{{ $title ?? '' }}</h3>
    </div>
    <div class="col-6">
        <ul class="kr_breadcumb justify-end">
            <li><a href="{{ route("admin.dashboard") }}" class="active">Dashboard <i class="fas fa-angle-double-right"></i></a> </li>
            <li><a href="javascript:void">{{ $title ?? '' }}</a></li>
        </ul>
    </div>
</div>
