<div class="row breadcrumbs-top">
    <div class="col-12">
        <h2 class="content-header-title float-start mb-0">داشبورد</h2>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
                @foreach($links as $link)
                    <li class="breadcrumb-item">
                        <a href="{{url($link['route'])}}">{{$link['title']}}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
