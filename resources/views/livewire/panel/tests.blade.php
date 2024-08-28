<div>
    <section id="knowledge-base-search">
        <div class="row">
            <div class="col-12">
                <div class="card knowledge-base-bg white">
                    <div class="card-content">
                        <div class="card-body p-sm-4 p-2">
                            <h1 class="white">از لیست زیر نوع آزمون خود را انتخاب کنید!</h1>
                            <form>
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="text" class="form-control form-control-lg" id="searchbar"
                                           wire:model.debounce="filter"
                                           placeholder="جستجو موضوع یا کلمه کلیدی">
                                    <div class="form-control-position">
                                        <i class="feather icon-search px-1"></i>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="knowledge-base-content">
        <div class="row search-content-info">
            @foreach($tests as $test)
                <div class="col-md-4 col-sm-6 col-12 search-content">
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="{{route('panel.test',['id' => $test->id])}}">
                                <img style="max-width:200px;" src={{$test->image}} ></img>
                                <h4>{{$test->name}}</h4>
                                <small class="text-dark">تعداد سوالات: {{$test->number_of_question}}</small><br>
                                <small class="text-dark">زمان آزمون: {{$test->time}} دقیقه</small>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$tests->links()}}
        </div>
    </section>
    @include('livewire.admin.components.with-breadcrumb')
</div>
