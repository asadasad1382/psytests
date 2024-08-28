<div>
    <section id="knowledge-base-search">
        <div class="row">
            <div class="col-12">
                <div class="card knowledge-base-bg white">
                    <div class="card-content">
                        <div class="card-body p-sm-4 p-2">
                            <h1 class="white">از لیست زیر نوع دسته بندی آزمون خود را انتخاب کنید!</h1>>
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
            @foreach($categories as $category)
                <div class="col-md-4 col-sm-6 col-12 search-content">
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="{{route('panel.tests',['category_id' => $category->id])}}">
                                <img
                                    src="{{$category->image}}"
                                    class="mx-auto mb-2 w-100" height="200"
                                    alt="knowledge-base-image">
                                <h4>{{$category->title}}</h4>
                                <small class="text-dark">{{$category->body}}</small>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$categories->links()}}
        </div>
    </section>
    @include('livewire.admin.components.with-breadcrumb')
</div>
